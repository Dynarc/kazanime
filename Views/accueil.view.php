<?php ob_start();?>
<p>page d'accueil totalement vide</p>
<?php
$titre = "Accueil";
$content = ob_get_clean();
require_once "template.php";