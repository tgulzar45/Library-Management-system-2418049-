<?php
session_start();
require "config.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];


$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = :id");
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Profile - Library Management System</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: url('Londonjpg.jpeg') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      position: relative;
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
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
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

    .nav-links a {
      color: white;
      margin-left: 20px;
      text-decoration: none;
      font-weight: 500;
      padding: 8px 16px;
      border-radius: 6px;
      transition: background 0.3s ease;
    }

    .nav-links a:hover {
      background-color: #6E6E6E;
    }

    .container {
      position: relative;
      z-index: 2;
      max-width: 500px;
      margin: 40px auto;
      background: rgba(255, 255, 255, 0.96);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      text-align: center;
    }

    h2 {
      color: #2c3e50;
      margin-bottom: 20px;
    }

    p {
      font-size: 16px;
      margin-bottom: 10px;
      color: #555;
    }

    .btn {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 24px;
      background: #4A4A4A;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .btn:hover {
      background: #333;
    }

    footer {
      position: relative;
      z-index: 2;
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

<nav>
  <div class="nav-left">
    <div class="nav-title">Library System</div>
  </div>
  <div class="nav-links">
    <a href="user_dashboard.php">Dashboard</a>
    <a href="logout.php">Logout</a>
  </div>
</nav>

<div class="container">
  <h2>User Profile</h2>

  <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
  <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

  <a href="change_password.php" class="btn">Change Password</a>
</div>

<footer>
  <div class="footer-content">
    <p class="footer-slogan">Empowering your reading journey — one book at a time.</p>
    <p class="footer-copy">&copy; <?= date("Y") ?> Library Management System. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
