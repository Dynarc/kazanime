<?php ob_start();?>

<section class="anime-view">
    <article class="anime-view-main">
        <!-- netflix view -->
        
        <img src="<?=URL.'public/image/animes/'.$anime->getImage()?>" alt="Image de <?=$anime->getNom()?>">
        
        <div class="shadow-left"></div>
        <div class="shadow-bottom"></div>

        <div>
            <h1 class="RO" ><?=$anime->getNom()?></h1>

            <p><?=$anime->getNombre_episode()?> épisodes - <?=$anime->getDuree_episode()?> min.</p>

            <p>Titre alternatif: <?=$anime->getNom_alt()?></p>

            <p>Genre: (WIP)</p>

            <p>Synopsis: <?=$anime->getSynopsis()?></p>
        </div>

    </article>
    <article class="anime-view-infos">
        <!-- Infos view  -->
        <?php
        $today = new DateTime("now");
        $start = new DateTime($anime->getDate_debut());
        $end = new DateTime($anime->getDate_fin());
        ?>
        <h2 class="RO">Informations supplémentaires :</h2>

        <div>
            <p>Studio: (WIP)</p>

            <p>Tag: (WIP)</p>

            <p>Date de diffusion: <?=date('d-m-Y', strtotime($anime->getDate_debut()))?> au <?=date('d-m-Y', strtotime($anime->getDate_fin()))?> <?= $start > $today ? '(A venir)' : ($end < $today ? '(Terminé)' : '(En cours)') ?></p>

            <p>Diffusé chez: (WIP)</p>
        </div>
        
    </article>
    <article class="anime-view-com">
        <!-- Commentaire (hardcoded) -->
        <h2 class="RO">Esapce commentaire:</h2>

        <div class="com">
            <figure>
                <img src="https://picsum.photos/200" alt="image wip">
                <figcaption>pseudo</figcaption>
            </figure>
            <div>
                <p>Commentaire de la personne, zeji heoir zqiefh iozqeufhioqehfiozquhefiezhfizhei hrih hqsfuhudh usdhfis hsiu hsd hs hdf ushdfih fdu hshid fushd fh difuhsdiuf hisfhd sudfhdiu hfsi fhsiduhf</p>
                <small>Posté le 01/01/1970</small>
            </div>
        </div>
        <div class="com">
            <figure>
                <img src="https://picsum.photos/200" alt="image wip">
                <figcaption>pseudo</figcaption>
            </figure>
            <div>
                <p>Commentaire de la personne, zeji heoir zqiefh iozqeufhioqehfiozquhefiezhfizhei hrih hqsfuhudh usdhfis hsiu hsd hs hdf ushdfih fdu hshid fushd fh difuhsdiuf hisfhd sudfhdiu hfsi fhsiduhf</p>
                <small>Posté le 01/01/1970</small>
            </div>
        </div>
        <div class="com">
            <figure>
                <img src="https://picsum.photos/200" alt="image wip">
                <figcaption>pseudo</figcaption>
            </figure>
            <div>
                <p>Commentaire de la personne, zeji heoir zqiefh iozqeufhioqehfiozquhefiezhfizhei hrih hqsfuhudh usdhfis hsiu hsd hs hdf ushdfih fdu hshid fushd fh difuhsdiuf hisfhd sudfhdiu hfsi fhsiduhf</p>
                <small>Posté le 01/01/1970</small>
            </div>
        </div>
    </article>
</section>




<?php
$titre = $anime->getNom();
$content = ob_get_clean();
require_once "template.php";