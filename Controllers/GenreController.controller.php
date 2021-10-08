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
        unset($_SESSION['alert']);
    }

    public function addGenre(){
        try {
            if(empty($_POST['genre'])){
                $error = "<p>Vous devez mettre le nom du genre</p>";
            }
            
            if(!empty($this->genreManager->getGenreByName($_POST['genre']))){
                $error .= "<p>Le genre existe déjà</p>";
            } 
            if(!empty($error)){
                throw new Exception($error);
            }

            $this->genreManager->addGenreDB($_POST['genre']);
            GlobalController::alert("succes","<p>Le genre a bien été ajouté</p>");
            
        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        header('Location: '.URL.'admin/genre');
    }

    public function modifyGenre($id){
        try {
            if(empty($_POST['new_genre'])){
                $error = "<p>Vous devez mettre le nom du nouveau genre</p>";
            }
            if(!empty($this->genreManager->getGenreByName($_POST['new_genre'])) && $this->genreManager->getGenreById($id)->getNom() != $_POST['new_genre']){
                $error .= "<p>Le genre existe déjà</p>";
            } 
            if(!empty($error)){
                throw new Exception($error);
            }

            $this->genreManager->modifyGenreDB($id, $_POST['new_genre']);
            GlobalController::alert("succes","<p>le genre a bien été modifié</p>");

        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        header('Location: '.URL.'admin/genre');
    }

    public function deleteGenre($id){
        try {
            if(empty($this->genreManager->getGenreById($id))){
                $error = "<p>Le genre n'existe pas</p>";
            }
            if(!empty($error)){
                throw new Exception($error);
            }

            $this->genreManager->deleteGenreDB($id);
            GlobalController::alert("succes","<p>le genre a bien été supprimé</p>");

        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        header('Location: '.URL.'admin/genre');
    }   
}