<?php

class User{
    private $id;
    private $pseudo;
    private $mail;
    private $mdp;
    private $date_inscription;
    private $role;

    public function __construct($id,$pseudo,$mail,$mdp,$date_inscription,$role){
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->mail = $mail;
        $this->mdp = $mdp;
        $this->date_inscription = $date_inscription;
        $this->role = $role;
    }


    public function getId(){
        return htmlspecialchars($this->id);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getPseudo(){
        return htmlspecialchars($this->pseudo);
    }

    public function setPseudo($pseudo){
        $this->pseudo = $pseudo;
    }

    public function getMail(){
        return htmlspecialchars($this->mail);
    }

    public function setMail($mail){
        $this->mail = $mail;
    }

    public function getMdp(){
        return htmlspecialchars($this->mdp);
    }

    public function setMdp($mdp){
        $this->mdp = $mdp;
    }

    public function getDate_inscription(){
        return htmlspecialchars($this->date_inscription);
    }

    public function setDate_inscription($date_inscription){
        $this->date_inscription = $date_inscription;
    }

    public function getRole(){
        return htmlspecialchars($this->role);
    }

    public function setRole($role){
        $this->role = $role;
    }
}