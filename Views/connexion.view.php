<?php ob_start();?>

<section class="login">
    
    <h1 class="RO">Connexion</h1>
    
    <form action="<?=URL?>connexion/connect" method="POST">
        
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" required>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" required>

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
$titre = "Connexion";
$content = ob_get_clean();
require_once "template.php";