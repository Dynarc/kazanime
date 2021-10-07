<?php
session_start();
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

if(empty($_GET['page'])){

    require_once 'views/accueil.view.php';

} else{

    $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);

    require_once 'controllers/globalController.controller.php';

    try {

        switch ($url[0]){

            case 'accueil':
                // a changer quand back ready
                require_once 'views/accueil.view.php';
                break;
                
            case 'liste-anime':
                require_once 'views/listeAnime.view.php';
                break;
            
            case 'proposer-anime':
                require_once 'views/proposerAnime.view.php';
                break;

            case 'connexion':
                require_once 'views/connexion.view.php';
                break;

            case 'inscription':
                require_once 'views/inscription.view.php';
                break;

            case 'admin':
                require_once 'controllers/AdminController.controller.php';
                $adminController = new AdminController;

                if (isset($url[1])){
                    switch ($url[1]){

                        case 'utilisateur':
                            break;
                        
                        case 'anime':
                            break;
                        
                        case 'episode':
                            break;
                        
                        case 'tag':
                            require_once 'controllers/TagController.controller.php';
                            $tagController = new TagController;
                            if(isset($url[2])){
                                switch ($url[2]){
                                    case 'ajouter':
                                        $tagController->addTag();
                                        break;

                                    case 'modifier':
                                        if(isset($url[3])){
                                            $tagController->modifyTag($url[3]);
                                        } else {
                                            throw new Exception('Aucun tag à modifier');
                                        }
                                        break;

                                    case 'supprimer':
                                        if(isset($url[3])){
                                            $tagController->deleteTag($url[3]);
                                        } else {
                                            throw new Exception('Aucun tag à supprimer');
                                        }
                                        break;
                                }
                            } else {
                                $tagController->displayTags();
                            }
                            break;

                        case 'genre':
                            require_once 'controllers/GenreController.controller.php';
                            $genreController = new GenreController;
                            if(isset($url[2])){
                                switch ($url[2]){
                                    case 'ajouter':
                                        $genreController->addGenre();
                                        break;

                                    case 'modifier':
                                        if(isset($url[3])){
                                            $genreController->modifyGenre($url[3]);
                                        } else {
                                            throw new Exception('Aucun genre à modifier');
                                        }
                                        break;

                                    case 'supprimer':
                                        if(isset($url[3])){
                                            $genreController->deleteGenre($url[3]);
                                        } else {
                                            throw new Exception('Aucun genre à supprimer');
                                        }
                                        break;
                                }
                            } else {
                                $genreController->displayGenres();
                            }
                            break;
                        
                        case 'studio':
                            require_once 'controllers/StudioController.controller.php';
                            $studioController = new StudioController;
                            if(isset($url[2])){
                                switch ($url[2]){
                                    case 'ajouter':
                                        $studioController->addStudio();
                                        break;

                                    case 'modifier':
                                        if(isset($url[3])){
                                            $studioController->modifyStudio($url[3]);
                                        } else {
                                            throw new Exception('Aucun studio à modifier');
                                        }
                                        break;

                                    case 'supprimer':
                                        if(isset($url[3])){
                                            $studioController->deleteStudio($url[3]);
                                        } else {
                                            throw new Exception('Aucun studio à supprimer');
                                        }
                                        break;
                                }
                            } else {
                                $studioController->displayStudios();
                            }
                            break;

                        case 'diffuseur':
                            require_once 'controllers/DiffuseurController.controller.php';
                            $diffuseurController = new DiffuseurController;
                            if(isset($url[2])){
                                switch ($url[2]){
                                    case 'ajouter':
                                        $diffuseurController->addDiffuseur();
                                        break;

                                    case 'modifier':
                                        if(isset($url[3])){
                                            $diffuseurController->modifyDiffuseur($url[3]);
                                        } else {
                                            throw new Exception('Aucun diffuseur à modifier');
                                        }
                                        break;

                                    case 'supprimer':
                                        if(isset($url[3])){
                                            $diffuseurController->deleteDiffuseur($url[3]);
                                        } else {
                                            throw new Exception('Aucun diffuseur à supprimer');
                                        }
                                        break;
                                }
                            } else {
                                $diffuseurController->displayDiffuseurs();
                            }
                            break;
                            break;
                        
                        case 'commentaire':
                            break;
                        
                        case 'sanction':
                            break;

                        case 'Proposition':
                            break;

                        default:
                            throw new Exception("La page n'existe pas");
                    }
                } else {
                    $adminController->adminHome();
                }
                break;

            default:
                throw new Exception("La page n'existe pas");
                break;

        }

    }catch (Exception $e){
        $test = $e->getMessage();
    }
}