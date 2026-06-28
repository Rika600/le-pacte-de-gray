<?php
require_once __DIR__  .'/../src/Database.php';

header('Content-Type: application/json');

$pdo = Database::getConnection();

// Récupérer les filtres
$type = $_GET['type'] ?? '';
$categorieId = isset($_GET['categorie']) ? (int)$_GET['categorie'] : 0;

$result = [];

//Filtrer personnages
if ($type === 'personnage' || $type === '') {
    $sql = "SELECT p.personnage_id, p.nom, p.prenom, p.image, p.rang, p.statut, p.categorie_id
            FROM personnage p
            WHERE p.actif = TRUE";
    $params = [];

    if ($categorieId > 0) {
        $sql .= " AND p.categorie_id = :categorie_id";
        $params[':categorie_id'] = $categorieId;
    }

    $sql .= " ORDER BY p.nom ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $personnages = $stmt->fetchAll();

    foreach ($personnages as $p) {
        $p['type'] = 'personnage';
        $result[] = $p;
    }
}

//Filtrer lieux
if ($type === 'lieu' || $type === '') {
    $sql = "SELECT l.lieu_id, l.nom, l.image, l.ville, l.pays, l.categorie_id
            FROM lieu l
            WHERE l.actif = TRUE";
    $params = [];

    if ($categorieId > 0) {
        $sql .= " AND l.categorie_id = :categorie_id";
        $params[':categorie_id'] = $categorieId;
    }

    $sql .= " ORDER BY l.nom ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $lieux = $stmt->fetchAll();

    foreach ($lieux as $l) {
        $l['type'] = 'lieu';
        $result[] = $l;
    }
}

echo json_encode($result);