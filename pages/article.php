<?php
$pageTitle = 'Article - Le Pacte de Gray';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Services/ArticleService.php';

$articleId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$pdo = Database::getConnection();
$articleService = new ArticleService($pdo);
$article = $articleService->getArticle($articleId);

if (!$article) {
    header('Location: ' . BASE_URL . 'pages/actualites.php');
    exit;
}
?>

<div class="container my-5">
    <h1 class="mb-3"><?= htmlspecialchars($article->getTitre()) ?></h1>
    <p class="text-muted"><?= htmlspecialchars($article->getCreatedAt()) ?></p>
    <hr>

    <?php if ($article->getImage()) : ?>
    <img src="<?= BASE_URL ?>images/<?= htmlspecialchars($article->getImage()) ?>"
         alt="<?= htmlspecialchars($article->getTitre()) ?>"
         class="img-fluid mb-4 article-detail-image">
    <?php endif; ?>

    <div class="article-contenu">
        <?= nl2br(htmlspecialchars($article->getContenu())) ?>
    </div>

    <a href="<?= BASE_URL ?>pages/actualites.php" class="btn btn-dark mt-4">
        ← Retour aux actualités
    </a>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>