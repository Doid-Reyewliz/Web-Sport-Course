<?php
session_start();

require_once "db.php";;
$db = new Dbase();

if(isset($_POST['log'], $_POST['pass'], $_POST['name'], $_POST['gen'], $_POST['bday'])){
	$id = $_SESSION['id'];
	$name = $_POST['name'];
    $surname = $_POST['surname'];
	$log = $_POST['log'];
	$pass = $_POST['pass'];
	$gen = $_POST['gen'];
	$bday = $_POST['bday'];

	$sql = $db->sql("UPDATE `users` SET `name`='$name',`surname`='$surname',`login`='$log',`password`='$pass',`birthday`='$bday',`gender`='$gen' WHERE id = $id");
	header("Location:../front/Profile.php?reg=Profile information edited");
}

