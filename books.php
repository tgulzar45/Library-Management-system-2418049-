<?php
session_start();
require "config.php";


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$selectedGenre = isset($_GET['genre']) ? trim($_GET['genre']) : '';
$books = [];
$genres = [];


$loanStmt = $conn->prepare("SELECT COUNT(*) FROM borrowed_books WHERE user_id = :user_id AND return_date IS NULL");
$loanStmt->execute(['user_id' => $userId]);
$loanCount = $loanStmt->fetchColumn();
$loanLimit = 3;

try {
    $genreStmt = $conn->query("SELECT DISTINCT genre FROM books ORDER BY genre ASC");
    $genres = $genreStmt->fetchAll(PDO::FETCH_COLUMN);

    $extraGenres = ['Fantasy', 'Mystery', 'Science Fiction', 'Romance', 'Thriller', 'Biography', 'History', 'Self-help'];
    $allGenres = array_unique(array_merge($genres, $extraGenres));
    sort($allGenres);

    if ($selectedGenre) {
        $stmt = $conn->prepare("SELECT * FROM books WHERE genre = :genre");
        $stmt->execute(['genre' => $selectedGenre]);
    } else {
        $stmt = $conn->query("SELECT * FROM books");
    }
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $books = [];
    $error = "Error fetching books: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Books - Library Management System</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: url('Londonjpg.jpeg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    body::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: 0;
    }
    nav {
      position: relative;
      z-index: 2;
      background: #333;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      color: white;
    }
    .nav-left {
      display: flex;
      align-items: center;
      gap: 20px;
    }
    .nav-title {
      font-size: 20px;
      font-weight: bold;
    }
    .nav-btn, .nav-links a {
      background-color: #ffffff22;
      color: white;
      padding: 8px 14px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      transition: background 0.3s ease;
    }
    .nav-btn:hover, .nav-links a:hover {
      background-color: #555;
    }
    .container {
      position: relative;
      z-index: 1;
      max-width: 1000px;
      margin: 80px auto;
      background: rgba(255, 255, 255, 0.96);
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    }
    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 30px;
    }
    .filter-bar {
      text-align: center;
      margin-bottom: 20px;
    }
    .filter-bar select {
      padding: 10px;
      font-size: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      width: 200px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      text-align: left;
      color: #333;
    }
    th {
      background-color: #333;
      color: white;
    }
    tr:hover {
      background: rgba(0, 0, 0, 0.03);
    }
    .borrow-btn {
      background: #333;
      color: white;
      padding: 10px 18px;
      border-radius: 0;
      text-decoration: none;
      font-weight: bold;
      display: inline-block;
      transition: background 0.3s ease;
    }
    .borrow-btn:hover {
      background: #111;
    }
    .disabled-btn {
      background: #ccc;
      color: #666;
      padding: 10px 18px;
      border-radius: 0;
      font-weight: bold;
      display: inline-block;
      cursor: not-allowed;
    }
    .alert-success {
      text-align: center;
      background: #dff0d8;
      color: #3c763d;
      padding: 12px 18px;
      border-radius: 8px;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .alert-error {
      text-align: center;
      background: #f8d7da;
      color: #721c24;
      padding: 12px 18px;
      border-radius: 8px;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .no-books {
      text-align: center;
      color: #c0392b;
      font-size: 16px;
    }
    .back-btn {
      display: block;
      text-align: center;
      margin: 30px auto 0;
      padding: 12px 24px;
      background: #333;
      color: white;
      text-decoration: none;
      font-weight: bold;
      border-radius: 8px;
      width: fit-content;
      transition: background 0.3s ease;
    }
    .back-btn:hover {
      background: #222;
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

<nav>
  <div class="nav-left">
    <div class="nav-title">Library Dashboard</div>
    <a href="books.php" class="nav-btn">Books</a>
    <a href="loans.php" class="nav-btn">Loans</a>
    <a href="user_account.php" class="nav-btn">Account</a>
  </div>
  <div class="nav-links">
    <a href="logout.php">Logout</a>
  </div>
</nav>

<div class="container">
  <h2>All Books</h2>

  <?php if (isset($_GET['borrowed']) && $_GET['borrowed'] == 1): ?>
    <div class="alert-success">✅ Book borrowed successfully! Max loan time is 14 days.</div>
  <?php elseif (isset($_GET['error']) && $_GET['error'] === 'unavailable'): ?>
    <div class="alert-error">❌ This book is currently unavailable.</div>
  <?php endif; ?>

  <div class="filter-bar">
    <form method="GET" action="books.php">
      <select name="genre" onchange="this.form.submit()">
        <option value="">-- Filter by Genre --</option>
        <?php foreach ($allGenres as $genre): ?>
          <option value="<?= htmlspecialchars($genre) ?>" <?= $selectedGenre === $genre ? 'selected' : '' ?>>
            <?= htmlspecialchars($genre) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </form>
  </div>

  <?php if (!empty($books)): ?>
    <table>
      <thead>
        <tr>
          <th>Title</th><th>Author</th><th>Genre</th><th>ISBN</th><th>Quantity</th><th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($books as $book): ?>
          <tr>
            <td><?= htmlspecialchars($book['title']) ?></td>
            <td><?= htmlspecialchars($book['author']) ?></td>
            <td><?= htmlspecialchars($book['genre']) ?></td>
            <td><?= htmlspecialchars($book['isbn']) ?></td>
            <td><?= htmlspecialchars($book['quantity']) ?></td>
            <td>
              <?php if ($loanCount >= $loanLimit): ?>
                <span class="disabled-btn" title="Loan limit reached">Limit Reached</span>
              <?php elseif ($book['quantity'] > 0): ?>
                <a href="borrow.php?id=<?= $book['id']; ?>" class="borrow-btn">Borrow</a>
              <?php else: ?>
                <span class="disabled-btn">Unavailable</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p class="no-books">No books found<?= $selectedGenre ? ' in the genre "' . htmlspecialchars($selectedGenre) . '"' : '' ?>.</p>
  <?php endif; ?>

  <a href="user_dashboard.php" class="back-btn">← Back to Dashboard</a>
</div>

<footer>
  <div class="footer-content">
    <p class="footer-slogan">Empowering your reading journey — one book at a time.</p>
    <p class="footer-copy">&copy; <?= date("Y") ?> Library Management System. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
