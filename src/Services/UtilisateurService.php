<?php

require_once __DIR__ .'/../Repository/UtilisateurRepository.php';

class UtilisateurService
{
    private UtilisateurRepository $utilisateurRepository;

    public function __construct(PDO $pdo)
    {
        $this->utilisateurRepository = new UtilisateurRepository($pdo);
    }

    public function connecter(string $email, string $mot_de_passe): array
    {
        $utilisateur  = $this->utilisateurRepository->findByEmail($email);

        if (!$utilisateur) {
            return ['success' => false, 'erreur' => 'Email ou mot de passe incorrect.'];
        }

        if(!password_verify($mot_de_passe, $utilisateur->getMotDePasse())) {
            return ['success' => false, 'erreur' => 'Email ou mot de passe incorrect.'];
        }

        return ['success' => true, 'utilisateur' => $utilisateur];
    }
    
    public function demanderResetPassword(string $email): string
    {
        $token = bin2hex(random_bytes(32));
        $expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $this->utilisateurRepository->storeResetToken($email, $token, $expiration);
        return $token;
    }

    public function verifierToken(string $token): ?Utilisateur
    {
        return $this->utilisateurRepository->findByToken($token);
    }

    public function resetPassword(string $token, string $newPassword): array
    {
        $utilisateur = $this->utilisateurRepository->findByToken($token);

        if(!$utilisateur) {
            return ['success' => false, 'erreur' => 'Token invalide ou expiré.'];
        }

        if(strlen($newPassword) < 8) {
            return ['success' => false,  'erreur' => 'Le mot de passe doit contenir au moins 8 caractères'];
        }

        $this->utilisateurRepository->updateMotDePasse($utilisateur->getUtilisateurId(), $newPassword);
        return ['success' => true];
    }

    public function getUtilisateurParEmail(string $email): ?Utilisateur
    {
        return $this->utilisateurRepository->findByEmail($email);
    }
}