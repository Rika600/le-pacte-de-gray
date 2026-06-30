<?php

class Personnage {
    private int $personnage_id;
    private string $nom;
    private ?string $prenom;
    private ?string $image;
    private ?string $age;
    private ?string $ville;
    private ?string $pays;
    private ?string $rang;
    private ?string $statut;
    private string $role;
    private ?string $citation;
    private ?string $description;
    private ?string $categorie_nom = null;
    private bool $actif;
    private int $categorie_id;

 //getters
 public function getPersonnageId() : int
 {
    return $this->personnage_id;
 }

  public function getNom() : string
 {
    return $this->nom;
 }

  public function getPrenom() : ?string
 {
    return $this->prenom;
 }

  public function getImage() : ?string
 {
    return $this->image;
 }

  public function getAge() : ?string
 {
    return $this->age;
 }

  public function getVille() : ?string
 {
    return $this->ville;
 }

  public function getPays() : ?string
 {
    return $this->pays;
 }

  public function getRang() : ?string
 {
    return $this->rang;
 }

  public function getStatut() : ?string
 {
    return $this->statut;
 }

  public function getRole() : string
 {
    return $this->role;
 }

  public function getCitation() : ?string
 {
    return $this->citation;
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