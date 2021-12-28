<?php

class Account {
    private $id;
    private $pseudo;
    private $email;
    private $password;
    private $date_inscription;
    private $role;

    public function __construct($id, $pseudo, $email, $password, $date_inscription, $role) {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
        $this->date_inscription = $date_inscription;
        $this->role = $role;
    }

	public function getId() {
		return htmlspecialchars($this->id);
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	public function getPseudo() {
		return htmlspecialchars($this->pseudo);
	}

	public function setPseudo($pseudo) {
		$this->pseudo = $pseudo;
		return $this;
	}

	public function getEmail() {
		return htmlspecialchars($this->email);
	}

	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	public function getPassword() {
		return htmlspecialchars($this->password);
	}

	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}

	public function getDate_inscription() {
		return htmlspecialchars($this->date_inscription);
	}

	public function setDate_inscription($date_inscription) {
		$this->date_inscription = $date_inscription;
		return $this;
	}

	public function getRole() {
		return htmlspecialchars($this->role);
	}

	public function setRole($role) {
		$this->role = $role;
		return $this;
	}
}