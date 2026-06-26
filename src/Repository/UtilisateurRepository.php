<?php

require_once  __DIR__ . '/../Entity/Utilisateur.php';

class UtilisateurRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
       $this->pdo =$pdo;
    }

    public function findByEmail(string $email): ?Utilisateur 
    {
        $sql ="SELECT utilisateur_id, email, mot_de_passe,
                        token_reset, token_expiration
                FROM utilisateur
                WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
        $result = $stmt->fetch();
        return $result ?:null;
    }

    public function storeResetToken(string $email, string $token, string $expiration): void
    {
        $sql = "UPDATE utilisateur SET token_reset = :token, token_expiration = :expiration WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':token' => $token, ':expiration' => $expiration, ':email'=> $email]);
    }

    public function findByToken(string $token): ?Utilisateur
    {
        $sql = "SELECT * FROM utilisateur WHERE token_reset = :token AND token_expiration > NOW()";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':token' => $token]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function updateMotDePasse(int $id, string $newPassword): void
    {
        $sql = "UPDATE utilisateur SET mot_de_passe = :mot_de_passe, token_reset = NULL, token_expiration = NULL
                WHERE utilisateur_id = :id";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([
            ':mot_de_passe' => password_hash($newPassword, PASSWORD_BCRYPT),
            ':id' => $id
        ]);
    }


}