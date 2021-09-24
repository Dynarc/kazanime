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

<?php
$titre = "Accueil";
$content = ob_get_clean();
require_once "template.php";