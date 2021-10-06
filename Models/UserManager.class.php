<?php
require_once 'User.class.php';
require_once 'Model.class.php';

class UserManager extends Model{

    public function checkUserPseudo($pseudo){
        $sql = "SELECT * FROM user where pseudo = :pseudo";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ':pseudo'=> $pseudo,
        ]);
        $user = $req->fetchAll(PDO::FETCH_OBJ);
        return $user;
    }

    public function checkUserMail($mail){
        $sql = "SELECT * FROM user where mail = :mail";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ':mail'=> $mail,
        ]);
        $user = $req->fetchAll(PDO::FETCH_OBJ);
        return $user;
    }

    public function accountLogin($data){
        $sql = "SELECT * FROM user where mail = :data OR pseudo = :data";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ':data'=> $data,
        ]);
        $user = $req->fetchAll(PDO::FETCH_OBJ);
        return $user;
    }

    public function accountRegister($pseudo, $mail, $password){
        $sql = "INSERT INTO user(pseudo, mail, mdp, id_role) VALUES (:pseudo, :mail, :password, (select id_role from role where nom = 'user'))";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ':pseudo'=> $pseudo,
            ':mail'=> $mail,
            ':password'=> $password,
        ]);
        $user = $req->fetchAll(PDO::FETCH_OBJ);
    }


}