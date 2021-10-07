<?php

require_once "models/TagManager.class.php";

class TagController{

    private $tagManager;

    public function __construct(){
        $this->tagManager = new TagManager;
        $this->tagManager->loadingTags();
    }

    public function displayTags(){
        $tags = $this->tagManager->getTags();
        require_once 'views/adminTag.view.php';
    }

    public function addTag(){
        if(empty($this->tagManager->getTagByName($_POST['tag']))){
            $this->tagManager->addTagDB($_POST['tag']);
        } else{
            throw new Exception('Le tag existe déjà');
        }
        
        header('Location: '.URL.'admin/tag');
    }

    public function modifyTag($id){
        if(empty($this->tagManager->getTagByName($id))){
            $this->tagManager->modifyTagDB($id, $_POST['new_tag']);
        } else{
            throw new Exception("Le tag n'existe pas");
        }
        
        header('Location: '.URL.'admin/tag');
    }

    public function deleteTag($id){
        if(empty($this->tagManager->getTagByName($id))){
            $this->tagManager->deleteTagDB($id);
        } else{
            throw new Exception("Le tag n'existe pas");
        }
        
        header('Location: '.URL.'admin/tag');
    }   
}