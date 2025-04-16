<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Dashboard - Library Management System</title>
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
      background: #4A4A4A;
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
      background-color: #ffffff22;
      color: white;
      padding: 8px 14px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      transition: background 0.3s ease;
    }

    .nav-btn:hover {
      background-color: #6E6E6E;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      padding: 8px 16px;
      border-radius: 6px;
      transition: background 0.3s ease;
    }

    .nav-links a:hover {
      background: #6E6E6E;
    }

    .container {
      position: relative;
      z-index: 1;
      width: 600px;
      margin: 120px auto;
      background: rgba(255, 255, 255, 0.96);
      padding: 50px 40px;
      border-radius: 20px;
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.4);
      text-align: center;
    }

    h2 {
      font-size: 28px;
      color: #2c3e50;
      margin-bottom: 25px;
    }

    .search-bar form {
      display: flex;
      justify-content: center;
      gap: 10px;
    }

    .search-bar input {
      flex: 1;
      padding: 14px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .search-bar button {
      padding: 14px 20px;
      background: #4A4A4A;
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      font-size: 16px;
    }

    .search-bar button:hover {
      background: #6E6E6E;
    }

    footer {
      background: #4A4A4A;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: auto;
    }

    .footer-content p {
      margin: 5px 0;
    }
  </style>
</head>
<body>

<!-- Navigation Bar -->
<nav>
  <div class="nav-left">
    <div class="nav-title">Library Dashboard</div>
    <a href="books.php" class="nav-btn">Books</a>
    <a href="loans.php" class="nav-btn">Loans</a>
    <a href="user_account.php" class="nav-btn">User Management</a>
  </div>
  <div class="nav-links">
    <a href="user_loan.php" class="nav-btn">My Loans</a>
    <a href="logout.php">Logout</a>
  </div>
</nav>

<!-- Main Content -->
<div class="container">
  <h2>Search Library</h2>
  <div class="search-bar">
    <form method="GET" action="book_details.php" style="width: 100%;">
      <input type="text" name="query" placeholder="Search by title, author or genre..." required>
      <button type="submit">Search</button>
    </form>
  </div>
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
