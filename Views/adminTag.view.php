<?php ob_start() ?>

    <h2 class="crud-title">Liste des tags</h2>
    <section class="crud-list">
        <article>

            <?php foreach ($tags as $tag) { ?>
                <div>
                    <p><?=$tag->getNom()?></p>
                    <div>
                        <button value="<?=URL?>admin/tag/modifier/<?=$tag->getId()?>">Modifier</button>
                        <button>
                            <a href="<?=URL?>admin/tag/supprimer/<?=$tag->getId()?>">Supprimer</a>
                        </button>
                    </div>
                </div>
            <?php } ?>

        </article>
        <form action="<?=URL?>admin/tag/ajouter" method="POST" class="form-crud-add">
            <label for="tag">Nouveau tag :</label>
            <input type="text" name="tag">
            <input type="submit" value="Ajouter">
        </form>
        <form action="" method="POST" class="form-crud-modify">
            <label for="tag">Update du tag :</label>
            <input type="text" name="new_tag">
            <input type="submit" value="Mettre à jour">
        </form>
        <button class="crud-add">Ajouter un tag</button>
    </section>


<?php
$titre = "Admin tag";
$content = ob_get_clean();
require_once "template.php";