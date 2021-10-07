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
    }

    public function addStudio(){
        if(empty($this->studioManager->getStudioByName($_POST['studio']))){
            $this->studioManager->addStudioDB($_POST['studio']);
        } else{
            throw new Exception('Le studio existe déjà');
        }
        
        header('Location: '.URL.'admin/studio');
    }

    public function modifyStudio($id){
        if(empty($this->studioManager->getStudioByName($id))){
            $this->studioManager->modifyStudioDB($id, $_POST['new_studio']);
        } else{
            throw new Exception("Le studio n'existe pas");
        }
        
        header('Location: '.URL.'admin/studio');
    }

    public function deleteStudio($id){
        if(empty($this->studioManager->getStudioByName($id))){
            $this->studioManager->deleteStudioDB($id);
        } else{
            throw new Exception("Le studio n'existe pas");
        }
        
        header('Location: '.URL.'admin/studio');
    }   
}