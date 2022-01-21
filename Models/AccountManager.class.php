<?php
require_once 'Account.class.php';
require_once 'model.class.php';

class AccountManager extends Model{
    private $accounts;

    public function getAccounts(){
        return $this->accounts;
    }

    public function loadingAccounts(){
        $sql = "SELECT * FROM user";
        $req = $this->getDB()->prepare($sql);
        $req->execute();
        $users = $req->fetchAll(PDO::FETCH_OBJ);
        foreach($users as $account){
            $account = new Account($account->id_user ,$account->pseudo, $account->mail, null, $account->date_inscription, $account->id_role);
            $this->addAccount($account);
        }
    }

    public function addAccount($account) {
        $this->accounts[] = $account;
    }

    public function addAccountDB($pseudo, $mail, $password, $id_role) {
        $sql = "INSERT INTO user(pseudo, mail, mdp, id_role) values (:pseudo, :mail, :mdp, :id_role)";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ":pseudo" => $pseudo,
            ":mail" => $mail,
            ":mdp" => $password,
            ":id_role" => $id_role
        ]);
        if($result){
            $user = $this->getAccountById($this->getDB()->lastInsertId());
            $user = $user[0];
            $account = new Account($user->id_user, $user->pseudo, $user->mail, $user->mdp, $user->date_inscription, $user->role);
            return $user;
        }
    }

    public function getAccountByPseudo($pseudo) {
        $sql = "SELECT pseudo FROM user where pseudo = :pseudo";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ":pseudo" => $pseudo
        ]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getAccountByMail($mail) {
        $sql = "SELECT mail FROM user where mail = :mail";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ":mail" => $mail
        ]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getAccountById($id) {
        $sql = "SELECT id_user, pseudo, mail, mdp, date_inscription, nom AS role FROM user
                INNER JOIN role ON user.id_role = role.id_role
                WHERE id_user = :id";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ":id" => $id
        ]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function accountConnection($pseudo) {
        $sql = "SELECT id_user, pseudo, mail, mdp, date_inscription, nom AS role FROM user
                INNER JOIN role ON user.id_role = role.id_role
                WHERE pseudo = :pseudo OR mail = :pseudo";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ":pseudo" => $pseudo
        ]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}