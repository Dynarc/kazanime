<?php

require_once "models/GenreManager.class.php";

class GenreController{

    private $genreManager;

    public function __construct(){
        $this->genreManager = new GenreManager;
        $this->genreManager->loadingGenres();
    }

    public function displayGenres(){
        $genres = $this->genreManager->getGenres();
        require_once 'views/adminGenre.view.php';
    }

    public function addGenre(){
        if(empty($this->genreManager->getGenreByName($_POST['genre']))){
            $this->genreManager->addGenreDB($_POST['genre']);
        } else{
            throw new Exception('Le genre existe déjà');
        }
        
        header('Location: '.URL.'admin/genre');
    }

    public function modifyGenre($id){
        if(empty($this->genreManager->getGenreByName($id))){
            $this->genreManager->modifyGenreDB($id, $_POST['new_genre']);
        } else{
            throw new Exception("Le genre n'existe pas");
        }
        
        header('Location: '.URL.'admin/genre');
    }

    public function deleteGenre($id){
        if(empty($this->genreManager->getGenreByName($id))){
            $this->genreManager->deleteGenreDB($id);
        } else{
            throw new Exception("Le genre n'existe pas");
        }
        
        header('Location: '.URL.'admin/genre');
    }   
}