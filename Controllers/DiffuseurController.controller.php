<?php

require_once "models/DiffuseurManager.class.php";

class DiffuseurController{

    private $diffuseurManager;

    public function __construct(){
        $this->diffuseurManager = new DiffuseurManager;
        $this->diffuseurManager->loadingDiffuseurs();
    }

    public function displayDiffuseurs(){
        $diffuseurs = $this->diffuseurManager->getDiffuseurs();
        require_once 'views/adminDiffuseur.view.php';
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
            GlobalController::alert("succes","Le diffuseur a bien été ajouté");
            
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
            if(!empty($this->diffuseurManager->getDiffuseurByName($_POST['new_diffuseur'])) && $this->diffuseurManager->getDiffuseurById($id)->getNom() != $_POST['new_diffuseur']){
                $error .= "<p>Le diffuseur existe déjà</p>";
            } 
            if(!empty($error)){
                throw new Exception($error);
            }

            $this->diffuseurManager->modifyDiffuseurDB($id, $_POST['new_diffuseur'], $_POST['new_lien']);
            GlobalController::alert("succes","le diffuseur a bien été modifié");

        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        header('Location: '.URL.'admin/diffuseur');
    }

    public function deleteDiffuseur($id){
        try {
            if(!empty($this->diffuseurManager->getDiffuseurById($id))){
                $this->diffuseurManager->deleteDiffuseurDB($id);
                GlobalController::alert("succes","le diffuseur a bien été supprimé");
            } else{
                throw new Exception("Le diffuseur n'existe pas");
            }
        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        
        header('Location: '.URL.'admin/diffuseur');
    }   
}