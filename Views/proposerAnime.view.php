<?php ob_start();?>

<section class="proposition">
    <h2>Saisissez le nom de l'anime que vous voulez proposer</h2>
    <form>
        <input type="text" name="search">
        <input type="submit" value="Vérifier">
    </form>

    <h2 class="proposition-suite-titre">Informations complémentaires</h2>

    <form action="<?URL?>proposer-anime/ajouter" method="POST" class="proposition-suite-form">
        <input type="hidden" name="nom">
        
        <div class="proposition-suite">

            <div>
                <div>
                    <label for="nom_alt">Titre&nbsp;alternatif&nbsp;:</label>
                    <input type="text" name="nom_alt">
                </div>
                
                <div>
                    <label for="nombre_episode">Nombre&nbsp;d'épisodes&nbsp;:</label>
                    <input type="text" name="nombre_episode">
                    <span>X</span>
                    <input type="text" name="duree_episode">
                    <span>min.</span>
                </div>
                
                <div>
                    <label for="synopsis">Synopsis&nbsp;:</label>
                    <textarea name="synopsis" id="" cols="30" rows="10"></textarea>                
                </div>

            </div>

            <div>
                <div>
                    <label for="studio">Studio&nbsp;:</label>
                    <input type="text" name="studio">
                </div>

                <div>
                    <label for="date_debut">Date&nbsp;de&nbsp;diffusion&nbsp;:</label>
                    <input type="text" name="date_debut">
                    <span> au </span>
                    <input type="text" name="date_fin">
                </div>
                

                <div>
                    <label for="diffuseur">Diffusé&nbsp;chez&nbsp;:</label>
                    <input type="text" name="diffuseur">
                </div>

                <div>
                    <label for="genre">Genre&nbsp;:</label>
                    <input type="text" name="genre">
                </div>

                <div>
                    <label for="tag">Tag&nbsp;:</label>
                    <input type="text" name="tag">
                </div>
            </div>

        </div>
        
        <input type="submit" value="Soumettre">
    </form>
</section>

<section class="display-proposition">

    <h2 class="RO">Animes proposés</h2>
    <article class="RO">
        <p>Anime proposé</p>
        <p>Date de soumission</p>
        <p>Statut</p>
    </article>
    <article>
        <p>Ceci est un anime proposé</p>
        <p>02/12/2021</p>
        <p><i class="fas fa-redo-alt"></i>En cours</p>
    </article>
    <article>
        <p>Ceci est un anime proposé</p>
        <p>02/12/2021</p>
        <p><i class="fas fa-redo-alt"></i>En cours</p>
    </article>
    <article>
        <p>Ceci est un anime proposé</p>
        <p>02/12/2021</p>
        <p><i class="fas fa-redo-alt"></i>En cours</p>
    </article>
    <article>
        <p>Ceci est un anime proposé</p>
        <p>02/12/2021</p>
        <p><i class="fas fa-redo-alt"></i>En cours</p>
    </article>
    <article>
        <p>Ceci est un anime proposé</p>
        <p>02/12/2021</p>
        <p><i class="fas fa-redo-alt"></i>En cours</p>
    </article>
</section>


<?php
$titre = "Proposer un anime";
$content = ob_get_clean();
require_once "template.php";