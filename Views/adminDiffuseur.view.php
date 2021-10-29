<?php ob_start() ?>

    <h2 class="crud-title">Liste des diffuseurs</h2>
    <section class="crud-list">
        <article>

            <?php if(!empty($diffuseurs)) foreach ($diffuseurs as $diffuseur) { ?>
                <div>
                    <p><?=$diffuseur->getNom()?></p>
                    <a href="https://<?=$diffuseur->getLien()?>"><?=$diffuseur->getLien()?></a>
                    <div>
                        <button value="<?=URL?>admin/diffuseur/modifier/<?=$diffuseur->getId()?>">Modifier</button>
                        <button>
                            <a href="<?=URL?>admin/diffuseur/supprimer/<?=$diffuseur->getId()?>">Supprimer</a>
                        </button>
                    </div>
                </div>
            <?php } ?>

        </article>
        <form action="<?=URL?>admin/diffuseur/ajouter" method="POST" class="form-crud-add">
            <label for="diffuseur">Nouveau diffuseur :</label>
            <input type="text" name="diffuseur">
            <label for="">Lien diffuseur :</label>
            <input type="text" name="lien">
            <input type="submit" value="Ajouter">
        </form>
        <form action="" method="POST" class="form-crud-modify">
            <label for="diffuseur">Update du diffuseur :</label>
            <input type="text" name="new_diffuseur">
            <label for="lien">Update du lien :</label>
            <input type="text" name="new_lien">
            <input type="submit" value="Mettre à jour">
        </form>
        <button class="crud-add">Ajouter un diffuseur</button>
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
$titre = "Admin diffuseur";
$content = ob_get_clean();
require_once "template.php";