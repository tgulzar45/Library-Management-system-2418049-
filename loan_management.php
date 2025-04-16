<?php
session_start();
require "config.php";


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}


if (isset($_GET['return_id'])) {
    $returnId = (int)$_GET['return_id'];
    $stmt = $conn->prepare("UPDATE borrowed_books SET return_date = NOW() WHERE id = :id");
    $stmt->execute(['id' => $returnId]);
    header("Location: loan_management.php?msg=returned");
    exit();
}


try {
    $stmt = $conn->query("
        SELECT 
            bb.id AS borrow_id,
            b.title, 
            b.author,
            u.name AS user_name,
            u.email,
            bb.borrow_date,
            bb.return_date
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
  <meta charset="UTF-8">
  <title>Loan Management - Library System</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: url('Londonjpg.jpeg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .container {
      background: rgba(255, 255, 255, 0.95);
      margin: 50px auto;
      padding: 30px;
      border-radius: 12px;
      max-width: 1100px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #2c3e50;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ccc;
      text-align: left;
      font-size: 15px;
      color: #333;
    }

    th {
      background: #4A4A4A;
      color: white;
    }

    tr:hover {
      background: #f9f9f9;
    }

    .return-btn {
      background: #4A4A4A;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      transition: background 0.3s ease;
    }

    .return-btn:hover {
      background: #222;
    }

    .returned {
      color: green;
      font-weight: bold;
    }

    .back-btn {
      display: block;
      width: fit-content;
      margin: 0 auto 20px;
      background: #4A4A4A;
      color: white;
      padding: 12px 20px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
    }

    .back-btn:hover {
      background: #333;
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

<div class="container">
  <a href="admin_dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
  <h2>Loan Records</h2>

  <?php if (!empty($loans)): ?>
    <table>
      <thead>
        <tr>
          <th>User</th>
          <th>Email</th>
          <th>Title</th>
          <th>Author</th>
          <th>Borrow Date</th>
          <th>Return Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($loans as $loan): ?>
          <tr>
            <td><?= htmlspecialchars($loan['user_name']) ?></td>
            <td><?= htmlspecialchars($loan['email']) ?></td>
            <td><?= htmlspecialchars($loan['title']) ?></td>
            <td><?= htmlspecialchars($loan['author']) ?></td>
            <td><?= date('Y-m-d', strtotime($loan['borrow_date'])) ?></td>
            <td>
              <?= $loan['return_date'] 
                ? '<span class="returned">' . date('Y-m-d', strtotime($loan['return_date'])) . '</span>' 
                : '<span style="color:#c0392b;">Not Returned</span>' ?>
            </td>
            <td>
              <?php if (!$loan['return_date']): ?>
                <a href="loan_management.php?return_id=<?= $loan['borrow_id'] ?>" class="return-btn">Return</a>
              <?php else: ?>
                <span class="returned">✔</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p style="text-align:center; color: red;">No loan records found.</p>
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
