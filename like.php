<?php
session_start();
require 'db.php';

if (isset($_POST['post_id']) && isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("INSERT INTO likes (user_id, post_id) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user_id'], $_POST['post_id']]);
}

header("Location: index.php");
exit;
?>
