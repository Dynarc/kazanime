<?php

require_once "models/StudioManager.class.php";

class StudioController{

    private $studioManager;

    public function __construct(){
        $this->studioManager = new StudioManager;
        $this->studioManager->loadingStudios();
    }

    public function displayStudios(){
        $studios = $this->studioManager->getStudios();
        require_once 'views/adminStudio.view.php';
        unset($_SESSION['alert']);
    }

    public function addStudio(){
        try {
            if(empty($_POST['studio'])){
                $error = "<p>Vous devez mettre le nom du studio</p>";
            }
            
            if(!empty($this->studioManager->getStudioByName($_POST['studio']))){
                $error .= "<p>Le studio existe déjà</p>";
            } 
            if(!empty($error)){
                throw new Exception($error);
            }

            $this->studioManager->addStudioDB($_POST['studio']);
            GlobalController::alert("succes","<p>Le studio a bien été ajouté</p>");
            
        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        header('Location: '.URL.'admin/studio');
    }

    public function modifyStudio($id){
        try {
            if(empty($_POST['new_studio'])){
                $error = "<p>Vous devez mettre le nom du nouveau studio</p>";
            }
            if(!empty($this->studioManager->getStudioByName($_POST['new_studio'])) && $this->studioManager->getStudioById($id)->getNom() != $_POST['new_studio']){
                $error .= "<p>Le studio existe déjà</p>";
            } 
            if(!empty($error)){
                throw new Exception($error);
            }

            $this->studioManager->modifyStudioDB($id, $_POST['new_studio']);
            GlobalController::alert("succes","<p>le studio a bien été modifié</p>");

        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        header('Location: '.URL.'admin/studio');
    }

    public function deleteStudio($id){
        try {
            if(empty($this->studioManager->getStudioById($id))){
                $error = "<p>Le studio n'existe pas</p>";
            }
            if(!empty($error)){
                throw new Exception($error);
            }

            $this->studioManager->deleteStudioDB($id);
            GlobalController::alert("succes","<p>le studio a bien été supprimé</p>");

        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        header('Location: '.URL.'admin/studio');
    }   
}