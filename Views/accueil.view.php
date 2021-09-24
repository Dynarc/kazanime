<?php ob_start();?>

<div class="vedette">
    <h2 class="RO">En vedette</h2>

    <div>
        <i class="fas fa-chevron-left"></i>

        <div>
            <figure class="carousel-frame">
                <img src="https://picsum.photos/480/270" alt="">
                <figcaption>image random 1</figcaption>
            </figure>
            <figure class="carousel-frame">
                <img src="https://picsum.photos/480/270" alt="">
                <figcaption>image random 2</figcaption>
            </figure>
            <figure class="carousel-frame">
                <img src="https://picsum.photos/480/270" alt="">
                <figcaption>image random 3</figcaption>
            </figure>   
        </div>

        <i class="fas fa-chevron-right"></i>
    </div>

</div>

<section class="main-accueil">

    <article class="last-anime-added">

        <h2 class="RO">Derniers animes ajoutés</h2>

        <div class="last-added">
            <img src="https://picsum.photos/150/150" alt="">
            <p>ceci est le nom d'un anime</p>
        </div>

        <div class="last-added">
            <img src="https://picsum.photos/150/150" alt="">
            <p>ceci est le nom d'un anime</p>
        </div>

        <div class="last-added">
            <img src="https://picsum.photos/150/150" alt="">
            <p>ceci est le nom d'un anime</p>
        </div>

        <div class="last-added">
            <img src="https://picsum.photos/150/150" alt="">
            <p>ceci est le nom d'un anime</p>
        </div>

        <a href="">Voir plus <i class="fas fa-plus"></i></a>
        
    </article>

    <div class="separate"></div>
    
    <article class="last-episode-added">

        <h2 class="RO">Derniers épisodes ajoutés</h2>

        <div class="last-added">
            <img src="https://picsum.photos/150/150" alt="">
            <div>
                <p>ceci est le nom d'un anime</p>
                <small>episode 45: le nid de coucou</small>
            </div>
        </div>

        <div class="last-added">
            <img src="https://picsum.photos/150/150" alt="">
            <div>
                <p>ceci est le nom d'un anime</p>
                <small>episode 45: le nid de coucou</small>
            </div>
        </div>

        <div class="last-added">
            <img src="https://picsum.photos/150/150" alt="">
            <div>
                <p>ceci est le nom d'un anime</p>
                <small>episode 45: le nid de coucou</small>
            </div>
        </div>

        <div class="last-added">
            <img src="https://picsum.photos/150/150" alt="">
            <div>
                <p>ceci est le nom d'un anime</p>
                <small>episode 45: le nid de coucou</small>
            </div>
        </div>

        <a href="">Voir plus <i class="fas fa-plus"></i></a>

    </article>

</section>

<?php
$titre = "Accueil";
$content = ob_get_clean();
require_once "template.php";