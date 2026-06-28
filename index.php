<?php
$pageTitle = 'Le Pacte de Gray - Accueil';
require_once 'includes/header.php';
require_once 'src/Database.php';
require_once 'src/Services/PersonnageService.php';

$pdo = Database::getConnection();
$personnageService = new PersonnageService($pdo);
$personnages = $personnageService->getPersonnages();
?>

<!-- Accueil : livre centré, personnages autour -->
<div class="container my-5">
    
    <!-- Ligne du haut : P1 + Livre + P2 -->
    <div class="row align-items-center justify-content-center">
        
        <!-- Personnage 1 (Dorian) -->
        <div class="col-md-3 text-center">
            <?php if (isset($personnages[0])) : $p = $personnages[0]; ?>
            <img src="<?= BASE_URL ?>images/<?= htmlspecialchars($p->getImage()) ?>" 
                 alt="<?= htmlspecialchars($p->getNom()) ?>"
                 class="personnage-image img-fluid mb-3">
            <h4><?= htmlspecialchars($p->getPrenom()) ?> <?= htmlspecialchars($p->getNom()) ?></h4>
            <p class="text-muted small"><?= htmlspecialchars($p->getRang()) ?></p>
            <?php endif; ?>
        </div>

        <!-- Couverture du livre au centre -->
        <div class="col-md-4 text-center">
            <img src="<?= BASE_URL ?>images/couverture.jpg" 
                 alt="Le Portrait de Dorian Gray" 
                 class="img-fluid couverture-livre">
            <h1 class="mt-4">Le Pacte de Gray</h1>
            <p class="text-muted">Oscar Wilde — 1890</p>
        </div>

        <!-- Personnage 2 (Lord Henry) -->
        <div class="col-md-3 text-center">
            <?php if (isset($personnages[1])) : $p = $personnages[1]; ?>
            <img src="<?= BASE_URL ?>images/<?= htmlspecialchars($p->getImage()) ?>" 
                 alt="<?= htmlspecialchars($p->getNom()) ?>"
                 class="personnage-image img-fluid mb-3">
            <h4><?= htmlspecialchars($p->getPrenom()) ?> <?= htmlspecialchars($p->getNom()) ?></h4>
            <p class="text-muted small"><?= htmlspecialchars($p->getRang()) ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Ligne du bas : P3 centré + présentation + Amazon -->
    <div class="row justify-content-center mt-4">
        
        <!-- Personnage 3 (Basil) -->
        <div class="col-md-3 text-center">
            <?php if (isset($personnages[2])) : $p = $personnages[2]; ?>
            <img src="<?= BASE_URL ?>images/<?= htmlspecialchars($p->getImage()) ?>" 
                 alt="<?= htmlspecialchars($p->getNom()) ?>"
                 class="personnage-image img-fluid mb-3">
            <h4><?= htmlspecialchars($p->getPrenom()) ?> <?= htmlspecialchars($p->getNom()) ?></h4>
            <p class="text-muted small"><?= htmlspecialchars($p->getRang()) ?></p>
            <?php endif; ?>
        </div>

        <!-- Présentation + Amazon -->
       <div class="col-md-6 text-center">
        <p class="separateur">⸻✦⸻</p>
        <p class="mt-3">Un chef-d'œuvre gothique sur la beauté, la corruption et le prix de l'immortalité.</p>
        <p class="separateur">⸻✦⸻</p>
        <a href="https://www.amazon.fr/Portrait-Dorian-Gray-Oscar-Wilde/dp/2070360261" 
        target="_blank" class="btn btn-outline-light mt-2">
            Lire le roman →
        </a>
    </div>
        </div>
    </div>

<?php require_once 'includes/footer.php'; ?>