<?php
session_start();
?>

<nav style="background: #6a11cb; padding: 10px; text-align: center;">
    <?php if (isset($_SESSION['role'])): ?>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="admin_dashboard.php" style="color: white; margin-right: 15px;">Dashboard</a>
            <a href="manage_books.php" style="color: white; margin-right: 15px;">Manage Books</a>
            <a href="manage_users.php" style="color: white; margin-right: 15px;">Manage Users</a>
            <a href="view_loans.php" style="color: white; margin-right: 15px;">View Loans</a>
        <?php else: ?>
            <a href="user_dashboard.php" style="color: white; margin-right: 15px;">Home</a>
            <a href="search_books.php" style="color: white; margin-right: 15px;">Search Books</a>
            <a href="borrow_book.php" style="color: white; margin-right: 15px;">Borrow</a>
            <a href="return_book.php" style="color: white; margin-right: 15px;">Return</a>
        <?php endif; ?>
        <a href="logout.php" style="color: red; font-weight: bold;">Logout</a>
    <?php else: ?>
        <a href="login.php" style="color: white; margin-right: 15px;">Login</a>
        <a href="register.php" style="color: white;">Register</a>
    <?php endif; ?>
</nav>
