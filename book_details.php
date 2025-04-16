<?php
session_start();
require "config.php";

// Check if user is logged in
$user_id = $_SESSION['user_id'] ?? null;
$role = $_SESSION['role'] ?? null;

// Handle search
$searchQuery = isset($_GET['query']) ? trim($_GET['query']) : "";
$books = [];

if (!empty($searchQuery)) {
    $stmt = $conn->prepare("SELECT * FROM books WHERE LOWER(title) LIKE LOWER(:query)");
    $stmt->execute(['query' => "%$searchQuery%"]);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Book Details - Library Management System</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Inter', sans-serif;
      background: url('Londonjpg.jpeg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      text-align: center;
    }

    .container {
      max-width: 900px;
      margin: 60px auto;
      background: #ffffff;
      padding: 40px;
      border-radius: 18px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    h2 {
      color: #4A4A4A;
      font-size: 30px;
      margin-bottom: 30px;
    }

    .book {
      margin-bottom: 30px;
      padding: 20px 25px;
      border-radius: 14px;
      background-color: #f4f4f4;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      text-align: left;
    }

    .book h3 {
      color: #4A4A4A;
      margin-bottom: 10px;
    }

    .book p {
      margin: 4px 0;
      font-size: 15px;
      color: #555;
    }

    .no-result {
      color: #c0392b;
      font-size: 18px;
      margin-top: 20px;
    }

    .back-btn {
      display: inline-block;
      margin-top: 30px;
      padding: 12px 24px;
      background: #4A4A4A;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .back-btn:hover {
      background: #333;
    }

    @media (max-width: 768px) {
      .container {
        margin: 30px 15px;
        padding: 25px;
      }

      .book h3 { font-size: 18px; }
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Book Details</h2>

  <?php if (!empty($books)): ?>
    <?php foreach ($books as $book): ?>
      <div class="book">
        <h3><?= htmlspecialchars($book['title']); ?></h3>
        <p><strong>Author:</strong> <?= htmlspecialchars($book['author']); ?></p>
        <p><strong>Genre:</strong> <?= htmlspecialchars($book['genre']); ?></p>
        <p><strong>ISBN:</strong> <?= htmlspecialchars($book['isbn']); ?></p>
        <p><strong>Quantity Available:</strong> <?= htmlspecialchars($book['quantity']); ?></p>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="no-result">No books found for "<strong><?= htmlspecialchars($searchQuery); ?></strong>"</p>
  <?php endif; ?>

  <a href="<?= isset($_SESSION['user_id']) ? 'user_dashboard.php' : 'index.html' ?>" class="back-btn">Back to Home</a>
</div>

</body>
</html>
