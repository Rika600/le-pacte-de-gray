<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../config.php';

// 1. Connexion MySQL
$pdo = Database::getConnection();

// 2. Stats personnages
$sql = "SELECT personnage_id, nom, prenom FROM personnage WHERE actif = TRUE";
$stmt = $pdo->query($sql);
$personnages = $stmt->fetchAll();

// 3. Stats lieux
$sql = "SELECT lieu_id, nom FROM lieu WHERE actif = TRUE";
$stmt = $pdo->query($sql);
$lieux = $stmt->fetchAll();

// 4. Connexion MongoDB
$client = new MongoDB\Client(MONGODB_URI);
$db = $client->pacte_de_gray;
$collection = $db->stats_fiches;

// 5. Vider et réinsérer
$collection->deleteMany([]);

foreach ($personnages as $p) {
    $collection->insertOne([
        'type'          => 'personnage',
        'fiche_id'      => (int)$p['personnage_id'],
        'nom'           => $p['prenom'] . ' ' . $p['nom'],
        'nb_vues'       => 0,
        'date_sync'     => new MongoDB\BSON\UTCDateTime()
    ]);
}

foreach ($lieux as $l) {
    $collection->insertOne([
        'type'          => 'lieu',
        'fiche_id'      => (int)$l['lieu_id'],
        'nom'           => $l['nom'],
        'nb_vues'       => 0,
        'date_sync'     => new MongoDB\BSON\UTCDateTime()
    ]);
}

echo "Synchronisation terminée ! " . (count($personnages) + count($lieux)) . " fiches envoyées vers MongoDB.";