<?php
$pageTitle = 'Personnage - Le Pacte de Gray';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Services/PersonnageService.php';

$personnageId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$pdo = Database::getConnection();
$personnageService = new PersonnageService($pdo);
$data = $personnageService->getPersonnageComplet($personnageId);

if (!$data) {
    header('Location: ' . BASE_URL . 'pages/univers.php');
    exit;
}

$personnage = $data['personnage'];
$lieux = $data['lieux'];
?>
<div class="container my-5">
    <div class="row">
        
        <!-- Image du personnage -->
        <div class="col-md-4 text-center">
            <img src="<?= BASE_URL ?>images/<?= htmlspecialchars($personnage->getImage()) ?>"
                 alt="<?= htmlspecialchars($personnage->getNom()) ?>"
                 class="img-fluid personnage-detail-image">
        </div>

        <!-- Infos du personnage -->
        <div class="col-md-8">
            <h1><?= htmlspecialchars($personnage->getPrenom()) ?> <?= htmlspecialchars($personnage->getNom()) ?></h1>
            <p class="text-muted"><?= htmlspecialchars($personnage->getRang()) ?> — <?= htmlspecialchars($personnage->getStatut()) ?></p>
            <hr>
            
            <?php if ($personnage->getCitation()) : ?>
            <blockquote class="blockquote">
                <p><em>"<?= htmlspecialchars($personnage->getCitation()) ?>"</em></p>
            </blockquote>
            <hr>
            <?php endif; ?>

            <p><?= htmlspecialchars($personnage->getDescription()) ?></p>

            <ul class="list-unstyled mt-3">
                <?php if ($personnage->getAge()) : ?>
                    <li><strong>Âge :</strong> <?= htmlspecialchars($personnage->getAge()) ?></li>
                <?php endif; ?>
                <?php if ($personnage->getVille()) : ?>
                    <li><strong>Ville :</strong> <?= htmlspecialchars($personnage->getVille()) ?></li>
                <?php endif; ?>
                <?php if ($personnage->getPays()) : ?>
                    <li><strong>Pays :</strong> <?= htmlspecialchars($personnage->getPays()) ?></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- Lieux associés -->
    <?php if (!empty($lieux)) : ?>
    <div class="mt-5">
        <h2 class="mb-4">Lieux associés</h2>
        <div class="row">
            <?php foreach ($lieux as $l) : ?>
            <div class="col-md-4 mb-3">
                <div class="card border-0">
                    <div class="card-body">
                        <h5><?= htmlspecialchars($l->getNom()) ?></h5>
                        <p class="text-muted small"><?= htmlspecialchars($l->getVille()) ?></p>
                        <a href="<?= BASE_URL ?>pages/lieu.php?id=<?= $l->getLieuId() ?>" class="btn btn-dark btn-sm">
                            Voir
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>