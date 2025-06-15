<?php
session_start();
require 'db.php';

if (isset($_POST['post_id'], $_POST['content'], $_SESSION['user_id'])) {
    $stmt = $pdo->prepare("INSERT INTO comments (user_id, post_id, content) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $_POST['post_id'], $_POST['content']]);
}

header("Location: index.php");
exit;
?>
