<?php
session_start();
require "config.php";

// Only allow admins
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle book update
if (isset($_POST['update_id'])) {
    $stmt = $conn->prepare("UPDATE books SET title = :title, author = :author, isbn = :isbn, genre = :genre, quantity = :quantity WHERE id = :id");
    $stmt->execute([
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'isbn' => $_POST['isbn'],
        'genre' => $_POST['genre'],
        'quantity' => $_POST['quantity'],
        'id' => $_POST['update_id']
    ]);
    header("Location: book_management.php?msg=updated");
    exit();
}

// Handle new book addition
if (isset($_POST['add_book'])) {
    $stmt = $conn->prepare("INSERT INTO books (title, author, isbn, genre, quantity) VALUES (:title, :author, :isbn, :genre, :quantity)");
    $stmt->execute([
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'isbn' => $_POST['isbn'],
        'genre' => $_POST['genre'],
        'quantity' => $_POST['quantity']
    ]);
    header("Location: book_management.php?msg=added");
    exit();
}

// Handle book deletion
if (isset($_POST['delete_id'])) {
    $bookId = $_POST['delete_id'];

    // Delete from borrowed_books first
    $conn->prepare("DELETE FROM borrowed_books WHERE book_id = :book_id")->execute(['book_id' => $bookId]);

    // Delete the book
    $stmt = $conn->prepare("DELETE FROM books WHERE id = :id");
    $stmt->execute(['id' => $bookId]);

    header("Location: book_management.php?msg=deleted");
    exit();
}

// Fetch books
$stmt = $conn->query("SELECT * FROM books ORDER BY id DESC");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Management</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: url('Londonjpg.jpeg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    h2 {
      text-align: center;
      margin-top: 30px;
    }

    .form-box, table {
      background: white;
      padding: 20px;
      border-radius: 12px;
      margin: 30px auto;
      max-width: 1100px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    input {
      padding: 10px;
      width: 100%;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    button {
      background: #4A4A4A;
      color: white;
      border: none;
      padding: 10px 16px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    button:hover {
      background: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background: #4A4A4A;
      color: white;
    }

    .action-buttons {
      display: flex;
      gap: 8px;
    }

    .action-buttons form {
      display: inline;
    }

    .msg {
      text-align: center;
      font-weight: bold;
      margin-bottom: 20px;
      color: green;
    }

    .back-btn {
      display: block;
      width: fit-content;
      margin: 0 auto 30px;
      background: #4A4A4A;
      color: white;
      padding: 12px 20px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
    }

    .back-btn:hover {
      background: #333;
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
  <div class="overlay">
    <a href="admin_dashboard.php" class="back-btn">⬅ Back to Dashboard</a>

    <h2>Book Management</h2>

    <?php if (isset($_GET['msg'])): ?>
      <p class="msg">
        <?= $_GET['msg'] === 'added' ? '✅ Book added successfully!' : '' ?>
        <?= $_GET['msg'] === 'updated' ? '✅ Book updated successfully!' : '' ?>
        <?= $_GET['msg'] === 'deleted' ? '🗑️ Book deleted successfully!' : '' ?>
      </p>
    <?php endif; ?>

    <div class="form-box">
      <h3>Add New Book</h3>
      <form method="POST">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="author" placeholder="Author" required>
        <input type="text" name="isbn" placeholder="ISBN" required>
        <input type="text" name="genre" placeholder="Genre" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <button type="submit" name="add_book">Add Book</button>
      </form>
    </div>

    <table>
      <thead>
        <tr>
          <th>Title</th><th>Author</th><th>Genre</th><th>ISBN</th><th>Quantity</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($books as $book): ?>
          <tr>
            <form method="POST">
              <td><input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required></td>
              <td><input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required></td>
              <td><input type="text" name="genre" value="<?= htmlspecialchars($book['genre']) ?>" required></td>
              <td><input type="text" name="isbn" value="<?= htmlspecialchars($book['isbn']) ?>" required></td>
              <td><input type="number" name="quantity" value="<?= htmlspecialchars($book['quantity']) ?>" required></td>
              <td class="action-buttons">
                <input type="hidden" name="update_id" value="<?= $book['id'] ?>">
                <button type="submit">Modify</button>
            </form>
            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this book?')">
              <input type="hidden" name="delete_id" value="<?= $book['id'] ?>">
              <button type="submit">Delete</button>
            </form>
              </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <footer>
    <div class="footer-content">
      <p class="footer-slogan">Empowering your reading journey — one book at a time.</p>
      <p class="footer-copy">&copy; <?= date("Y") ?> Library Management System. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
