<?php

class Diffuseur{
    private $id;
    private $nom;
    private $lien;

    public function __construct($id, $nom, $lien){
        $this->id = $id;
        $this->nom = $nom;
        $this->lien = $lien;
    }



    public function getId(){
        return htmlspecialchars($this->id);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNom(){
        return htmlspecialchars($this->nom);
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function getLien(){
        return htmlspecialchars($this->lien);
    }

    public function setLien($lien){
        $this->lien = $lien;
    }
}