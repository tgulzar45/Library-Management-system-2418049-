<?php
session_start();
require "config.php";

// Only allow logged-in users
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Handle return request internally
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['return_id'])) {
    $loanId = (int)$_POST['return_id'];

    // Get book_id from loan record
    $stmt = $conn->prepare("SELECT book_id FROM borrowed_books WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['id' => $loanId, 'user_id' => $userId]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($book) {
        // Delete loan record
        $conn->prepare("DELETE FROM borrowed_books WHERE id = :id")->execute(['id' => $loanId]);

        // Increase book quantity
        $conn->prepare("UPDATE books SET quantity = quantity + 1 WHERE id = :book_id")
            ->execute(['book_id' => $book['book_id']]);
    }

    header("Location: user_loan.php?returned=1");
    exit();
}

// Fetch books borrowed by the user
$stmt = $conn->prepare("
    SELECT 
        bb.id AS loan_id,
        b.title, b.author, b.genre, b.isbn,
        bb.borrow_date
    FROM borrowed_books bb
    JOIN books b ON bb.book_id = b.id
    WHERE bb.user_id = :user_id
");
$stmt->execute(['user_id' => $userId]);
$loans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Borrowed Books</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: url('Londonjpg.jpeg') no-repeat center center fixed;
      background-size: cover;
      color: #2E2E2E;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .container {
      max-width: 1000px;
      margin: 80px auto;
      background-color: white;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 14px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #4A4A4A;
      color: white;
    }

    tr:hover {
      background-color: #f9f9f9;
    }

    .no-books {
      text-align: center;
      font-size: 18px;
      color: #c0392b;
      margin-top: 20px;
    }

    .back-btn {
      display: inline-block;
      background: #2E2E2E;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .return-btn {
      background: #2E2E2E;
      color: white;
      padding: 8px 14px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .return-btn:hover {
      background: #1a1a1a;
    }

    footer {
      background: #333;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: auto;
    }

    .footer-content {
      max-width: 1000px;
      margin: 0 auto;
    }

    .footer-slogan {
      font-weight: 500;
      margin-bottom: 5px;
    }

    .footer-copy {
      font-size: 13px;
      color: #ccc;
    }
  </style>
</head>
<body>

<div class="container">
  <a href="user_dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
  <h2>My Borrowed Books</h2>

  <?php if (isset($_GET['returned']) && $_GET['returned'] == 1): ?>
    <p style="text-align:center; color:green; font-weight:bold;">✅ Book returned successfully.</p>
  <?php endif; ?>

  <?php if (!empty($loans)): ?>
    <table>
      <thead>
        <tr>
          <th>Title</th>
          <th>Author</th>
          <th>Genre</th>
          <th>ISBN</th>
          <th>Due Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($loans as $loan): ?>
          <?php $dueDate = date('Y-m-d', strtotime($loan['borrow_date'] . ' +14 days')); ?>
          <tr>
            <td><?= htmlspecialchars($loan['title']) ?></td>
            <td><?= htmlspecialchars($loan['author']) ?></td>
            <td><?= htmlspecialchars($loan['genre']) ?></td>
            <td><?= htmlspecialchars($loan['isbn']) ?></td>
            <td><?= $dueDate ?></td>
            <td>
              <form method="POST" onsubmit="return confirm('Are you sure you want to return this book?');">
                <input type="hidden" name="return_id" value="<?= $loan['loan_id'] ?>">
                <button type="submit" class="return-btn">Return</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p class="no-books">You haven't borrowed any books yet.</p>
  <?php endif; ?>
</div>

<footer>
  <div class="footer-content">
    <p class="footer-slogan">Empowering your reading journey — one book at a time.</p>
    <p class="footer-copy">&copy; <?= date("Y") ?> Library Management System. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
