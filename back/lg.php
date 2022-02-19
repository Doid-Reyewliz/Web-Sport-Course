<?php
session_start();
require_once("db.php");
if (isset($_POST['log']) && isset($_POST['pass'])) {

	$log = $_POST['log'];
	$pass = $_POST['pass'];
	
	if (empty($log)) {
		if($language== 'en'){
			header("Location: ../front/index.php?error=Login is required");
		}
		else{
			header("Location: ../front/index.php?error=Логин пустой");

		}
		exit();
	}
	else if(empty($pass)){
		if($language== 'en'){
			header("Location: ../front/index.php?error=Password is required");
		}
		else{
			header("Location: ../front/index.php?error=Пароль пустой");
		}
		exit();
	}
	else{
		$db = new Dbase();

		$users = $db -> query("SELECT * FROM users WHERE login='$log' AND password='$pass'");

		if (!empty($users)) {

			$role = $db->query("SELECT * FROM user_roles WHERE user_mail='$log'");
			
			foreach($users as $i => $values){
				foreach($role as $j => $values){
					if($role[$j]['role'] == 'user'){
						$_SESSION['id'] = $users[$i]['id'];
						$_SESSION['role'] = $role[$j]['role'];
						$_SESSION['mail'] = $log;
						$_SESSION['name'] = $users[$i]['name'];
						setcookie("log", $log, time() + 20, "/");
						setcookie("pass", $pass, time() + 20, "/");
						header("Location: ../front/Home.php");
					}
					if($role[$j]['role'] == 'admin') {
						$_SESSION['id'] = $users[$i]['id'];
						$_SESSION['role'] = $role[$j]['role'];
						$_SESSION['mail'] = $log;
						$_SESSION['name'] = $users[$i]['name'];
						setcookie("log", $log, time() + 20, "/");
						setcookie("pass", $pass, time() + 20, "/");
						header("Location: ../front/Choose.php");
					}
					if($role[$j]['role'] == 'moderator'){
						$_SESSION['id'] = $users[$i]['id'];
						$_SESSION['role'] = $role[$j]['role'];
						$_SESSION['mail'] = $log;
						$_SESSION['name'] = $users[$i]['name'];
						setcookie("log", $log, time() + 20, "/");
						setcookie("pass", $pass, time() + 20, "/");
						header("Location: ../front/Mod.php");
					}
				}
			}
		}else{
			if($language== 'en'){
				header("Location: ../front/index.php?error=Incorect Login or Password");
			}
			else{
				header("Location: ../front/index.php?error=Неверный логин или пароль!");
			}
			exit();
		}
	}
	
}else{
	header("Location: ../front/index.php");
	exit();
}
