<?php
require_once 'model.class.php';
require_once 'Studio.class.php';

class StudioManager extends Model{
    private $studios;

    public function addStudio($studio){
        $this->studios[] = $studio;
    }

    public function getStudios(){
        return $this->studios;
    }

    public function loadingStudios(){
        $sql = "SELECT * FROM studio";
        $req = $this->getDB()->prepare($sql);
        $req->execute();
        $studios = $req->fetchAll(PDO::FETCH_OBJ);
        foreach($studios as $studio){
            $studio = new Studio($studio->id_studio,$studio->nom);
            $this->addStudio($studio);
        }
    }

    public function getStudioByName($nom){
        if(!empty($this->studios)){
            foreach($this->studios as $studio){
                if($studio->getNom() == $nom){
                    return $studio;
                }
            }
        }
    }

    public function getStudioById($id){
        if(!empty($this->studios)){
            foreach($this->studios as $studio){
                if($studio->getId() == $id){
                    return $studio;
                }
            }
        }
    }

    public function addStudioDB($nom){
        $sql = "INSERT INTO studio(nom) VALUES (:nom)";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':nom' => $nom
        ]);
        if($result){
            $studio = new Studio($this->getDB()->lastInsertId(),$nom);
            $this->addStudio($studio);
        }
    }

    public function modifyStudioDB($id, $nom){
        $sql = "UPDATE studio SET nom = :nom where id_studio = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':id' => $id,
            ':nom' => $nom
        ]);
        if($result){
            $this->getStudioById($id)->setNom($nom);
        }
    }

    public function deleteStudioDB($id){
        $sql = "DELETE FROM studio where id_studio = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':id' => $id
        ]);
        if($result){
            $studioToDelete = $this->getStudiobyId($id);
            unset($studioToDelete);
        }
    }
}