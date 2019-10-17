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
		$userId = $this->user->select("id","user","login='".$this->login."'");

		if ($userId) {
			return true;
		}
		return false;
	}

	public function auth() {		
		$userId = $this->user->select("id","user","login='".$this->login."' and pass='".$this->pass."'");

		if ($userId) {
			return $userId;
		}
		return false;
	}

	public function save() {
		if (!$this->iS()) {
			$this->user->insert("user", array($this->login,$this->pass,$this->email),"login,pass,email");
		}
	}

	public function getId() {	
		$result = $this->user->select("id","user","login='".$this->login."'");
		
		if ($result) {

			return $result[0]['id'];
		}
		return false;
	}

}

?>