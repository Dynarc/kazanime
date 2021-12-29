<?php
require_once 'Anime.class.php';
require_once 'Model.class.php';

class AnimeManager extends Model{
    private $animes;

    public function addAnime($anime) {
        $this->animes[]= $anime;
    }

    public function getAnimes() {
        return $this->animes;
    }

    public function loadingAnime() {
        $sql = "SELECT * FROM anime";
        $req = $this->getDB()->prepare($sql);
        $req->execute();
        $animes = $req->fetchAll(PDO::FETCH_OBJ);
        foreach($animes as $anime){
            $anime = new Anime(
                $anime->id_anime,
                $anime->nom,
                $anime->nom_alt,
                $anime->image,
                $anime->image_miniature,
                $anime->date_debut,
                $anime->date_fin,
                $anime->synopsis,
                $anime->nombre_episode,
                $anime->duree_episode
            );
            $this->addAnime($anime);
        }
    }

    public function getAnimeById($id){
        if(!empty($this->animes)){
            foreach($this->animes as $anime){
                if($anime->getId() == $id){
                    return $anime;
                }
            }
        }
    }

    public function addAnimeDB($nom, $nomAlt, $img, $imgMini, $dateDebut, $dateFin, $synopsis, $nbrEpisode, $dureeEpisode) {
        $sql = "INSERT INTO anime(nom, nom_alt, image, image_miniature, date_debut, date_fin, synopsis, nombre_episode, duree_episode) VALUES (:nom, :nomAlt, :img, :imgMini, :dateDebut, :dateFin, :synopsis, :nbrEpisode, :dureeEpisode)";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':nom' => $nom,
            ':nomAlt' => $nomAlt,
            ':img' => $img,
            ':imgMini' => $imgMini,
            ':dateDebut' => $dateDebut,
            ':dateFin' => $dateFin,
            ':synopsis' => $synopsis,
            ':nbrEpisode' => $nbrEpisode,
            ':dureeEpisode' => $dureeEpisode
        ]);
        if($result){
            $anime = new Anime(
                $this->getDB()->lastInsertId(),
                $nom,
                $nomAlt,
                $img,
                $imgMini,
                $dateDebut,
                $dateFin,
                $synopsis,
                $nbrEpisode,
                $dureeEpisode
            );
            $this->addAnime($anime);
        }
    }

    public function modifyAnimeDB($id, $nom, $nomAlt, $img, $imgMini, $dateDebut, $dateFin, $synopsis, $nbrEpisode, $dureeEpisode) {
        $sql = "UPDATE anime SET nom = :nom, nom_alt = :nomAlt, image = :img, image_miniature = :imgMini, date_debut = :dateDebut, date_fin = :dateFin, synopsis = :synopsis, nombre_episode = :nbrEpisode, duree_episode = :dureeEpisode WHERE id_anime = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':nomAlt' => $nomAlt,
            ':img' => $img,
            ':imgMini' => $imgMini,
            ':dateDebut' => $dateDebut,
            ':dateFin' => $dateFin,
            ':synopsis' => $synopsis,
            ':nbrEpisode' => $nbrEpisode,
            ':dureeEpisode' => $dureeEpisode
        ]);
        if($result){
            $animeToModify = $this->getAnimeById($id);
            $animeToModify->setNom($nom);
            $animeToModify->setNom_alt($nomAlt);
            $animeToModify->setImage($img);
            $animeToModify->setImage_miniature($imgMini);
            $animeToModify->setDate_debut($dateDebut);
            $animeToModify->setDate_fin($dateFin);
            $animeToModify->setSynopsis($synopsis);
            $animeToModify->setNombre_episode($nbrEpisode);
            $animeToModify->setDuree_episode($dureeEpisode);
        }
    }

    public function deleteAnimeDB($id) {
        $sql = "DELETE FROM anime where id_anime = :id";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':id' => $id
        ]);
        if($result){
            $animeToDelete = $this->getAnimeById($id);
            unset($animeToDelete);
        }
    }
}
