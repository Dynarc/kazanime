<?php

require_once "Models/DiffuseurManager.class.php";

class DiffuseurController{

    private $diffuseurManager;

    public function __construct(){
        $this->diffuseurManager = new DiffuseurManager;
        $this->diffuseurManager->loadingDiffuseurs();
    }

    public function displayDiffuseurs(){
        $diffuseurs = $this->diffuseurManager->getDiffuseurs();
        require_once 'Views/adminDiffuseur.view.php';
        unset($_SESSION['alert']);
    }

    public function addDiffuseur(){
        try {
            if(empty($_POST['diffuseur'])){
                $error = "<p>Vous devez mettre le nom du diffuseur</p>";
            }
            if(empty($_POST['lien'])){
                $error .= "<p>Vous devez mettre le lien du diffuseur</p>";
            } else if(!preg_match('/[\s\S]+[.][\s\S]+/',$_POST['lien'])){
                $error .= "<p>Le lien n'est pas dans un format valide</p>";
            }
            if(!empty($this->diffuseurManager->getDiffuseurByName($_POST['diffuseur']))){
                $error .= "<p>Le diffuseur existe déjà</p>";
            } 
            if(!empty($error)){
                throw new Exception($error);
            }

            $this->diffuseurManager->addDiffuseurDB($_POST['diffuseur'], $_POST['lien']);
            GlobalController::alert("succes","<p>Le diffuseur a bien été ajouté</p>");
            
        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        
        header('Location: '.URL.'admin/diffuseur');
    }

    public function modifyDiffuseur($id){
        try {
            if(empty($_POST['new_diffuseur'])){
                $error = "<p>Vous devez mettre le nouveau nom du diffuseur</p>";
            }
            if(empty($_POST['new_lien'])){
                $error .= "<p>Vous devez mettre le nouveau lien du diffuseur</p>";
            } else if(!preg_match('/[\s\S]+[.][\s\S]+/',$_POST['new_lien'])){
                $error .= "<p>Le lien n'est pas dans un format valide</p>";
            }
            if(!empty($this->diffuseurManager->getDiffuseurByName($_POST['new_diffuseur'])) || $this->diffuseurManager->getDiffuseurById($id)->getNom() == $_POST['new_diffuseur']){
                $error .= "<p>Le diffuseur existe déjà</p>";
            } 
            if(!empty($error)){
                throw new Exception($error);
            }

            $this->diffuseurManager->modifyDiffuseurDB($id, $_POST['new_diffuseur'], $_POST['new_lien']);
            GlobalController::alert("succes","<p>le diffuseur a bien été modifié</p>");

        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        header('Location: '.URL.'admin/diffuseur');
    }

    public function deleteDiffuseur($id){
        try {
            if(empty($this->diffuseurManager->getDiffuseurById($id))){
                $error = "<p>Le diffuseur n'existe pas</p>";
            }
            if(!empty($error)){
                throw new Exception($error);
            }

            $this->diffuseurManager->deleteDiffuseurDB($id);
            GlobalController::alert("succes","<p>le diffuseur a bien été supprimé</p>");

        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        
        header('Location: '.URL.'admin/diffuseur');
    }   
}