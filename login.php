<?php
session_start();
require "config.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    if (empty($email) || empty($password) || empty($role)) {
        $error = "All fields are required.";
    } else {
        try {
            $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = :email AND role = :role LIMIT 1");
            $stmt->execute(['email' => $email, 'role' => $role]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];

                header("Location: " . ($user['role'] === 'admin' ? 'admin_dashboard.php' : 'user_dashboard.php'));
                exit();
            } else {
                $error = "Incorrect email, password, or role.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Library Management System</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: url('Londonjpg.jpeg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    body::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 0;
    }

    .top-bar {
      position: absolute;
      top: 20px;
      right: 30px;
      z-index: 2;
    }

    .top-bar a {
      text-decoration: none;
      padding: 10px 18px;
      border-radius: 30px;
      background: #ffffff;
      color: #4A4A4A;
      font-weight: 600;
      font-size: 14px;
      border: 2px solid #4A4A4A;
      transition: 0.3s;
    }

    .top-bar a:hover {
      background-color: #4A4A4A;
      color: white;
    }

    .container {
      position: relative;
      z-index: 1;
      background: white;
      padding: 40px 30px;
      border-radius: 12px;
      width: 360px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      text-align: center;
    }

    h2 {
      margin-bottom: 25px;
      font-size: 28px;
      color: #333;
    }

    form input, form select {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      font-size: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      outline: none;
    }

    form button {
      width: 100%;
      background: #4A4A4A;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 6px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    form button:hover {
      background: #333;
    }

    .forgot-password {
      text-align: right;
      margin: -5px 0 10px;
    }

    .forgot-password a {
      font-size: 13px;
      color: #4A4A4A;
      text-decoration: none;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }

    .message {
      font-size: 14px;
      margin-bottom: 10px;
      color: red;
    }

    .message.success {
      color: green;
    }

    p {
      margin-top: 15px;
      font-size: 14px;
    }

    a {
      color: #4A4A4A;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    footer {
      position: absolute;
      bottom: 10px;
      width: 100%;
      text-align: center;
      color: white;
      font-size: 13px;
      z-index: 1;
    }

    .footer-content {
      background: rgba(0, 0, 0, 0.6);
      padding: 10px 20px;
      border-radius: 8px;
      display: inline-block;
    }

    .footer-slogan {
      margin-bottom: 5px;
      font-weight: 500;
    }
  </style>
</head>
<body>

<!-- Home Button -->
<div class="top-bar">
  <a href="index.html">Home</a>
</div>

<div class="container">
  <h2>Login</h2>

  <?php if (isset($error)): ?>
    <p class="message"><?= htmlspecialchars($error); ?></p>
  <?php endif; ?>

  <?php if (isset($_GET['success']) && $_GET['success'] === 'registered'): ?>
    <p class="message success">Registration successful! Please log in.</p>
  <?php endif; ?>

  <form method="POST" action="login.php">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <div class="forgot-password">
      <a href="forgot_password.php">Forgot password?</a>
    </div>

    <select name="role" required>
      <option value="">Select Role</option>
      <option value="admin">Admin</option>
      <option value="user">User</option>
    </select>

    <button type="submit">Login</button>
  </form>

  <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>
</body>
</html>
