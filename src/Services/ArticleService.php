<?php

require_once __DIR__ .'/../Repository/ArticleRepository.php';

class ArticleService
{
    private ArticleRepository $articleRepository;

    public function __construct(PDO $pdo)
    {
        $this->articleRepository = new ArticleRepository($pdo);
    }

    public function getArticles(): array
{
    return $this->articleRepository->findAll();
}

public function getArticle(int $id): ?Article
{
    return $this->articleRepository->findById($id);
}
}