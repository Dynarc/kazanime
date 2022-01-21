<?php

require_once "Models/TagManager.class.php";

class TagController{

    private $tagManager;

    public function __construct(){
        $this->tagManager = new TagManager;
        $this->tagManager->loadingTags();
    }

    public function displayTags(){
        $tags = $this->tagManager->getTags();
        require_once 'Views/adminTag.view.php';
        unset($_SESSION['alert']);
    }

    public function addTag(){
        try {
            if(empty($_POST['tag'])){
                $error = "<p>Vous devez mettre le nom du tag</p>";
            }
            
            if(!empty($this->tagManager->getTagByName($_POST['tag']))){
                $error .= "<p>Le tag existe déjà</p>";
            } 
            if(!empty($error)){
                throw new Exception($error);
            }

            $this->tagManager->addTagDB($_POST['tag']);
            GlobalController::alert("succes","<p>Le tag a bien été ajouté</p>");
            
        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        header('Location: '.URL.'admin/tag');
    }

    public function modifyTag($id){
        try {
            if(empty($_POST['new_tag'])){
                $error = "<p>Vous devez mettre le nom du nouveau tag</p>";
            }
            if(!empty($this->tagManager->getTagByName($_POST['new_tag'])) || $this->tagManager->getTagById($id)->getNom() == $_POST['new_tag']){
                $error .= "<p>Le tag existe déjà</p>";
            } 
            if(!empty($error)){
                throw new Exception($error);
            }

            $this->tagManager->modifyTagDB($id, $_POST['new_tag']);
            GlobalController::alert("succes","<p>le tag a bien été modifié</p>");

        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        header('Location: '.URL.'admin/tag');
    }

    public function deleteTag($id){
        try {
            if(empty($this->tagManager->getTagById($id))){
                $error = "<p>Le tag n'existe pas</p>";
            }
            if(!empty($error)){
                throw new Exception($error);
            }

            $this->tagManager->deleteTagDB($id);
            GlobalController::alert("succes","<p>le tag a bien été supprimé</p>");

        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }
        
        header('Location: '.URL.'admin/tag');
    }   
}