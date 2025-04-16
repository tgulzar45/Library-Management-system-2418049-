<?php
session_start();
require "config.php";


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'role' => $role
    ]);
    header("Location: user_management.php?msg=added");
    exit();
}


if (isset($_GET['delete'])) {
    $deleteId = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $deleteId]);
    header("Location: user_management.php?msg=deleted");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modify_user'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id");
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'role' => $role,
        'id' => $id
    ]);
    header("Location: user_management.php?msg=updated");
    exit();
}


$stmt = $conn->query("SELECT * FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Management</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: url('Londonjpg.jpeg') no-repeat center center fixed;
      background-size: cover;
      color: #2E2E2E;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    h2 {
      text-align: center;
      color: #2E2E2E;
      margin-bottom: 30px;
    }
    .form-box, table {
      background: white;
      padding: 20px;
      border-radius: 12px;
      margin: 40px auto;
      max-width: 1000px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
      color: #2E2E2E;
    }
    .form-box h3 {
      margin-top: 0;
      margin-bottom: 15px;
      color: #2E2E2E;
    }
    .msg {
      text-align: center;
      font-weight: bold;
      color: green;
      margin-bottom: 20px;
    }
    input, select {
      padding: 10px;
      width: 100%;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      color: #2E2E2E;
    }
    button {
      background: #2E2E2E;
      color: white;
      border: none;
      padding: 10px;
      min-width: 70px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      text-align: center;
    }
    button:hover {
      background: #1f1f1f;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      color: #2E2E2E;
    }
    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background: #2E2E2E;
      color: white;
    }
    .action-buttons {
      display: flex;
      gap: 10px;
    }
    .action-buttons form {
      display: inline;
    }
    .action-buttons button {
      padding: 10px;
      min-width: 70px;
      border-radius: 6px;
      font-weight: bold;
      font-size: 14px;
    }
    .modify {
      background: #2E2E2E;
    }
    .modify:hover {
      background: #1f1f1f;
    }
    .delete {
      background: #2E2E2E;
      color: white;
      text-decoration: none;
      padding: 10px;
      border-radius: 6px;
      font-weight: bold;
      font-size: 14px;
      display: inline-block;
      min-width: 70px;
      text-align: center;
    }
    .delete:hover {
      background: #1f1f1f;
    }
    .back-btn {
      display: inline-block;
      margin: 20px;
      padding: 10px 20px;
      background: #2E2E2E;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
    }
    .back-btn:hover {
      background: #1f1f1f;
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
    <h2>User Management</h2>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
      <div class="msg">User details updated successfully.</div>
    <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'added'): ?>
      <div class="msg">User added successfully.</div>
    <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
      <div class="msg">User deleted successfully.</div>
    <?php endif; ?>

    <div class="form-box">
      <h3>Add New User</h3>
      <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role" required>
          <option value="">Select Role</option>
          <option value="admin">Admin</option>
          <option value="user">User</option>
        </select>
        <button type="submit" name="add_user">Add</button>
      </form>
    </div>

    <table>
      <thead>
        <tr>
          <th>Name</th><th>Email</th><th>Role</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <form method="POST">
              <td><input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required></td>
              <td><input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required></td>
              <td>
                <select name="role" required>
                  <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                  <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                </select>
              </td>
              <td class="action-buttons">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <button type="submit" name="modify_user" class="modify">Modify</button>
                <a href="?delete=<?= $user['id'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
              </td>
            </form>
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
