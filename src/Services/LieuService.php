<?php

require_once __DIR__ .'/../Repository/LieuRepository.php';

class LieuService
{
    private LieuRepository $lieuRepository;

    public function __construct(PDO $pdo)
    {
        $this->lieuRepository = new LieuRepository($pdo);
    }

    public function getLieux(): array
    {
        return $this->lieuRepository->findAll();
    }

    public function getLieuComplet (int $id): ?array
    {
        $lieu = $this->lieuRepository->findById($id);
        if (!$lieu) return null;

        return [
            'lieu' => $lieu
        ];
    }

    public function getFiltresData(): array
    {
        return $this->lieuRepository->findAll();
    }
}