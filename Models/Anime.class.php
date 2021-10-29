<?php


class Anime{
    private $id;
    private $nom;
    private $nom_alt;
    private $image;
    private $image_miniature;
    private $date_debut;
    private $date_fin;
    private $synopsis;
    private $nombre_episode;
    private $duree_episode;

    public function __construct($id,$nom,$nom_alt,$image,$image_miniature,$date_debut,$date_fin,$synopsis,$nombre_episode,$duree_episode){
        $this->id = $id;
        $this->nom = $nom;
        $this->nom_alt = $nom_alt;
        $this->image = $image;
        $this->image_miniature = $image_miniature;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->synopsis = $synopsis;
        $this->nombre_episode = $nombre_episode;
        $this->duree_episode = $duree_episode;
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
    
    public function getNom_alt(){
        return htmlspecialchars($this->nom_alt);
    }
    
    public function setNom_alt($nom_alt){
        $this->nom_alt = $nom_alt;
    }
    
    public function getImage(){
        return htmlspecialchars($this->image);
    }
    
    public function setImage($image){
        $this->image = $image;
    }
     
    public function getImage_miniature(){
        return htmlspecialchars($this->image_miniature);
    }
    
    public function setImage_miniature($image_miniature){
        $this->image_miniature = $image_miniature;
    }
    
    public function getDate_debut(){
        return htmlspecialchars($this->date_debut);
    }
    
    public function setDate_debut($date_debut){
        $this->date_debut = $date_debut;
    }

    public function getDate_fin(){
        return htmlspecialchars($this->date_fin);
    }
    
    public function setDate_fin($date_fin){
        $this->date_fin = $date_fin;
    }
     
    public function getSynopsis(){
        return htmlspecialchars($this->synopsis);
    }

    public function setSynopsis($synopsis){
        $this->synopsis = $synopsis;
    }

    public function getNombre_episode(){
        return htmlspecialchars($this->nombre_episode);
    }

    public function setNombre_episode($nombre_episode){
        $this->nombre_episode = $nombre_episode;
    }

    public function getDuree_episode(){
        return htmlspecialchars($this->duree_episode);
    }

    public function setDuree_episode($duree_episode){
        $this->duree_episode = $duree_episode;
    }
}