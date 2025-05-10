<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/templates/header.php';

/** @var PDO $pdo */
$stmt = $pdo->query("SELECT id, title, created_at, author, intro FROM news ORDER BY created_at DESC");
$articles = $stmt->fetchAll();
?>

<h1 class="mb-4">Latest News</h1>

<?php foreach ($articles as $article): ?>
    <div class="card mb-3">
        <div class="card-body">
            <h3 class="card-title"><?= htmlspecialchars($article['title']) ?></h3>
            <h6 class="card-subtitle text-muted">
                <?= htmlspecialchars($article['author']) ?> |
                <?= date('Y-m-d H:i', strtotime($article['created_at'])) ?>
            </h6>
            <p class="card-text mt-2"><?= nl2br(htmlspecialchars($article['intro'])) ?></p>
            <a href="view.php?id=<?= $article['id'] ?>" class="btn btn-primary">Read more</a>
        </div>
    </div>
<?php endforeach; ?>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
