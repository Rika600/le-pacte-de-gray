<?php
$pageTitle = 'Lieu - Le Pacte de Gray';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Services/LieuService.php';

$lieuId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$pdo = Database::getConnection();
$lieuService = new LieuService($pdo);
$data = $lieuService->getLieuComplet($lieuId);

if (!$data) {
    header('Location: ' . BASE_URL . 'pages/univers.php');
    exit;
}

$lieu = $data['lieu'];
?>
<div class="container my-5">
    <div class="row">
        
        <!-- Image du lieu -->
        <div class="col-md-5 text-center">
            <img src="<?= BASE_URL ?>images/<?= htmlspecialchars($lieu->getImage()) ?>"
                 alt="<?= htmlspecialchars($lieu->getNom()) ?>"
                 class="img-fluid lieu-detail-image">
        </div>

        <!-- Infos du lieu -->
        <div class="col-md-7">
            <h1><?= htmlspecialchars($lieu->getNom()) ?></h1>
            <p class="text-muted">
                <?= htmlspecialchars($lieu->getVille()) ?>, <?= htmlspecialchars($lieu->getPays()) ?>
            </p>
            <hr>
            <p><?= htmlspecialchars($lieu->getDescription()) ?></p>
            
            <a href="<?= BASE_URL ?>pages/univers.php" class="btn btn-dark mt-3">
                ← Retour à l'univers
            </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>