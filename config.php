<?php
$host = "localhost"; 
$dbname = "Library system"; 
$username = "root"; 
$password = ""; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}
?>
