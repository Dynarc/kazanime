<?php ob_start();?>

<section class="login">
    
    <h1 class="RO">Inscription</h1>
    
    <form action="">
        
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo">

        <label for="email">Email</label>
        <input type="email" name="email">

        <label for="password">Mot de passe</label>
        <input type="password" name="password">

        <label for="password-confirm">Confirmer le mot de passe</label>
        <input type="password" name="password-confirm">

        <input type="submit" value="Se connecter" class="RO">

    </form>

    <p>Vous avez déjà un compte ? <u><a href="<?=URL?>connexion">Se connecter</a></u></p>

</section>



<?php
$titre = "Inscription";
$content = ob_get_clean();
require_once "template.php";