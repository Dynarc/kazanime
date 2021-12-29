<?php ob_start();?>

<section class="login">
    
    <h1 class="RO">Connexion</h1>
    
    <form action="<?=URL?>connexion/connect" method="POST">
        
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" required>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" required>

        <label for="remember">Se souvenir de moi ?</label>
        <input type="checkbox" name="remember">

        <input type="submit" value="Se connecter" class="RO">

    </form>

    <u><a href="">Mot de passe oublié ?</a></u>

    <p>Pas encore de compte ? <u><a href="<?=URL?>inscription">S'inscrire</a></u></p>

    <?php
        if (!empty($_SESSION['alert'])) :
    ?>
        <div class="message <?= $_SESSION['alert']['type'] ?>">
            <?= $_SESSION['alert']['msg'] ?>
        </div>
    <?php
        endif
    ?>

</section>



<?php
var_dump($_POST);
$titre = "Connexion";
$content = ob_get_clean();
require_once "template.php";