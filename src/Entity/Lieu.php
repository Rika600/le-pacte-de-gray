<?php

class Lieu 
{
    private int $lieu_id;
    private string $nom;
    private ?string $image;
    private ?string $ville;
    private ?string $pays;
    private ?string $description;
    private ?string $categorie_nom = null;
    private bool $actif;
    private int $categorie_id;

    //getters
 public function getLieuId() : int
 {
    return $this->lieu_id;
 }

  public function getNom() : string
 {
    return $this->nom;
 }

  public function getImage() : ?string
 {
    return $this->image;
 }

  public function getVille() : ?string
 {
    return $this->ville;
 }

  public function getPays() : ?string
 {
    return $this->pays;
 }

  public function getDescription() : ?string
 {
    return $this->description;
 }

   public function getCategorieNom(): ?string
{
    return $this->categorie_nom;
}

  public function getActif() : bool
 {
    return $this->actif;
 }

  public function getCategorieId() : int
 {
    return $this->categorie_id;
 }
    
}