<?php ob_start();?>

<section class="login">
    
    <h1 class="RO">Connexion</h1>
    
    <form action="">
        
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo">

        <label for="password">Mot de passe</label>
        <input type="password" name="password">

        <input type="submit" value="Se connecter" class="RO">

    </form>

    <u><a href="">Mot de passe oublié ?</a></u>

    <p>Pas encore de compte ? <u><a href="<?=URL?>inscription">S'inscrire</a></u></p>

</section>



<?php
$titre = "Connexion";
$content = ob_get_clean();
require_once "template.php";