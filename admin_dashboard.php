<?php
session_start();
require "config.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$bookResults = [];
$userResults = [];

if (isset($_GET['search_book'])) {
    $query = '%' . trim($_GET['search_book']) . '%';
    $stmt = $conn->prepare("SELECT * FROM books WHERE title LIKE :query OR author LIKE :query OR isbn LIKE :query");
    $stmt->execute(['query' => $query]);
    $bookResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_GET['search_user'])) {
    $query = '%' . trim($_GET['search_user']) . '%';
    $stmt = $conn->prepare("SELECT * FROM users WHERE name LIKE :query OR email LIKE :query");
    $stmt->execute(['query' => $query]);
    $userResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel - Library System</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: url('Londonjpg.jpeg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .overlay {
      background-color: rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(5px);
      flex: 1;
      padding: 40px;
    }

    nav {
      background-color: #4A4A4A;
      padding: 20px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 10px;
    }

    .nav-title {
      font-size: 20px;
      font-weight: bold;
      color: white;
    }

    .nav-links a {
      margin-left: 20px;
      text-decoration: none;
      color: white;
      font-weight: 500;
      padding: 10px 18px;
      border-radius: 6px;
      transition: background 0.3s ease;
    }

    .nav-links a:hover {
      background-color: #666;
    }

    .search-section {
      margin: 30px auto;
      text-align: center;
    }

    .search-form {
      display: inline-block;
      margin: 10px;
    }

    .search-form input {
      padding: 10px;
      width: 250px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    .search-form button {
      padding: 10px 16px;
      background-color: #4A4A4A;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }

    .search-form button:hover {
      background-color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
      overflow: hidden;
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
      background-color: #f2f2f2;
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
  <div class="overlay">
    <!-- Navigation -->
    <nav>
      <div class="nav-title">Admin Dashboard</div>
      <div class="nav-links">
        <a href="loan_management.php">Book Loan</a>
        <a href="book_management.php">Book Management</a>
        <a href="user_management.php">User Management</a>
        <a href="logout.php">Logout</a>
      </div>
    </nav>

    <div class="search-section">
      <form class="search-form" method="GET">
        <input type="text" name="search_book" placeholder="Search Book by title, author, or ISBN...">
        <button type="submit">Search Book</button>
      </form>

      <form class="search-form" method="GET">
        <input type="text" name="search_user" placeholder="Search User by name or email...">
        <button type="submit">Search User</button>
      </form>
    </div>

    <?php if ($bookResults): ?>
      <table>
        <thead>
          <tr><th>Title</th><th>Author</th><th>Genre</th><th>ISBN</th><th>Quantity</th></tr>
        </thead>
        <tbody>
          <?php foreach ($bookResults as $book): ?>
            <tr>
              <td><?= htmlspecialchars($book['title']) ?></td>
              <td><?= htmlspecialchars($book['author']) ?></td>
              <td><?= htmlspecialchars($book['genre']) ?></td>
              <td><?= htmlspecialchars($book['isbn']) ?></td>
              <td><?= $book['quantity'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <?php if ($userResults): ?>
      <table>
        <thead>
          <tr><th>Name</th><th>Email</th><th>Role</th></tr>
        </thead>
        <tbody>
          <?php foreach ($userResults as $user): ?>
            <tr>
              <td><?= htmlspecialchars($user['name']) ?></td>
              <td><?= htmlspecialchars($user['email']) ?></td>
              <td><?= htmlspecialchars($user['role']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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
