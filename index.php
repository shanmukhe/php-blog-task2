<?php require 'db.php'; ?>
<?php include 'header.php'; ?>
<link rel="stylesheet" href="style.css">

<div class="crud-container">
    <h2 class="blog-title">🔍 SEARCH BLOG POSTS</h2>

    <!-- Search Form -->
    <form method="GET" style="margin-bottom: 30px;">
        <input type="text" name="search" placeholder="Search by title or content" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" />
        <button type="submit">Search</button>
    </form>

    <!-- Add Post Button -->
    <div class="add-post-button">
        <a href="create.php" class="btn-add-post">➕ Add New Post</a>
    </div>

    <hr>

    <?php
    // Get search query and pagination values
    $search = $_GET['search'] ?? '';
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = 5;
    $offset = ($page - 1) * $limit;

    // Count total matching posts
    // Modified query to include JOIN for counting
    $countStmt = $pdo->prepare("SELECT COUNT(*) FROM posts p LEFT JOIN users u ON p.user_id = u.id WHERE p.title LIKE :search_term OR p.content LIKE :search_term");
    $countStmt->bindValue(':search_term', "%$search%", PDO::PARAM_STR);
    $countStmt->execute();
    $totalPosts = $countStmt->fetchColumn();
    $totalPages = ceil($totalPosts / $limit);

    // Fetch matching posts with pagination and author information
    $stmt = $pdo->prepare("SELECT p.*, u.username FROM posts p LEFT JOIN users u ON p.user_id = u.id WHERE p.title LIKE :search_term OR p.content LIKE :search_term ORDER BY p.created_at DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':search_term', "%$search%", PDO::PARAM_STR); // Bind search term
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT); // Bind limit
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT); // Bind offset
    $stmt->execute();
    $posts = $stmt->fetchAll();

    // Display posts
    // Display posts
foreach ($posts as $post):
?>
    <div class="post-box">
        <h3><?= htmlspecialchars($post['title']) ?></h3>
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        <small>🕒 <?= $post['created_at'] ?> by <strong><?= htmlspecialchars($post['username']) ?></strong></small><br>

        <div class="post-actions">
    <a class="btn-action" href="edit.php?id=<?= $post['id'] ?>">✏️ Edit</a>
    <a class="btn-action delete" href="delete.php?id=<?= $post['id'] ?>">🗑️ Delete</a>

    <!-- Like Button beside Edit/Delete -->
    <form method="POST" action="like.php" style="display:inline;">
        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
        <button type="submit" class="btn-action">👍 Like</button>
    </form>
</div>


        <!-- Show like count -->
        <?php
        $likeCount = $pdo->prepare("SELECT COUNT(*) FROM likes WHERE post_id = ?");
        $likeCount->execute([$post['id']]);
        $totalLikes = $likeCount->fetchColumn();
        ?>
        <p style="margin-left: 10px;">❤️ <?= $totalLikes ?> likes</p>

        <!-- Comment Form -->
        <form method="POST" action="comment.php" style="margin-top: 10px;">
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
            <input type="text" name="content" placeholder="Add a comment..." required style="width: 80%;">
            <button type="submit" class="btn-action">💬 Comment</button>
        </form>

        <!-- Show Comments -->
        <div class="comment-section" style="margin-top: 10px; padding-left: 20px;">
        <?php
        $comments = $pdo->prepare("SELECT c.content, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = ?");
        $comments->execute([$post['id']]);
        foreach ($comments as $comment):
        ?>
            <p><strong><?= htmlspecialchars($comment['username']) ?>:</strong> <?= htmlspecialchars($comment['content']) ?></p>
        <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
    <!-- Pagination -->
    <div style="text-align:center; margin-top: 25px;">
        <?php if ($page > 1): ?>
            <a href="?search=<?= urlencode($search) ?>&page=<?= $page - 1 ?>">⬅️ Prev</a>
        <?php endif; ?>
        <strong>Page <?= $page ?> of <?= $totalPages ?></strong>
        <?php if ($page < $totalPages): ?>
            <a href="?search=<?= urlencode($search) ?>&page=<?= $page + 1 ?>">Next ➡️</a>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
