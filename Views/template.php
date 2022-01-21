<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?=URL?>public/css/style.css">
    <link href="<?=URL?>favicon.ico" rel="icon" type="image/x-icon" />
    <title><?=$titre?></title>
</head>
<body>

    <header>
        <div id="brand">
            <a href="<?=URL?>admin"><h1>Kazanime</h1></a>
            <a href='https://fr.freepik.com/vecteurs/fond' target="_blank"><small>Fond vecteur créé par upklyak - fr.freepik.com</small></a>
        </div>

        <nav>
            <ul class="RO">

                <li><a href="<?=URL?>accueil">Accueil</a></li>
                <li><a href="<?=URL?>anime">Liste des animes</a></li>
                <li><a href="<?=URL?>proposer-anime">Proposer un anime</a></li>
                <?php if(isset($_SESSION['user'])) { ?>
                <li><a href="">Mon compte</a></li>
                <li><a href="<?=URL?>deconnexion"><i class="fas fa-user-slash"></i></a></li>
                <?php } else { ?>
                <li><a href="<?=URL?>connexion">Connexion</a> / <a href="<?=URL?>inscription">Inscription</a></li>
                <?php } ?>
                <li>
                    <i class="fas fa-search"></i>
                    <form action="" class="search">
                        <i class="fas fa-times"></i>
                        <div>
                            <input type="text">
                            <input type="submit" value="Rechercher">
                        </div>
                    </form>
                </li>

            </ul>

        </nav>

        <div class="responsive-menu"><i class="fas fa-bars"></i><i class="fas fa-times"></i></div>
        
    </header>
    

    <?= $content ?>

    <?php
        if (!empty($_SESSION['alert'])) :
    ?>
        <div class="message <?= $_SESSION['alert']['type'] ?>">
            <?= $_SESSION['alert']['msg'] ?>
        </div>
    <?php
        endif
    ?>

    <footer>
        <nav>
            <ul>

                <li><a href="<?=URL?>accueil">Accueil</a></li>
                <li><a href="<?=URL?>anime">Liste des animes</a></li>
                <li><a href="<?=URL?>proposer-anime">Proposer un anime </a></li>
                <li><a href="">Mon compte</a></li>
                <li><a href="">A propos</a></li>
                <li><a href="">Contact</a></li>

            </ul> 
        </nav>
    </footer>

    <script src="<?=URL?>public/js/script.js"></script>
    <script src="<?=URL?>public/js/<?=str_replace(' ','-',$titre)?>/script.js"></script>
</body>
</html>