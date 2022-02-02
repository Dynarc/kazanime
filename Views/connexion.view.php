<?php ob_start();?>

<section class="login">
    
    <h1 class="RO">Connexion</h1>
    
    <form action="<?=URL?>connexion/connect" method="POST">
        
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" required>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>

        <label for="remember">Se souvenir de moi ?</label>
        <input type="checkbox" name="remember" id="remember">

        <input type="submit" value="Se connecter" class="RO">

    </form>

    <u><a href="">Mot de passe oublié ?</a></u> <!-- WIP -->

    <p>Pas encore de compte ? <u><a href="<?=URL?>inscription">S'inscrire</a></u></p>

</section>



<?php
$titre = "Connexion";
$content = ob_get_clean();
require_once "template.php";