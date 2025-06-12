<?php
require 'db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $stmt = $pdo->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
    $stmt->execute([$title, $content, $id]);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Edit Post</h2>
<form method="POST">
    Title: <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>"><br>
    Content:<br>
    <textarea name="content"><?= htmlspecialchars($post['content']) ?></textarea><br>
    <button type="submit">Update</button>
</form>
<a href="index.php">← Back</a>
</body>
</html>
