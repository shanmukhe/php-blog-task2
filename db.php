<?php
$host = 'localhost';
$db   = 'blog';
$user = 'root'; // default user for XAMPP
$pass = '';     // default password is empty
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
