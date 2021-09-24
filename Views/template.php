<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/css/style.css">
    <title><?=$titre?></title>
</head>
<body>

    <header>
        <div id="brand">
            <h1>Kazanime</h1>
            <a href='https://www.freepik.com/vectors/background'>Background vector created by upklyak - www.freepik.com</a>
        </div>

        <nav>
            <ul class="RO">

                <li><a href="<?=URL?>accueil">Accueil</a></li>
                <li><a href="">Liste des animes</a></li>
                <li><a href="">Proposer un anime</a></li>
                <li><a href="">Mon compte</a></li>
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
        
    </header>
    

    <?= $content ?>

    <footer>
        <nav>
            <ul>

                <li><a href="<?=URL?>accueil">Accueil</a></li>
                <li><a href="">Liste des animes</a></li>
                <li><a href="">Proposer un anime </a></li>
                <li><a href="">Mon compte</a></li>
                <li><a href="">A propos</a></li>
                <li><a href="">Contact</a></li>

            </ul> 
        </nav>
    </footer>

    <script src="public/js/script.js"></script>
</body>
</html>