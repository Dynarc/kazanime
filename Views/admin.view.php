<?php ob_start() ?>

<section class="admin-home">

    <p>Que voulez vous gérer ?</p>
    <article>
        <ul>
            <li>
                <a href="<?=URL?>admin/anime">Anime</a>
            </li>
            <li>
                <a href="<?=URL?>admin/episode">Episode</a>
            </li>
            <li>
                <a href="<?=URL?>admin/commentaire">Commentaire</a>
            </li>
            <li>
                <a href="<?=URL?>admin/tag">Tag</a>
            </li>
            <li>
                <a href="<?=URL?>admin/genre">Genre</a>
            </li>
            <li>
                <a href="<?=URL?>admin/studio">Studio</a>
            </li>
            <li>
                <a href="<?=URL?>admin/diffuseur">Diffuseur</a>
            </li>
            <li>
                <a href="<?=URL?>admin/utilisateur">Utilisateur</a>
            </li>
            <li>
                <a href="<?=URL?>admin/sanction">Sanction</a>
            </li>
            <li>
                <a href="<?=URL?>admin/proposition">Proposition</a>
            </li>
            
        </ul>
    </article>

</section>


<?php
$titre = "Administration";
$content = ob_get_clean();
require_once "template.php";