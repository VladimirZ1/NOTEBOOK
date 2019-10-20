<?php
session_start();

require_once("config.php");
require_once("DBClass.php");
require_once("UserClass.php");

$dataForm['login'] = $_POST['login'];
$dataForm['pass1'] = $_POST['pass1'];
$dataForm['pass2'] = $_POST['pass2'];
$dataForm['email'] = $_POST['email'];

$vDataForm = UserClass::validateForm($dataForm);



if (!$vDataForm) {
	$user = new UserClass($dataForm['login'],$dataForm['pass1'],$dataForm['email']);

	if ($user->getId()) {
		$vDataForm['login'] = "Логин уже существует";

	} else {
		$vDataForm['OK'] = "OK";
		$user->save();
		$_SESSION["id"] = $user->getId();
	}
	
}

header('Content-Type: application/json');
echo json_encode($vDataForm);

?>