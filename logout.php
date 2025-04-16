<?php
session_start(); 


if (isset($_SESSION['user_id'])) {
    
    session_unset();
    session_destroy();

    
    header("Location: login.php?message=logged_out");
    exit();
} else {
    
    header("Location: login.php");
    exit();
}
?>
