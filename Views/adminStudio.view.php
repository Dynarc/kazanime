<?php ob_start() ?>

    <h2 class="crud-title">Liste des studios</h2>
    <section class="crud-list">
        <article>

            <?php  if(!empty($studios)) foreach ($studios as $studio) { ?>
                <div>
                    <p><?=$studio->getNom()?></p>
                    <div>
                        <button value="<?=URL?>admin/studio/modifier/<?=$studio->getId()?>">Modifier</button>
                        <button>
                            <a href="<?=URL?>admin/studio/supprimer/<?=$studio->getId()?>">Supprimer</a>
                        </button>
                    </div>
                </div>
            <?php } ?>

        </article>
        <form action="<?=URL?>admin/studio/ajouter" method="POST" class="form-crud-add">
            <label for="studio">Nouveau studio :</label>
            <input type="text" name="studio">
            <input type="submit" value="Ajouter">
        </form>
        <form action="" method="POST" class="form-crud-modify">
            <label for="studio">Update du studio :</label>
            <input type="text" name="new_studio">
            <input type="submit" value="Mettre à jour">
        </form>
        <button class="crud-add">Ajouter un studio</button>
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
$titre = "Admin studio";
$content = ob_get_clean();
require_once "template.php";