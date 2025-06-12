<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Welcome to your Dashboard</h2>
<a href="create.php">Create a New Post</a> | 
<a href="index.php">View All Posts</a> | 
<a href="logout.php">Logout</a>
</body>
</html>
