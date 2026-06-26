<?php

require_once __DIR__ . '/../Entity/Article.php';

class ArticleRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $sql = "SELECT *
                FROM article
                WHERE publie = TRUE
                ORDER BY created_at DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    public function findById(int $id): ?Article
    {
        $sql = "SELECT *
                FROM article
                WHERE article_id = :id
                AND publie = TRUE";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Article::class);
        $result = $stmt->fetch();
        return $result ?: null;
    }
}