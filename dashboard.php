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
<?php include 'header.php'; ?>

<div class="dashboard-container">
    <h2 class="blog-title">👋 Welcome to your Dashboard</h2>
    <div class="dashboard-links">
        <a href="create.php" class="btn-action">✍️ Create a New Post</a>
        <a href="index.php" class="btn-action">📖 View All Posts</a>
        <a href="logout.php" class="btn-action delete">🚪 Logout</a>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
