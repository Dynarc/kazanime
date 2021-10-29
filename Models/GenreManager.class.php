<?php
require_once 'Model.class.php';
require_once 'Genre.class.php';

class GenreManager extends Model{
    private $genres;

    public function addGenre($genre){
        $this->genres[] = $genre;
    }

    public function getGenres(){
        return $this->genres;
    }

    public function loadingGenres(){
        $sql = "SELECT * FROM genre";
        $req = $this->getDB()->prepare($sql);
        $req->execute();
        $genres = $req->fetchAll(PDO::FETCH_OBJ);
        foreach($genres as $genre){
            $genre = new Genre($genre->id_genre,$genre->nom);
            $this->addGenre($genre);
        }
    }

    public function getGenreByName($nom){
        if(!empty($this->genres)){
            foreach($this->genres as $genre){
                if($genre->getNom() == $nom){
                    return $genre;
                }
            }
        }
    }

    public function getGenreById($id){
        if(!empty($this->genres)){
            foreach($this->genres as $genre){
                if($genre->getId() == $id){
                    return $genre;
                }
            }
        }
    }

    public function addGenreDB($nom){
        $sql = "INSERT INTO genre(nom) VALUES (:nom)";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':nom' => $nom
        ]);
        if($result){
            $genre = new Genre($this->getDB()->lastInsertId(),$nom);
            $this->addGenre($genre);
        }
    }

    public function modifyGenreDB($id, $nom){
        $sql = "UPDATE genre SET nom = :nom where id_genre = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':id' => $id,
            ':nom' => $nom
        ]);
        if($result){
            $this->getGenreById($id)->setNom($nom);
        }
    }

    public function deleteGenreDB($id){
        $sql = "DELETE FROM genre where id_genre = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':id' => $id
        ]);
        if($result){
            $genreToDelete = $this->getGenrebyId($id);
            unset($genreToDelete);
        }
    }
}