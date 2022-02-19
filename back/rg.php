<?php
session_start();
require_once "../back/lang.php";
$language= $_SESSION['lang'];

if (isset($_POST['log'], $_POST['pass'], $_POST['name'], $_POST['gen'], $_POST['bday'])){
	require_once "db.php";;
	$db = new Dbase();

	$name = $_POST['name'];
    $surname = $_POST['surname'];
	$log = $_POST['log'];
	$pass = $_POST['pass'];
	$gen = $_POST['gen'];
	$bday = $_POST['bday'];

    $error = 0;

	if (strlen($pass) < 6) {
		if($language== 'en'){
			header("Location:../front/Register.php?error=The length of password must be greater than 5");
		}
		else{
			header("Location:../front/Register.php?error=Длина пароля должна быть не менее 6 символов!");
		}
		$error++;
	}

	$take = $db->query("SELECT * FROM users WHERE login = '$log' OR name = '$name' LIMIT 1");

	if (!empty($take)) {
		foreach ($take as $key => $value) {
			if ($take[$key]['Login'] === $log) {
				if($language== 'en'){
					header("Location:../front/Register.php?error=This email is already taken");
				}
				else{
					header("Location:../front/Register.php?error=Такой логин уже существует!");
				}
				$error++;
			}
		}
	}

	if ($error == 0) {
		$sql = $db->sql("INSERT INTO `users`(`id`, `name`, `surname`, `login`, `password`, `birthday`, `gender`) VALUES ('','$name','$surname','$log','$pass','$bday', '$gen')");
		$role = $db->sql("INSERT INTO user_roles (`id`, `user`, `role`) VALUES ('','$log','user')");

		
		if($language== 'en'){
			header("Location:../front/index.php?reg=Registration was successful");
		}
		else{
			header("Location:../front/index.php?reg=Регистрация прошла успешно!");
		}
	}
}
