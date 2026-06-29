<?php
$pageTitle = 'Actualités - Le Pacte de Gray';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Services/ArticleService.php';

$pdo = Database::getConnection();
$articleService = new ArticleService($pdo);
$articles = $articleService->getArticles();
?>
<div class="container my-5">
    <h1 class="text-center mb-5">Actualités</h1>

    <?php if (empty($articles)) : ?>
        <p class="text-center text-muted">Aucune actualité pour le moment.</p>
    <?php else : ?>
        <div class="row">
            <?php foreach ($articles as $a) : ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0">
                    <?php if ($a->getImage()) : ?>
                    <img src="<?= BASE_URL ?>images/<?= htmlspecialchars($a->getImage()) ?>"
                         alt="<?= htmlspecialchars($a->getTitre()) ?>"
                         class="card-img-top article-image">
                    <?php endif; ?>
                    <div class="card-body">
                        <h3><?= htmlspecialchars($a->getTitre()) ?></h3>
                        <p class="text-muted small"><?=date('d/m/Y', strtotime($a->getCreatedAt())) ?></p>
                        <p><?= htmlspecialchars(substr($a->getContenu(), 0, 150)) ?>...</p>
                        <a href="<?= BASE_URL ?>pages/article.php?id=<?= $a->getArticleId() ?>" class="btn btn-dark btn-sm">
                            Lire la suite
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>