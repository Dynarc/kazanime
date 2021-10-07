<?php ob_start();?>




<?php
$titre = "Proposer un anime";
$content = ob_get_clean();
require_once "template.php";


require_once 'Models/UserManager.class.php';
$test = new UserManager;
var_dump($test->getUserData(0));