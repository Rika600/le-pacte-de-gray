<?php
session_start();
$pageTitle = 'Espace Admin - Le Pacte de Gray';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Services/UtilisateurService.php';


$pdo = Database::getConnection();
$utilisateurService = new UtilisateurService($pdo);

$message_erreur ='';

// Traitement connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion'])) {
    $email = trim($_POST['email'] ?? '');
    $motDePasse = $_POST['mot_de_passe'] ?? '';
    $result = $utilisateurService->connecter($email, $motDePasse);
    if ($result['success']) {
        $utilisateur = $result['utilisateur'];
        $_SESSION['utilisateur_id'] = $utilisateur->getUtilisateurId();
        $_SESSION['email'] = $utilisateur->getEmail();
    } else {
        $message_erreur = $result['erreur'];
    }
}

// Vérifier connexion
if (!isset($_SESSION['utilisateur_id'])) {
?>
    <div class="container my-5">
        <h1 class="text-center mb-5">Connexion Espace Réservé</h1>
        <?php if ($message_erreur !== '') : ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($message_erreur) ?></div>
        <?php endif; ?>
        <form method="post" action="admin.php" class="col-md-6 mx-auto">
            <input type="hidden" name="connexion" value="1">
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input id="email" name="email" type="email" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                <input id="mot_de_passe" name="mot_de_passe" type="password" required class="form-control">
            </div>
            <div class="text-center mt-4">
                <input type="submit" value="Se connecter" class="btn btn-dark">
            </div>
        </form>
    </div>
<?php
    require_once __DIR__ . '/../includes/footer.php';
    exit;
}

// Admin connecté
$personnageService = new \PersonnageService($pdo);
$articleService = new ArticleService($pdo);

require_once __DIR__ . '/../src/Services/PersonnageService.php';
require_once __DIR__ . '/../src/Services/ArticleService.php';

$personnages = $personnageService->getPersonnages();
$articles = $articleService->getArticles();
?>

<div class="container my-5">
    <h1 class="text-center mb-5">Espace Admin</h1>

    <!-- Personnages -->
    <h2 class="mb-4">Personnages</h2>
    <?php foreach ($personnages as $p) : ?>
    <div class="card mb-2 p-3">
        <p><strong><?= htmlspecialchars($p->getPrenom()) ?> <?= htmlspecialchars($p->getNom()) ?></strong> — <?= htmlspecialchars($p->getRang()) ?></p>
    </div>
    <?php endforeach; ?>

    <!-- Articles -->
    <h2 class="mt-5 mb-4">Articles</h2>
    <?php foreach ($articles as $a) : ?>
    <div class="card mb-2 p-3">
        <p><strong><?= htmlspecialchars($a->getTitre()) ?></strong> — <?= $a->getPublie() ? 'Publié' : 'Brouillon' ?></p>
    </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>