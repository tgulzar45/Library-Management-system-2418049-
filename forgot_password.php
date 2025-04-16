<?php
require "config.php";
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(16));
        $expires = date("Y-m-d H:i:s", strtotime('+1 hour'));

        $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (:email, :token, :expires_at)");
        $stmt->execute([
            'email' => $email,
            'token' => $token,
            'expires_at' => $expires
        ]);

        
        $resetLink = "http://yourdomain.com/reset_password.php?token=$token";
        mail($email, "Reset Your Password", "Click the link to reset your password: $resetLink");

        $msg = "✅ Password reset link sent to your email.";
    } else {
        $msg = "❌ Email not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Forgot Password</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: url('Londonjpg.jpeg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      position: relative;
    }

    body::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 0;
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
      font-size: 24px;
      color: #2E2E2E;
    }

    form input {
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
      background: #2E2E2E;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 6px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
    }

    form button:hover {
      background: #1f1f1f;
    }

    .message {
      margin-top: 15px;
      font-size: 14px;
      font-weight: bold;
      color: #2E2E2E;
    }

    .back-link {
      display: inline-block;
      margin-top: 20px;
      color: #2E2E2E;
      text-decoration: none;
      font-weight: 500;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Forgot Password</h2>
    <form method="POST">
      <input type="email" name="email" placeholder="Enter your email" required>
      <button type="submit">Send Reset Link</button>
    </form>
    <?php if (!empty($msg)): ?>
      <p class="message"><?= $msg ?></p>
    <?php endif; ?>
    <a class="back-link" href="login.php">← Back to Login</a>
  </div>
</body>
</html>
