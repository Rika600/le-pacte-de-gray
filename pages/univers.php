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
    <h1 class="text-center mb-3">L'Univers</h1>

    <!-- Bouton filtre en haut à gauche -->
    <div class="mb-4">
        <button id="btn-toggle-filtres" class="btn p-0" aria-label="Ouvrir les filtres">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                <path d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </button>
    </div>

    <!-- Panneau filtres -->
    <div id="filtres-panel" class="mb-4" style="display: none;">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="filtre-type" class="form-label">Type</label>
                <select id="filtre-type" class="form-select">
                    <option value="">Tous</option>
                    <option value="personnage">Personnages</option>
                    <option value="lieu">Lieux</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="filtre-categorie" class="form-label">Catégorie</label>
                <select id="filtre-categorie" class="form-select">
                    <option value="">Toutes</option>
                    <option value="1">Personnages principaux</option>
                    <option value="2">Personnages secondaires</option>
                    <option value="4">Lieux clés</option>
                    <option value="5">Londres victorienne</option>
                </select>
            </div>
        </div>
        <div class="mt-3">
            <button id="btn-filtrer" class="btn btn-dark px-4">Filtrer</button>
            <button id="btn-reset" class="btn btn-outline-dark px-4 ms-2">Réinitialiser</button>
        </div>
    </div>

    <!-- Portrait maudit -->
    <div class="text-center mb-5">
        <img src="<?= BASE_URL ?>images/portrait_maudit.png" 
             alt="Le Portrait Maudit" 
             class="img-fluid portrait-maudit">
    </div>

    <!-- Planche personnages principaux -->
    <div class="text-center mb-5">
        <img src="<?= BASE_URL ?>images/planche_principaux.png" 
             alt="Personnages principaux" 
             class="img-fluid w-100">
    </div>

    <!-- Grille personnages cliquables -->
<div class="row" id="fiches-grid">
    <?php foreach ($personnages as $p) : ?>
    <div class="col-md-4 mb-4">
        <div class="card border-0">
            <img src="<?= BASE_URL ?>images/<?= htmlspecialchars($p->getImage()) ?>"
                 alt="<?= htmlspecialchars($p->getNom()) ?>"
                 class="card-img-top fiche-image">
            <div class="card-body text-center">
                <h3><?= htmlspecialchars($p->getPrenom()) ?> <?= htmlspecialchars($p->getNom()) ?></h3>
                <p class="text-muted"><?= htmlspecialchars($p->getRang()) ?></p>
                <a href="<?= BASE_URL ?>pages/personnage.php?id=<?= $p->getPersonnageId() ?>" class="btn btn-dark btn-sm">
                    Découvrir
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Planche personnages secondaires -->
<div class="text-center mt-5 mb-5">
    <img src="<?= BASE_URL ?>images/planche_secondaires.png" 
         alt="Personnages secondaires" 
         class="img-fluid w-100">
</div>

<!-- Grille lieux cliquables -->
<div class="row" id="lieux-grid">
    <?php foreach ($lieux as $l) : ?>
    <div class="col-md-6 mb-4">
        <div class="card border-0">
            <img src="<?= BASE_URL ?>images/<?= htmlspecialchars($l->getImage()) ?>"
                 alt="<?= htmlspecialchars($l->getNom()) ?>"
                 class="card-img-top fiche-image">
            <div class="card-body text-center">
                <h3><?= htmlspecialchars($l->getNom()) ?></h3>
                <p class="text-muted"><?= htmlspecialchars($l->getVille()) ?></p>
                <a href="<?= BASE_URL ?>pages/lieu.php?id=<?= $l->getLieuId() ?>" class="btn btn-dark btn-sm">
                    Découvrir
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Planche des lieux -->
<div class="text-center mt-3 mb-5">
    <img src="<?= BASE_URL ?>images/planche_lieux.png" 
         alt="L'Univers de Dorian Gray - Les Lieux" 
         class="img-fluid w-100">
</div>
</div>

<script>var BASE_URL = '<?= BASE_URL ?>';</script>
<script src="<?= BASE_URL ?>js/filtres.js"></script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>