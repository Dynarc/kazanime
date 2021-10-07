<?php

class Genre{
    private $id;
    private $nom;

    public function __construct($id,$nom){
        $this->id = $id;
        $this->nom = $nom;
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
}