<?php ob_start() ?>

    <h2 class="crud-title">Liste des genres</h2>
    <section class="crud-list">
        <article>

            <?php if(!empty($genres)) foreach ($genres as $genre) { ?>
                <div>
                    <p><?=$genre->getNom()?></p>
                    <div>
                        <button value="<?=URL?>admin/genre/modifier/<?=$genre->getId()?>">Modifier</button>
                        <button>
                            <a href="<?=URL?>admin/genre/supprimer/<?=$genre->getId()?>">Supprimer</a>
                        </button>
                    </div>
                </div>
            <?php } ?>

        </article>
        <form action="<?=URL?>admin/genre/ajouter" method="POST" class="form-crud-add">
            <label for="genre">Nouveau genre :</label>
            <input type="text" name="genre">
            <input type="submit" value="Ajouter">
        </form>
        <form action="" method="POST" class="form-crud-modify">
            <label for="genre">Update du genre :</label>
            <input type="text" name="new_genre">
            <input type="submit" value="Mettre à jour">
        </form>
        <button class="crud-add">Ajouter un genre</button>
    </section>

    <?php
        if (!empty($_SESSION['alert'])) :
    ?>
        <div class="message <?= $_SESSION['alert']['type'] ?>">
            <?= $_SESSION['alert']['msg'] ?>
        </div>
    <?php
        endif
    ?>


<?php
$titre = "Admin genre";
$content = ob_get_clean();
require_once "template.php";