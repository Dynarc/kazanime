<?php
session_start();
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

if(empty($_GET['page'])){

    require_once 'views/accueil.view.php';

} else{

    $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);

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

            default:
                throw new Exception("La page n'existe pas");
                break;

        }

    }catch (Exception $e){
        $test = $e->getMessage();
        
    }
}