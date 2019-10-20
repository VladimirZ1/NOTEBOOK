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

	public static function validateForm($dataForm) {
		$data = null;
		$string = "Поле обязательно для ввода";
	    

		if (!$dataForm['login']) 
			$data['login'] = $string;

		if (isset($dataForm['pass']) && !$dataForm['pass']) 
			$data['pass'] = $string;
		
		if (isset($dataForm['pass1']) && !$dataForm['pass1']) 
			$data['pass1'] = $string;
		
		if (isset($dataForm['pass2']) && !$dataForm['pass2']) {
			$data['pass2'] = $string;
		} 
	    if ($dataForm['pass2'] && $dataForm['pass1']) {
			if ($dataForm['pass2'] != $dataForm['pass1']) {
				$data['pass1'] = "Пароли не совпадают";
			   	$data['pass2'] = "";
	    	}
	    }

		if (isset($dataForm['email'])) { 
			if (!$dataForm['email']) {
				$data['email'] = $string;
		    } else if (!filter_var($dataForm['email'], FILTER_VALIDATE_EMAIL)) {
				$data['email'] = "E-mail адрес указан неверно";
		    }
	    }
		
		

		return $data;
	}

	
	public function auth() {		
		$userId = $this->user->select("id","user","login='".$this->login."' and pass='".$this->pass."'");

		if ($userId) {
			return $userId;
		}
		return false;
	}

	public function save() {
		if (!$this->getId()) {
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