<?php require 'db.php'; ?>
<?php include 'header.php'; ?>
<link rel="stylesheet" href="style.css">
<div class="crud-container">
    <h2 class="blog-title">📝 All Blog Posts</h2>
    <div class="add-post-button">
        <a href="create.php" class="btn-add-post">➕ Add New Post</a>
    </div>
    <hr>

    <?php
    $posts = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
    foreach ($posts as $post):
    ?>
        <div class="post-box">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
            <small>🕒 <?= $post['created_at'] ?></small><br>
            <div class="post-actions">
                <a class="btn-action" href="edit.php?id=<?= $post['id'] ?>">✏️ Edit</a>
                <a class="btn-action delete" href="delete.php?id=<?= $post['id'] ?>">🗑️ Delete</a>
            </div>
        </div>
        <hr>
    <?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>
