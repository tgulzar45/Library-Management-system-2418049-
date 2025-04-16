<?php
$host = "localhost"; 
$dbname = "Library system"; // Make sure this matches your actual database name
$username = "root"; 
$password = ""; // XAMPP default is empty, do not change unless you set a password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}
?>
