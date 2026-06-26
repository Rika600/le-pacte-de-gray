<?php 

class Article 
{
    private int $article_id;
    private string $titre;
    private string $contenu;
    private ?string $image;
    private bool $publie;
    private string $created_at;
    private int $utilisateur_id;

    public function getArticleId() : int
 {
    return $this->article_id;
 }

  public function getTitre() : string
 {
    return $this->titre;
 }

  public function getContenu() : string
 {
    return $this->contenu;
 }

  public function getImage() : ?string
 {
    return $this->image;
 }

  public function getPublie() : bool
 {
    return $this->publie;
 }

  public function getCreatedAt() : ?string
 {
    return $this->created_at;
 }

  public function getUtilisateurId() : int
 {
    return $this->utilisateur_id;
 }

}