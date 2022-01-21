<?php
require_once 'model.class.php';
require_once 'Tag.class.php';

class TagManager extends Model{
    private $tags;

    public function addTag($tag){
        $this->tags[] = $tag;
    }

    public function getTags(){
        return $this->tags;
    }

    public function loadingTags(){
        $sql = "SELECT * FROM tag";
        $req = $this->getDB()->prepare($sql);
        $req->execute();
        $tags = $req->fetchAll(PDO::FETCH_OBJ);
        foreach($tags as $tag){
            $tag = new Tag($tag->id_tag,$tag->nom);
            $this->addTag($tag);
        }
    }

    public function getTagByName($nom){
        if(!empty($this->tags)){
            foreach($this->tags as $tag){
                if($tag->getNom() == $nom){
                    return $tag;
                }
            }
        }
    }

    public function getTagById($id){
        if(!empty($this->tags)){
            foreach($this->tags as $tag){
                if($tag->getId() == $id){
                    return $tag;
                }
            }
        }
    }

    public function addTagDB($nom){
        $sql = "INSERT INTO tag(nom) VALUES (:nom)";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':nom' => $nom
        ]);
        if($result){
            $tag = new Tag($this->getDB()->lastInsertId(),$nom);
            $this->addTag($tag);
        }
    }

    public function modifyTagDB($id, $nom){
        $sql = "UPDATE tag SET nom = :nom where id_tag = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':id' => $id,
            ':nom' => $nom
        ]);
        if($result){
            $this->getTagById($id)->setNom($nom);
        }
    }

    public function deleteTagDB($id){
        $sql = "DELETE FROM tag where id_tag = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':id' => $id
        ]);
        if($result){
            $tagToDelete = $this->getTagbyId($id);
            unset($tagToDelete);
        }
    }
}