<?php ob_start();?>

<section id="anime-list">
    <form action="" id="anime-list-search">
        <p class="RO">Recherche</p>

        <div>
            <label for="">Nom&nbsp;:</label>
            <input type="text">
        </div>

        <div>
            <label for="">Trier&nbsp;par&nbsp;:</label>
            <select name="" id="">
                <option value=""></option>
                <option value="">A-Z</option>
                <option value="">Z-A</option>
            </select>
        </div>

        <button type="button">Recherche avancée <i class="fas fa-sort-down"></i></button>

        <div id="anime-list-search-date">
            <label for="">Date&nbsp;comprise&nbsp;entre</label>
            <div>
                <input type="date">
                <span> et </span>
                <input type="date">
            </div>
            
        </div>

        <div>
            <label for="">Genre&nbsp;:</label>
            <select name="" id="">
                <option value="">Action</option>
                <option value="">Mystère</option>
                <option value="">Horreur</option>
            </select>
        </div>

        <div>
            <label for="">Tag&nbsp;:</label>
            <select name="" id="">
                <option value="">Magie</option>
                <option value="">Shinigami</option>
                <option value="">blabla</option>
            </select>
        </div>

        <input type="submit" value="Rechercher">

        

    </form>

    <article class="display-list-anime">
        <div class="anime-line">
            <div class="RO desc-list">Anime</div>
            <p class="RO">Episodes</p>
            <p class="RO">Date de diffusion</p>
        </div>

        <div class="anime-line">
            <img src="https://picsum.photos/150/150" alt="">
            <div>
                <h2>blablacar</h2>
                <p>azertyu zert y rty tg o pp jhg sdfnbtdx tfvboi iobufycytv oinjihbyfct ciu bni ngv xc yuvoin h bhfcg xuy vgion pijb jigc guc jbl n ihvhc jh fcjhbpon pj bjk gvfc f cj bhp jbo hv hc gvoi</p>
            </div>
            <p>15</p>
            <p>02/02/2002 au 02/02/2020</p>
        </div>

        <div class="anime-line">
            <img src="https://picsum.photos/150/150" alt="">
            <div>
                <h2>blablacar</h2>
                <p>azertyu zert y rty tg o pp jhg sdfnbtdx tfvboi iobufycytv oinjihbyfct ciu bni ngv xc yuvoin h bhfcg xuy vgion pijb jigc guc jbl n ihvhc jh fcjhbpon pj bjk gvfc f cj bhp jbo hv hc gvoi</p>
            </div>
            <p>15</p>
            <p>02/02/2002 au 02/02/2020</p>
        </div>

        <div class="anime-line">
            <img src="https://picsum.photos/150/150" alt="">
            <div>
                <h2>blablacar</h2>
                <p>azertyu zert y rty tg o pp jhg sdfnbtdx tfvboi iobufycytv oinjihbyfct ciu bni ngv xc yuvoin h bhfcg xuy vgion pijb jigc guc jbl n ihvhc jh fcjhbpon pj bjk gvfc f cj bhp jbo hv hc gvoi</p>
            </div>
            <p>15</p>
            <p>02/02/2002 au 02/02/2020</p>
        </div>

        <div class="anime-line">
            <img src="https://picsum.photos/150/150" alt="">
            <div>
                <h2>blablacar</h2>
                <p>azertyu zert y rty tg o pp jhg sdfnbtdx tfvboi iobufycytv oinjihbyfct ciu bni ngv xc yuvoin h bhfcg xuy vgion pijb jigc guc jbl n ihvhc jh fcjhbpon pj bjk gvfc f cj bhp jbo hv hc gvoi</p>
            </div>
            <p>15</p>
            <p>02/02/2002 au 02/02/2020</p>
        </div>

        <div class="anime-line">
            <img src="https://picsum.photos/150/150" alt="">
            <div>
                <h2>blablacar</h2>
                <p>azertyu zert y rty tg o pp jhg sdfnbtdx tfvboi iobufycytv oinjihbyfct ciu bni ngv xc yuvoin h bhfcg xuy vgion pijb jigc guc jbl n ihvhc jh fcjhbpon pj bjk gvfc f cj bhp jbo hv hc gvoi</p>
            </div>
            <p>15</p>
            <p>02/02/2002 au 02/02/2020</p>
        </div>

        <div class="anime-line">
            <img src="https://picsum.photos/150/150" alt="">
            <div>
                <h2>blablacar</h2>
                <p>azertyu zert y rty tg o pp jhg sdfnbtdx tfvboi iobufycytv oinjihbyfct ciu bni ngv xc yuvoin h bhfcg xuy vgion pijb jigc guc jbl n ihvhc jh fcjhbpon pj bjk gvfc f cj bhp jbo hv hc gvoi</p>
            </div>
            <p>15</p>
            <p>02/02/2002 au 02/02/2020</p>
        </div>

    </article>

</section>

<div class="nav-page">
    <a href="">1</a>
    <a href="">2</a>
    <a href="">3</a>
    <a href="">4</a>
    <a href="">5</a>
    <a href=""><i class="fas fa-step-forward"></i></a>
</div>

<?php
$titre = "Liste des animes";
$content = ob_get_clean();
require_once "template.php";