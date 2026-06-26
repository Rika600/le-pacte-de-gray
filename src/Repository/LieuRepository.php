<?php

require_once __DIR__ . '/../Entity/Lieu.php';
require_once __DIR__ . '/../Entity/Categorie.php';

class LieuRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $sql = "SELECT l.*, c.nom as categorie_nom
                FROM lieu l
                JOIN categorie c ON l.categorie_id = c.categorie_id
                WHERE l.actif = TRUE
                ORDER BY l.nom ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Lieu::class);
    }

    public function findById(int $id): ?Lieu
    {
        $sql = "SELECT l.*, c.nom as categorie_nom
                FROM lieu l
                JOIN categorie c ON l.categorie_id = c.categorie_id
                WHERE l.lieu_id = :id
                AND l.actif = TRUE";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Lieu::class);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function findByCategorie(int $categorieId): array
    {
        $sql = "SELECT l.*, c.nom as categorie_nom
                FROM lieu l
                JOIN categorie c ON l.categorie_id = c.categorie_id
                WHERE l.actif = TRUE
                AND l.categorie_id = :categorie_id
                ORDER BY l.nom ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':categorie_id' => $categorieId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Lieu::class);
    }
}