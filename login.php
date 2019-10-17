<?php
session_start();

require_once("config.php");
require_once("DBClass.php");
require_once("UserClass.php");

$dataForm['login'] = $_POST['login'];
$dataForm['pass'] = $_POST['pass'];

$vDataForm = validateForm($dataForm);

if (!$vDataForm) {
	$user = new UserClass($dataForm['login'],$dataForm['pass'],null);
	

	if ($user->auth()) {
		
		$vDataForm['OK'] = "OK";
        $_SESSION["id"] = $user->getId();
	} else {
		$vDataForm['login'] = "Неправильный логин или пароль";
	}



}

resultOut($vDataForm);

function resultOut($data) {
  header('Content-Type: application/json');
  echo json_encode($data);
};

function validateForm($dataForm) {
	$data = null;
	static $string = "Поле обязательно для ввода";
    

	if (!$dataForm['login']) 
		$data['login'] = $string;
	

	if (!$dataForm['pass']) 
		$data['pass'] = $string;
	

	return $data;

}


?>