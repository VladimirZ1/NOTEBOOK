<?php
session_start();

require_once("config.php");
require_once("DBClass.php");
require_once("UserClass.php");

$dataForm['login'] = $_POST['login'];
$dataForm['pass'] = $_POST['pass'];

$vDataForm = UserClass::validateForm($dataForm);

if (!$vDataForm) {
	$user = new UserClass($dataForm['login'],$dataForm['pass'],null);
	

	if ($user->auth()) {
		
		$vDataForm['OK'] = "OK";
        $_SESSION["id"] = $user->getId();
	} else {
		$vDataForm['login'] = "Неправильный логин или пароль";
	}

}

header('Content-Type: application/json');
echo json_encode($vDataForm);

?>