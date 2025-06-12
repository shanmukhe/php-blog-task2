<?php
session_start();
require 'db.php';
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Create a New Post</h2>
<form method="POST" class="create-post-form" action="create.php">
    Title: <input type="text" name="title"><br>
    Content:<br>
    <textarea name="content"></textarea><br>
    <button type="submit">Create Post</button>
</form>
<a href="index.php">← Back</a>
</body>
</html>
