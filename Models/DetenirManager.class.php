<?php
require_once 'TagManager.class.php';
require_once 'AnimeManager.class.php';
require_once 'Model.class.php';

class DetenirManager extends Model{

    private $animeManager;
    private $tagManager;

    public function __construct(){
        $this->animeManager = new AnimeManager();
        $this->tagManager = new TagManager();
        $this->tagManager->loadingTags();
        
    }

    public function getAnimeTag($anime) {
        $sql = "SELECT * FROM detenir WHERE id_anime = :id_anime";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ':id_anime' => $anime->getId()
        ]);
        $detenir = $req->fetchAll(PDO::FETCH_OBJ);
        if(!empty($detenir)) {
            foreach ($detenir as $tag) {
                $tag = $this->tagManager->getTagById($tag->id_tag);
                $anime->setTags($tag);
            }
        }
    }

    public function addAnimeTag($anime, $tag) {
        $this->animeManager->loadingAnime();
        $tag = $this->tagManager->getTagById($tag);
        $anime = $this->animeManager->getAnimeById($anime);
        
        $anime->setTags($tag);
    }

    public function addAnimeTagDB($id_anime, $tag) {
        $tag = $this->tagManager->getTagByName($tag);

        $id_tag = $tag->getId();
        $sql = "INSERT INTO detenir(id_anime, id_tag) VALUES (:id_anime, :id_tag)";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ':id_anime' => $id_anime,
            ':id_tag' => $id_tag
        ]);
        $this->addAnimeTag($id_anime, $id_tag);
    }

    public function deleteAnimeTagDB($id_anime, $id_tag) {
        $sql = "DELETE FROM detenir WHERE id_anime = :id_anime AND id_tag = :id_tag";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ':id_anime' => $id_anime,
            ':id_tag' => $id_tag
        ]);
        if($result){
            $this->animeManager->loadingAnime();
            $anime = $this->animeManager->getAnimeById($id_anime);
            $anime->setTags([]);
            $this->getAnimeTag($anime);
        }
    }

}