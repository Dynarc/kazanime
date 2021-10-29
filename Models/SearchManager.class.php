<?php
require_once 'Model.class.php';

class SearchManager extends Model{

    function searchAnimeBDD($search){
        $sql = "SELECT * FROM anime where nom like :search or nom_alt like :search";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ':search' => '%'.$search.'%'
        ]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    function searchAnimePropose($search){
        $sql = "SELECT * FROM proposition where nom like :search or nom_alt like :search";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ':search' => '%'.$search.'%'
        ]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    
}