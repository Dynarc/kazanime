<?php

require_once 'Models/SearchManager.class.php';

class Search{
    private $search;
    private $searchManager;

    public function __construct($search){
        $this->search = $search;
        $this->searchManager = new SearchManager;
    }

    public function displayAll(){
        $animes = $this->searchManager->searchAnimeBDD($this->search);
        $tab = [];
        if (!empty($animes)){
            foreach ($animes as $value) {
            if(!array_key_exists($value->id_anime,$tab)){
                $tab[$value->id_anime] = [
                    'Id' => $value->id_anime,
                    'Nom' => $value->nom,
                    'Synopsis' => $value->synopsis,
                    'Image' => $value->image,
                    'Image alternative' => $value->image_miniature,
                    'date de debut' => $value->date_debut,
                    'date de fin' => $value->date_fin,
                    "nombre d'épisode" => $value->nombre_episode,
                    "durée d'un épisode" => $value->duree_episode
                ];
            }
        }
        }
        GlobalController::sendJson($tab);
    }

    public function checkExist(){
        if(!empty($this->searchManager->searchAnimeBDD($this->search)) || !empty($this->searchManager->searchAnimePropose($this->search))){
            echo "l'anime existe";
        }
    }
}