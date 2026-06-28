<?php
$pageTitle = 'L\'Univers - Le Pacte de Gray';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Services/PersonnageService.php';
require_once __DIR__ . '/../src/Services/LieuService.php';

$pdo = Database::getConnection();
$personnageService = new PersonnageService($pdo);
$lieuService = new LieuService($pdo);

$personnages = $personnageService->getPersonnages();
$lieux = $lieuService->getLieux();
?>
<div class="container my-5">
    <h1 class="text-center mb-5">L'Univers</h1>

    <!-- Section Personnages -->
    <h2 class="mb-4">Les Personnages</h2>
    <div class="row">
        <?php foreach ($personnages as $p) : ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0">
                <img src="<?= BASE_URL ?>images/<?= htmlspecialchars($p->getImage()) ?>"
                     alt="<?= htmlspecialchars($p->getNom()) ?>"
                     class="card-img-top personnage-image">
                <div class="card-body text-center">
                    <h3><?= htmlspecialchars($p->getPrenom()) ?> <?= htmlspecialchars($p->getNom()) ?></h3>
                    <p class="text-muted"><?= htmlspecialchars($p->getRang()) ?></p>
                    <p><em><?= htmlspecialchars($p->getStatut()) ?></em></p>
                    <a href="<?= BASE_URL ?>pages/personnage.php?id=<?= $p->getPersonnageId() ?>" class="btn btn-dark btn-sm">
                        Découvrir
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Section Lieux -->
    <h2 class="mt-5 mb-4">Les Lieux</h2>
    <div class="row">
        <?php foreach ($lieux as $l) : ?>
        <div class="col-md-6 mb-4">
            <div class="card h-100 border-0">
                <img src="<?= BASE_URL ?>images/<?= htmlspecialchars($l->getImage()) ?>"
                     alt="<?= htmlspecialchars($l->getNom()) ?>"
                     class="card-img-top lieu-image">
                <div class="card-body">
                    <h3><?= htmlspecialchars($l->getNom()) ?></h3>
                    <p><?= htmlspecialchars($l->getVille()) ?>, <?= htmlspecialchars($l->getPays()) ?></p>
                    <p><?= htmlspecialchars($l->getDescription()) ?></p>
                    <a href="<?= BASE_URL ?>pages/lieu.php?id=<?= $l->getLieuId() ?>" class="btn btn-dark btn-sm">
                        Découvrir
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>