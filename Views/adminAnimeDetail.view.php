<?php ob_start() ?>

    <h2 class="crud-title"><?=$anime->getNom()?></h2>
    <section class="admin-display-detail">
        <article>
            <div>
                <figure>
                    <img src="<?=URL?>public/image/animes/<?=$anime->getImage_miniature()?>" alt="Miniature de <?=$anime->getNom()?>">
                    <figcaption>Miniature</figcaption>
                </figure>
                <figure>
                    <img src="<?=URL?>public/image/animes/<?=$anime->getImage()?>" alt="Image de <?=$anime->getNom()?>">
                    <figcaption>Image taille large</figcaption>
                </figure>
            </div>
            
            
            <div>
                <p><span>Nom</span>: <?=$anime->getNom()?></p>
                <p><span>Nom(s) alternatif</span>: <?=$anime->getNom_alt()?></p>
                <p><span>Date de début</span>: <?=date('d-m-Y', strtotime($anime->getDate_debut()))?></p>
                <p><span>Date de fin</span>: <?=date('d-m-Y', strtotime($anime->getDate_fin()))?></p>
                <p><span>Nombre d'épisodes</span>: <?=$anime->getNombre_episode()?></p>
                <p><span>Durée des épisodes</span>: <?=$anime->getDuree_episode()?> minutes</p>
                <p><span>Synopsis</span>: <?=$anime->getSynopsis()?></p>
            </div>
            
        </article>
        <article class="more-info">
            <form action="<?=URL?>admin/anime/afficher/<?=$anime->getId()?>/tags" method="POST">
                <p>Liste des tags (WIP)</p>
                <?php
                foreach ($allTags as $tag) {
                    if(!empty($anime->getTags())) {
                        foreach ($anime->getTags() as $animeTag) {
                            if($tag->getNom() == $animeTag->getNom()) {
                                $isChecked = true;
                            }
                        }
                    }
                    echo '<label>'.htmlspecialchars($tag->getNom()).'</label>';
                    if(!empty($isChecked)) {
                        echo '<input type="checkbox" name="'.htmlspecialchars($tag->getNom()).'" id="'.$tag->getId().'" checked>';
                    } else {
                        echo '<input type="checkbox" name="'.htmlspecialchars($tag->getNom()).'" id="'.$tag->getId().'">';
                    }
                }
                ?>
                <input type="submit" value="Update tags">
            </form>
        </article>
        <article class="crud-list">
            <form action="<?=URL?>admin/anime/modifier/<?=$anime->getId()?>" method="POST" class="form-crud-add" enctype="multipart/form-data">
                <label for="nom">Nom anime :</label>
                <input type="text" name="nom" value="<?=$anime->getNom()?>" required>
                <label for="nom_alt">Nom alternatif anime :</label>
                <input type="text" name="nom_alt" value="<?=$anime->getNom_alt()?>" required>
                <label for="date_debut">Date de début de diffusion :</label>
                <input type="date" name="date_debut" value="<?=$anime->getDate_debut()?>" required>
                <label for="date_fin">Date de fin de diffusion :</label>
                <input type="date" name="date_fin" value="<?=$anime->getDate_fin()?>" required>
                <label for="synopsis">Synopsis :</label>
                <textarea name="synopsis" class="synopsis" required><?=$anime->getSynopsis()?></textarea>
                <label for="nbr_episode">Nombre d'épisodes :</label>
                <input type="text" name="nbr_episode" value="<?=$anime->getNombre_episode()?>" required>
                <label for="duree_episode">Durée de chaque épisode en minutes :</label>
                <input type="text" name="duree_episode" value="<?=$anime->getDuree_episode()?>" required>
                <label for="image">Image (Ultra wide) :</label>
                <input type="file" name="image" accept=".jpg, .jpeg, .png">
                <label for="image_mini">Image miniature :</label>
                <input type="file" name="image_mini" accept=".jpg, .jpeg, .png">
                <input type="submit" value="Modifier">
            </form>
            <button class="crud-add">Modifier l'anime</button>
        </article>
    </section>

    


<?php
$titre = "Admin anime";
$content = ob_get_clean();
require_once "template.php";