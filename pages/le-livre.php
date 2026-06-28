<?php
$pageTitle = 'Le Livre - Le Pacte de Gray';
require_once __DIR__ . '/../includes/header.php';
?>
<div class="container my-5">
    <div class="row align-items-center">

        <!-- Couverture -->
        <div class="col-md-4 text-center mb-4">
            <img src="<?= BASE_URL ?>images/couverture.jpg"
                 alt="Le Portrait de Dorian Gray"
                 class="img-fluid couverture-livre">
        </div>

        <!-- Présentation -->
        <div class="col-md-8">
            <h1 class="mb-2">Le Portrait de Dorian Gray</h1>
            <p class="text-muted">Oscar Wilde — 1890</p>
            <hr>

            <p>Dorian Gray, jeune homme d'une beauté exceptionnelle, pose pour le peintre Basil Hallward qui tombe sous le charme de sa perfection. Sous l'influence corruptrice du cynique Lord Henry Wotton, Dorian formule un vœu impie : que son portrait vieillisse à sa place pendant qu'il reste éternellement jeune.</p>

            <p>Ce vœu exaucé le plonge dans une vie de débauche et de corruption morale. Pendant des décennies, son visage reste lisse et pur tandis que son portrait se transforme en un reflet hideux de son âme souillée. Jusqu'au dénouement final, où la vérité éclate dans toute son horreur.</p>

            <p>Chef-d'œuvre du gothique victorien, ce roman explore les thèmes de la beauté, de la corruption, du dandysme et du portrait faustien d'une âme qui se vend au diable de la vanité.</p>

            <hr>

            <a href="https://www.amazon.fr/Portrait-Dorian-Gray-Oscar-Wilde/dp/2070360261"
               target="_blank" class="btn btn-dark mt-2">
                Lire le roman sur Amazon →
            </a>

            <a href="https://www.gutenberg.org/ebooks/174"
               target="_blank" class="btn btn-outline-dark mt-2 ms-2">
                Lire gratuitement (Gutenberg) →
            </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>