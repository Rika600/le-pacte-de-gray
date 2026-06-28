<?php

require_once __DIR__ .'/../Entity/Personnage.php';
require_once __DIR__ . '/../Entity/Categorie.php';

class PersonnageRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $sql = "SELECT p.*, c.nom as categorie_nom
                FROM personnage p
                JOIN  categorie c ON p.categorie_id = c.categorie_id
                WHERE p.actif = TRUE
                ORDER BY p.personnage_id ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Personnage::class);
    }

    public function findById(int $id): ?Personnage
    {
        $sql = "SELECT p.*, c.nom as categorie_nom
                FROM personnage p
                JOIN categorie c ON p.categorie_id = c.categorie_id
                WHERE p.personnage_id = :id
                AND p.actif = TRUE";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Personnage::class);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function findLieux(int $personnageId): array
    {
        $sql = "SELECT l.lieu_id, l.nom, l.image, l.ville, l.pays, l.description
                FROM lieu l
                JOIN personnage_lieu pl ON l.lieu_id = pl.lieu_id
                WHERE pl.personnage_id = :personnage_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':personnage_id'=> $personnageId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Personnage::class);
    }

    public function findByCategorie(int $categorieId): array
    {
        $sql = "SELECT p*, c.nom as categorie_nom
                FROM personnage p
                JOINT categorie c ON p.categorie_id = c.categorie_id
                WHERE p.actif = TRUE
                AND p.categorie_id = :categorie_id
                ORDER BY p.nom ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':categorie_id' => $categorieId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Personnage::class);
    }
}