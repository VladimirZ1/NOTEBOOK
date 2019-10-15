<?php
require_once("DBClass.php");

class UserClass {
	private $login, $pass, $email;

	function __construct($login, $pass, $email) {
		$this->login = $login;
		$this->pass = $pass;
		$this->email = $email;
		$this->user = new DBClass(SERVER,USER,PASS,DBNAME);

	}

	public function iS() {	
		$login = $this->user->select("login","user","login='".$this->login."'");

		if ($login) {
			return true;
		}
		return false;
	}

	public function auth() {		
		$user = $this->user->select("login","user","login='".$this->login."' and pass='".$this->pass."'");

		if ($user) {
			return true;
		}
		return false;
	}

	public function save() {
		if (!$this->iS()) {
			$this->user->insert("user", array($this->login,$this->pass,$this->email));
		}

		
	}
}

?>