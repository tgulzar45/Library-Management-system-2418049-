<?php
session_start();
require "config.php";

// Only allow access to logged-in users
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

try {
    $stmt = $conn->query("
        SELECT 
            bb.id AS borrow_id,
            b.title, 
            b.author,
            u.email,
            bb.borrow_date
        FROM borrowed_books bb
        JOIN books b ON bb.book_id = b.id
        JOIN users u ON bb.user_id = u.id
        ORDER BY bb.borrow_date DESC
    ");
    $loans = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $loans = [];
    $error = "Error fetching loan records: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Borrowed Books - Library Management System</title>
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
      background: #333333;
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
    .nav-btn {
      background-color: #555555;
      color: white;
      padding: 8px 14px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      transition: background 0.3s ease;
    }
    .nav-btn:hover {
      background-color: #222222;
    }
    .nav-links a {
      margin-left: 20px;
      color: white;
      text-decoration: none;
      font-weight: 500;
      padding: 8px 16px;
      border-radius: 6px;
      background: #555555;
      transition: background 0.3s ease;
    }
    .nav-links a:hover {
      background: #222222;
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
      margin-bottom: 10px;
    }
    .note {
      text-align: center;
      color: #c0392b;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .back-btn {
      display: block;
      width: fit-content;
      margin: 0 auto 30px;
      background: #4A4A4A;
      color: white;
      padding: 12px 20px;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      font-weight: 600;
    }
    .back-btn:hover {
      background: #222;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      padding: 12px 14px;
      border-bottom: 1px solid #ccc;
      text-align: left;
      font-size: 15px;
      color: #333;
    }
    th {
      background: #333333;
      color: white;
    }
    tr:hover {
      background: #f9f9f9;
    }
    .no-loans {
      text-align: center;
      color: #c0392b;
      margin-top: 20px;
      font-size: 16px;
    }
    footer {
      background: #333333;
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

<!-- Navigation -->
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

<!-- Content -->
<div class="container">
  <a href="user_dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
  <h2>Borrowed Books</h2>
  <p class="note">📅 Max loan time is 14 days. Users will incur penalties after the due date.</p>

  <?php if (!empty($loans)): ?>
    <table>
      <thead>
        <tr>
          <th>Title</th>
          <th>Author</th>
          <th>Email</th>
          <th>Borrow Date</th>
          <th>Due Date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($loans as $loan): ?>
          <tr>
            <td><?= htmlspecialchars($loan['title']) ?></td>
            <td><?= htmlspecialchars($loan['author']) ?></td>
            <td><?= htmlspecialchars($loan['email']) ?></td>
            <td><?= htmlspecialchars(date('Y-m-d', strtotime($loan['borrow_date']))) ?></td>
            <td><?= htmlspecialchars(date('Y-m-d', strtotime($loan['borrow_date'] . ' +14 days'))) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p class="no-loans">No books have been borrowed yet.</p>
  <?php endif; ?>
</div>

<!-- Footer -->
<footer>
  <div class="footer-content">
    <p class="footer-slogan">Empowering your reading journey — one book at a time.</p>
    <p class="footer-copy">&copy; <?= date("Y") ?> Library Management System. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
