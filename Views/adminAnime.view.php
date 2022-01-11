<?php ob_start() ?>

    <h2 class="crud-title">Liste des animes</h2>
    <section class="crud-list">

        <form action="<?=URL?>admin/anime/ajouter" method="POST" class="form-crud-add" enctype="multipart/form-data">
            <label for="nom">Nom anime :</label>
            <input type="text" name="nom" required>
            <label for="nom_alt">Nom alternatif anime :</label>
            <input type="text" name="nom_alt" required>
            <label for="date_debut">Date de début de diffusion :</label>
            <input type="date" name="date_debut" required>
            <label for="date_fin">Date de fin de diffusion :</label>
            <input type="date" name="date_fin" required>
            <label for="synopsis">Synopsis :</label>
            <textarea name="synopsis" class="synopsis "required></textarea>
            <label for="nbr_episode">Nombre d'épisodes :</label>
            <input type="text" name="nbr_episode" required>
            <label for="duree_episode">Durée de chaque épisode en minutes :</label>
            <input type="text" name="duree_episode" required>
            <label for="image">Image (Ultra wide) :</label>
            <input type="file" name="image" accept=".jpg, .jpeg, .png" required>
            <label for="image_mini">Image miniature :</label>
            <input type="file" name="image_mini" accept=".jpg, .jpeg, .png" required>
            <input type="submit" value="Ajouter">
        </form>
        <button class="crud-add">Ajouter un anime</button>
        
        <?php
            if (!empty($_SESSION['alert'])) :
        ?>
            <div class="message <?= $_SESSION['alert']['type'] ?>">
                <?= $_SESSION['alert']['msg'] ?>
            </div>
        <?php
            endif
        ?>

        <article>

            <?php if(!empty($animes)) foreach ($animes as $anime) { ?>
                <div>
                    <img src="<?=URL?>public/image/animes/<?=$anime->getImage_miniature()?>" alt="Miniature de <?=$anime->getNom()?>">
                    <p><?=$anime->getNom()?></p>
                    <p><?=$anime->getNom_alt()?></p>
                    <p><?=$anime->getDate_debut()?></p>
                    <p><?=$anime->getDate_fin()?></p>
                    <p><?=$anime->getNombre_episode()?></p>
                    <p><?=$anime->getDuree_episode()?></p>
                    <div>
                        <button> <a href="<?=URL?>admin/anime/afficher/<?=$anime->getId()?>">Afficher</a></button>
                        <button>
                            <a href="<?=URL?>admin/anime/supprimer/<?=$anime->getId()?>">Supprimer</a>
                        </button>
                    </div>
                </div>
            <?php } ?>

        </article>
        
    </section>


<?php
$titre = "Admin anime";
$content = ob_get_clean();
require_once "template.php";