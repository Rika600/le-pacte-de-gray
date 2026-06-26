<?php

require_once __DIR__ .'/../Repository/PersonnageRepository.php';

class PersonnageService
{
    private PersonnageRepository $personnageRepository;

    public function __construct(PDO $pdo)
    {
        $this->personnageRepository = new PersonnageRepository($pdo);
    }

        public function getPersonnages(): array 
        {
            return $this->personnageRepository->findAll();
        }

        public function getPersonnageComplet(int $id): ?array
        {
            $personnage = $this->personnageRepository->findById($id);
            if (!$personnage) return null;

            $lieux = $this->personnageRepository->findLieux($id);

            return [
                'personnage' => $personnage,
                'lieux' => $lieux
            ];
        }

        public function getFiltresData(): array
        {
            return $this->personnageRepository->findAll();
        }
}