<?php
require_once 'Model.class.php';
require_once 'Diffuseur.class.php';

class DiffuseurManager extends Model{
    private $diffuseurs;

    public function addDiffuseur($diffuseur){
        $this->diffuseurs[] = $diffuseur;
    }

    public function getDiffuseurs(){
        return $this->diffuseurs;
    }

    public function loadingDiffuseurs(){
        $sql = "SELECT * FROM diffuseur";
        $req = $this->getDB()->prepare($sql);
        $req->execute();
        $diffuseurs = $req->fetchAll(PDO::FETCH_OBJ);
        foreach($diffuseurs as $diffuseur){
            $diffuseur = new Diffuseur($diffuseur->id_diffuseur,$diffuseur->nom,$diffuseur->lien);
            $this->addDiffuseur($diffuseur);
        }
    }

    public function getDiffuseurByName($nom){
        if(!empty($this->diffuseurs)){
            foreach($this->diffuseurs as $diffuseur){
                if($diffuseur->getNom() == $nom){
                    return $diffuseur;
                }
            }
        }
    }

    public function getDiffuseurById($id){
        if(!empty($this->diffuseurs)){
            foreach($this->diffuseurs as $diffuseur){
                if($diffuseur->getId() == $id){
                    return $diffuseur;
                }
            }
        }
    }

    public function addDiffuseurDB($nom, $lien){
        $sql = "INSERT INTO diffuseur(nom, lien) VALUES (:nom, :lien)";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':nom' => $nom,
            ':lien' => $lien
        ]);
        if($result){
            $diffuseur = new Diffuseur($this->getDB()->lastInsertId(),$nom, $lien);
            $this->addDiffuseur($diffuseur);
        }
    }

    public function modifyDiffuseurDB($id, $nom, $lien){
        $sql = "UPDATE diffuseur SET nom = :nom, lien = :lien where id_diffuseur = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':lien' => $lien
        ]);
        if($result){
            $this->getDiffuseurById($id)->setNom($nom);
        }
    }

    public function deleteDiffuseurDB($id){
        $sql = "DELETE FROM diffuseur where id_diffuseur = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':id' => $id
        ]);
        if($result){
            $diffuseurToDelete = $this->getDiffuseurbyId($id);
            unset($diffuseurToDelete);
        }
    }
}