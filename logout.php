<?php
session_start(); // Start session

// Check if the user is logged in before attempting to log out
if (isset($_SESSION['user_id'])) {
    // Destroy the session
    session_unset();
    session_destroy();

    // Redirect to login page with a success message
    header("Location: login.php?message=logged_out");
    exit();
} else {
    // If no session exists, redirect directly to login page
    header("Location: login.php");
    exit();
}
?>