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
                <p><span>Date de début</span>: <?=$anime->getDate_debut()?></p>
                <p><span>Date de fin</span>: <?=$anime->getDate_fin()?></p>
                <p><span>Nombre d'épisodes</span>: <?=$anime->getNombre_episode()?></p>
                <p><span>Durée des épisodes</span>: <?=$anime->getDuree_episode()?></p>
                <p><span>Synopsis</span>: <?=$anime->getSynopsis()?></p>
            </div>
            
        </article>
        <article>
            <form action="<?=URL?>admin/anime/afficher/<?=$anime->getId()?>/tags" method="POST">
                <p>Liste des tags</p>
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
    </section>

    


<?php
$titre = "Admin anime";
$content = ob_get_clean();
require_once "template.php";