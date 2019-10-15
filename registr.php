<?php
require_once("config.php");
require_once("DBClass.php");
require_once("UserClass.php");

$dataForm['login'] = $_POST['login'];
$dataForm['pass1'] = $_POST['pass1'];
$dataForm['pass2'] = $_POST['pass2'];
$dataForm['email'] = $_POST['email'];

$vDataForm = validateForm($dataForm);



if (!$vDataForm) {
	$user = new UserClass($dataForm['login'],$dataForm['pass1'],$dataForm['email']);

	if ($user->iS()) {
		$vDataForm['login'] = "Логин уже существует";

	} else {
		$vDataForm['OK'] = "OK";
		$user->save();
	}
	
}


resultOut($vDataForm);

;

function resultOut($data) {
  header('Content-Type: application/json');
  echo json_encode($data);
};

function validateForm($dataForm) {
	$data = null;
	static $string = "Поле обязательно для ввода";
    

	if (!$dataForm['login']) 
		$data['login'] = $string;
	

	if (!$dataForm['pass1']) 
		$data['pass1'] = $string;
	

	if (!$dataForm['pass2']) {
		$data['pass2'] = $string;
	} 
    if ($dataForm['pass2'] && $dataForm['pass1']) {
		if ($dataForm['pass2'] != $dataForm['pass1']) {
			$data['pass1'] = "Пароли не совпадают";
		   	$data['pass2'] = "";
    	}
    }

	if (!$dataForm['email']) {
		$data['email'] = $string;
	} else {
		if (!filter_var($dataForm['email'], FILTER_VALIDATE_EMAIL)) {
			$data['email'] = "E-mail адрес указан неверно";
		}
	}
	

	return $data;

}

?>