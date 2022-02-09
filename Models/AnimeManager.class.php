<?php
require_once 'Anime.class.php';
require_once 'model.class.php';
require_once 'DetenirManager.class.php';

class AnimeManager extends Model{
    private $animes;
    private $detenirManager;

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
            $this->detenirManager = new DetenirManager();
            $this->detenirManager->getAnimeTag($anime);
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
        return $result;
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

    public function addAnimeTag($id_anime, $tag) {
        $this->detenirManager->addAnimeTagDB($id_anime, $tag);
    }

    // WIP
    public function getAnimeAndTags($id) {
        $sql = "SELECT *, tag.nom as tag FROM detenir INNER JOIN anime ON anime.id_anime = detenir.id_anime AND anime.id_anime = :id RIGHT JOIN tag ON tag.id_tag = detenir.id_tag";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ':id' => $id
        ]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function deleteAnimeTag($id_anime, $id_tag) {
        $this->detenirManager->deleteAnimeTagDB($id_anime, $id_tag);
    }

    // public function getAnimeInfos($id) {
    //     $sql = "SELECT * FROM anime INNER JOIN tag, studio, genre, diffuseur, detenir, avoir, disposer, diffuser WHERE anime.id_anime = :id AND anime.id_anime = detenir.id_anime AND anime.id_anime = avoir.id_anime AND anime.id_anime = disposer.id_anime AND anime.id_anime = diffuser.id_anime AND tag.id_tag = detenir.id_tag AND genre.id_genre = avoir.id_genre AND studio.id_studio = disposer.id_studio AND diffuseur.id_diffuseur = diffuser.id_diffuseur";
    //     $req = $this->getDB()->prepare($sql);
    //     $req->execute([
    //         ":id" => $id
    //     ]);
    //     $anime = $req->fetchAll(PDO::FETCH_OBJ);
    //     return $anime;
    // }

    // // DETENIR TABLE (LINK TO TAG)

    // public function getAnimeTags($id) {
    //     $sql = "SELECT tag.id_tag, tag.nom FROM detenir INNER JOIN anime, tag WHERE detenir.id_anime = anime.id_anime AND detenir.id_tag = tag.id_tag AND anime.id_anime = :id";
    //     $req = $this->getDB()->prepare($sql);
    //     $req->execute([
    //         ':id' => $id
    //     ]);
    //     $tags = $req->fetchAll(PDO::FETCH_OBJ);
    //     return $tags;
    // }

    

    // public function addAnimeGenre($id_anime, $id_genre) {
    //     $sql = "INSERT INTO avoir(id_anime, id_genre) VALUES (:id_anime, :id_genre)";
    //     $req = $this->getDB()->prepare($sql);
    //     $req->execute([
    //         ':id_anime' => $id_anime,
    //         ':id_genre' => $id_genre
    //     ]);
    // }

    // public function addAnimeStudio($id_anime, $id_studio) {
    //     $sql = "INSERT INTO disposer(id_anime, id_studio) VALUES (:id_anime, :id_studio)";
    //     $req = $this->getDB()->prepare($sql);
    //     $req->execute([
    //         ':id_anime' => $id_anime,
    //         ':id_studio' => $id_studio
    //     ]);
    // }

    // public function addAnimeDiffusur($id_anime, $id_diffuseur) {
    //     $sql = "INSERT INTO diffuser(id_anime, id_diffuseur) VALUES (:id_anime, :id_diffuseur)";
    //     $req = $this->getDB()->prepare($sql);
    //     $req->execute([
    //         ':id_anime' => $id_anime,
    //         ':id_diffuseur' => $id_diffuseur
    //     ]);
    // }
}
