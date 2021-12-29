<?php

require_once 'Models/accountManager.class.php';

class AccountController{

    private $accountManager;

    public function __construct(){
        $this->accountManager = new AccountManager;
    }

    public function displayAccounts(){
        $this->accountManager->loadingAccounts();
        $accounts = $this->accountManager->getAccounts();
        require_once 'views/adminAccount.view.php';
        unset($_SESSION['alert']);
    }

    public function inscriptionHome(){
        require_once 'views/inscription.view.php';
        unset($_SESSION['alert']);
    }

    public function connexionHome() {
        require_once 'views/connexion.view.php';
        unset($_SESSION['alert']);
    }

    public function connect($user) {
        $_SESSION['user'] = $user;
        header('Location: '.URL.'accueil');
    }

    private function rememberUser($user, $time) {
        setcookie('user', $user, time() + $time);
    }

    public function disconnect() {
        unset($_SESSION['user']);
        setcookie('user', null, time() - 3600);
        header('Location: '.URL.'accueil');
    }

    public function createAccount() {
        $error = "";
        try {
            if(empty($_POST['pseudo'])){
                $error .= "<p>Vous devez mettre votre pseudo</p>";
            } else if(strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20) {
                $error .= "<p>Votre pseudo doit faire 4 caractères minimum et 20 caractères maximum</p>";
            } else if(preg_match('/[^a-zA-Z0-9-_éè]/',$_POST['pseudo'])) {
                $error .= "<p><Votre pseudo contient des caractères interdits. Seul les lettres, les chiffres et les tirets sont autorisés./p>";
            }

            if(empty($_POST['email'])){
                $error .= "<p>Vous devez mettre votre mail</p>";
            } else if(!preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $_POST['email'])) {
                $error .= "<p>Votre mail n'est pas dans un format valide</p>";
            }
            
            if(empty($_POST['password'])){
                $error .= "<p>Vous devez mettre un mot de passe</p>";
            } else if(strlen($_POST['password']) < 6 || strlen($_POST['password']) > 30) {
                $error .= "<p>Le mot de passe doit faire entre 6 et 30 caractères de long</p>";
            }

            if(empty($_POST['password-confirm']) || $_POST['password'] != $_POST['password-confirm']){
                $error .= "<p>Le mot de passe et sa confirmation doivent être identique</p>";
            }

            if(!empty($this->accountManager->getAccountByMail($_POST['email']))) {
                $error .= "<p>Un compte utilise déjà cet email</p>";
            }

            if(!empty($this->accountManager->getAccountByPseudo($_POST['pseudo']))) {
                $error .= "<p>Un compte utilise déjà ce pseudo</p>";
            }

            if(!empty($error)){
                throw new Exception($error);
            }

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $user = $this->accountManager->addAccountDB($_POST['pseudo'], $_POST['email'], $password, 2);

            $this->connect($user);

            GlobalController::alert("succes","<p>Le compte a bien été créé</p>");
            
        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
            header('Location: '.URL.'inscription');
        }
        
    }

    public function connexion() {
        $error = "";
        try {
            if(empty($_POST['pseudo'])) {
                $error = "<p>Vous devez mettre votre pseudo</p>";
            }

            if(empty($_POST['password'])) {
                $error .= "<p>Vous devez mettre votre mot de passe</p>";
            }

            if(!empty($error)){
                throw new Exception($error);
            }

            $userData = $this->accountManager->accountConnection($_POST['pseudo']);

            if(! $userData) {
                throw new Exception("<p>Aucun compte n'a été trouvé</p>");
            }

            if (password_verify($_POST['password'], $userData[0]->mdp)) {
                GlobalController::alert("succes","<p>Connexion effectuée</p>");
                $this->connect($userData[0]);
            } else {
                throw new Exception("<p>Mot de passe invalide</p>");
            }
            
            
        } catch (Exception $e) {
            GlobalController::alert('echec',$e->getMessage());
            header('Location: '.URL.'connexion');
        }
    }

}