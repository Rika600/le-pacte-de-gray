<?php

class Categorie 
{
    private int $categorie_id;
    private string $nom;
    private string $type;

//getters
 public function getCategorieId() : int
 {
    return $this->categorie_id;
 }

  public function getNom() : string
 {
    return $this->nom;
 }

  public function getType() : string
 {
    return $this->type;
 }

}