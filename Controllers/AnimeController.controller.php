<?php

require_once "models/AnimeManager.class.php";

class AnimeController {
    
    private $animeManager;

    public function __construct() {
        $this->animeManager = new AnimeManager;
        $this->animeManager->loadingAnime();
        $this->tagManager = new TagManager();
        $this->tagManager->loadingTags();
    }

    public function displayAnimes() {
        $animes = $this->animeManager->getAnimes();
        require_once 'views/adminAnime.view.php';
        unset($_SESSION['alert']);
    }

    public function displayAnime($id) {
        $anime = $this->animeManager->getAnimeById($id);
        if (empty($anime)) {
            throw new Exception("L'anime n'existe pas");
        }
        var_dump($anime);
        require_once 'views/anime.view.php';
    }

    // FIXME: doesn't work properly, BDD OK but OBJECT doesn't update
    public function updateTags($id) {
        $anime = $this->animeManager->getAnimeById($id);
        $oldTags = $anime->getTags();
        $tagValidated = [];

        if(!empty($oldTags)) {
            foreach ($oldTags as $index => $tag) {
                $toDo = "";
                if(!empty($_POST)) {
                    foreach ($_POST as $tagName => $value) {
                        if($tag->getNom() == $tagName) {
                            $toDo = "nothing";
                            array_push($tagValidated, $tagName);
                        }
                    }
                }
                
                if(empty($toDo)) {
                    $this->animeManager->deleteAnimeTag($id, $tag->getId());
                }
            }
        }

        foreach ($_POST as $tag => $value) {
            if(! in_array($tag, $tagValidated)) {
                $this->animeManager->addAnimeTag($id, $tag);
            }
        }
        
        // header('Location: '.URL.'admin/anime/afficher/'.$anime->getID());
    }

    public function addAnime() {
        try {

            if(empty($_POST['nom'])) {
                $error = "<p>Vous devez mettre le nom de l'anime</p>";
            }
            if(empty($_POST['nom_alt'])) {
                $error .= "<p>Vous devez mettre le ou les noms alternatifs de l'anime</p>";
            }
            if(empty($_POST['date_debut'])) {
                $error .= "<p>Vous devez mettre la date de début de diffusion</p>";
            }
            if(empty($_POST['date_fin'])) {
                $error .= "<p>Vous devez mettre la date de fin de diffusion</p>";
            }
            if($_POST['date_fin']<$_POST['date_debut']){
                $error .= "<p>La date de fin doit etre égale ou supérieure à la date de début</p>";
            }
            if(empty($_POST['synopsis'])) {
                $error .= "<p>Vous devez mettre le synopsis</p>";
            }
            if(empty($_POST['nbr_episode'])) {
                $error .= "<p>Vous devez mettre le nombre d'épisodes</p>";
            } else if(!preg_match('/^\d+$/', $_POST['nbr_episode'])) {
                $error .= "<p>La valeur du nombre d'épisodes n'est pas dans le bon format</p>";
            }
            if(empty($_POST['duree_episode'])) {
                $error .= "<p>Vous devez mettre la durée des épisodes</p>";
            } else if(!preg_match('/^\d+$/', $_POST['duree_episode'])) {
                $error .= "<p>La valeur de la duree d'épisode n'est pas dans le bon format</p>";
            }
            if(empty($_FILES['image']['name'])) {
                $error .= "<p>Vous devez mettre une image de l'anime</p>";
            } else if(! preg_match('/^image\/(png|jpeg|jpg)$/', $_FILES['image']['type'])) {
                $error .= "<p>L'image n'est pas au bon format (png, jpg, jpeg uniquement)</p>";
            } else if ($_FILES['image']['size'] > 2000000) {
                $error .= "<p>L'image est trop lourde (2Mo maximum)</p>";
            } else if ($_FILES['image']['error'] != 0 ) {
                $error .= "<p>Une erreur est survenue pendant l'envoi de l'image<p>";
            }
            if(empty($_FILES['image_mini']['name'])) {
                $error .= "<p>Vous devez mettre une image miniature de l'anime</p>";
            } else if (! preg_match('/^image\/(png|jpeg|jpg)$/', $_FILES['image_mini']['type'])) {
                $error .= "<p>L'image miniature n'est pas au bon format (png, jpg, jpeg uniquement)</p>";
            } else if ($_FILES['image_mini']['size'] > 2000000) {
                $error .= "<p>L'image miniature est trop lourde (2Mo maximum)</p>";
            } else if ($_FILES['image_mini']['error'] != 0 ) {
                $error .= "<p>Une erreur est survenue pendant l'envoi de l'image miniature<p>";
            }
            if(!empty($error)){
                throw new Exception($error);
            }

            $animes = $this->animeManager->getAnimes();

            if (!empty($animes)) {
                foreach ($animes as $anime) {
                    if($_POST['nom'] == $anime->getNom() || $_POST['nom_alt'] == $anime->getNom() || $_POST['nom'] == $anime->getNom_alt() || $_POST['nom_alt'] == $anime->getNom_alt()) {
                        throw new Exception("<p>L'anime existe déjà</p>");
                    }
                }
            }

            $newImage = strtolower(str_replace(' ', '-', $_POST['nom']).str_replace('image/','.', $_FILES['image']['type']));
            $newImageMini = strtolower(str_replace(' ', '-', $_POST['nom']).'-mini'.str_replace('image/','.', $_FILES['image_mini']['type']));

            move_uploaded_file($_FILES['image']['tmp_name'], 'public/image/animes/'.$newImage);
            move_uploaded_file($_FILES['image_mini']['tmp_name'], 'public/image/animes/'.$newImageMini);

            $this->animeManager->addAnimeDB($_POST['nom'], $_POST['nom_alt'], $newImage, $newImageMini, $_POST['date_debut'], $_POST['date_fin'], $_POST['synopsis'], $_POST['nbr_episode'], $_POST['duree_episode']);
            GlobalController::alert("succes","<p>L'anime a bien été ajouté</p>");

        } catch (Exception $error) {
            GlobalController::alert('echec', $error->getMessage());
        }

        header('Location: '.URL.'admin/anime');
    }

    public function modifyAnime($id) {
        // var_dump($_POST);
        // var_dump($_FILES);
        try {
            if(empty($_POST['nom'])) {
                $error = "<p>Vous devez mettre le nom de l'anime</p>";
            }
            if(empty($_POST['nom_alt'])) {
                $error .= "<p>Vous devez mettre le ou les noms alternatifs de l'anime</p>";
            }
            if(empty($_POST['date_debut'])) {
                $error .= "<p>Vous devez mettre la date de début de diffusion</p>";
            }
            if(empty($_POST['date_fin'])) {
                $error .= "<p>Vous devez mettre la date de fin de diffusion</p>";
            }
            if($_POST['date_fin']<$_POST['date_debut']){
                $error .= "<p>La date de fin doit etre égale ou supérieure à la date de début</p>";
            }
            if(empty($_POST['synopsis'])) {
                $error .= "<p>Vous devez mettre le synopsis</p>";
            }
            if(empty($_POST['nbr_episode'])) {
                $error .= "<p>Vous devez mettre le nombre d'épisodes</p>";
            } else if(!preg_match('/^\d+$/', $_POST['nbr_episode'])) {
                $error .= "<p>La valeur du nombre d'épisodes n'est pas dans le bon format</p>";
            }
            if(empty($_POST['duree_episode'])) {
                $error .= "<p>Vous devez mettre la durée des épisodes</p>";
            } else if(!preg_match('/^\d+$/', $_POST['duree_episode'])) {
                $error .= "<p>La valeur de la duree d'épisode n'est pas dans le bon format</p>";
            }
            if(!empty($_FILES['image']['name'])) {
                if(! preg_match('/^image\/(png|jpeg|jpg)$/', $_FILES['image']['type'])) {
                    $error .= "<p>L'image n'est pas au bon format (png, jpg, jpeg uniquement)</p>";
                } else if ($_FILES['image']['size'] > 2000000) {
                    $error .= "<p>L'image est trop lourde (2Mo maximum)</p>";
                } else if ($_FILES['image']['error'] != 0 ) {
                    $error .= "<p>Une erreur est survenue pendant l'envoi de l'image<p>";
                }
            }
            if(!empty($_FILES['image_mini']['name'])) {
                if (! preg_match('/^image\/(png|jpeg|jpg)$/', $_FILES['image_mini']['type'])) {
                    $error .= "<p>L'image miniature n'est pas au bon format (png, jpg, jpeg uniquement)</p>";
                } else if ($_FILES['image_mini']['size'] > 2000000) {
                    $error .= "<p>L'image miniature est trop lourde (2Mo maximum)</p>";
                } else if ($_FILES['image_mini']['error'] != 0 ) {
                    $error .= "<p>Une erreur est survenue pendant l'envoi de l'image miniature<p>";
                }
            }
            if(!empty($error)){
                throw new Exception($error);
            }

            $animes = $this->animeManager->getAnimes();

            if (!empty($animes)) {
                foreach ($animes as $anime) {
                    if(($_POST['nom'] == $anime->getNom() || $_POST['nom_alt'] == $anime->getNom() || $_POST['nom'] == $anime->getNom_alt() || $_POST['nom_alt'] == $anime->getNom_alt()) && $id != $anime->getId()) {
                        throw new Exception("<p>L'anime existe déjà</p>");
                    }
                }
            }

            $anime = $this->animeManager->getAnimeById($id);
            if(empty($_FILES['image']['name'])) {
                $image = $anime->getImage();
            } else {
                $image = strtolower(str_replace(' ', '-', $_POST['nom']).str_replace('image/','.', $_FILES['image']['type']));
                unlink('public/image/animes/'.$anime->getImage());
                move_uploaded_file($_FILES['image']['tmp_name'], 'public/image/animes/'.$image);
            }
            if(empty($_FILES['image_mini']['name'])) {
                $imageMini = $anime->getImage_miniature();
            } else {
                $imageMini = strtolower(str_replace(' ', '-', $_POST['nom']).'-mini'.str_replace('image/','.', $_FILES['image_mini']['type']));
                unlink('public/image/animes/'.$anime->getImage_miniature());
                move_uploaded_file($_FILES['image_mini']['tmp_name'], 'public/image/animes/'.$imageMini);
            }

            $this->animeManager->modifyAnimeDB($id, $_POST['nom'], $_POST['nom_alt'], $image, $imageMini, $_POST['date_debut'], $_POST['date_fin'], $_POST['synopsis'], $_POST['nbr_episode'], $_POST['duree_episode']);
            GlobalController::alert("succes","<p>L'anime a bien été ajouté</p>");

        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }

        header('Location: '.URL.'admin/anime/afficher/'.$id);
    }

    public function deleteAnime($id) {
        try {
            $anime = $this->animeManager->getAnimeById($id);

            if(empty($anime)) {
                $error = "<p>L'anime n'existe pas</p>";
            }
            if(!empty($error)) {
                throw new Exception($error);
            }

            $this->animeManager->deleteAnimeDB($id);

            unlink('public/image/animes/'.$anime->getImage());
            unlink('public/image/animes/'.$anime->getImage_miniature());

            GlobalController::alert("succes","<p>le diffuseur a bien été supprimé</p>");

        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
        }

        header('Location: '.URL.'admin/anime');
    }

    public function displayAdminAnime($id) {
        $animeTags = $this->animeManager->getAnimeAndTags($id);
        $anime = $this->animeManager->getAnimeById($id);
        require_once "views/adminAnimeDetail.view.php";
    }
}