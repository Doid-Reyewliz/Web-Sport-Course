<?php
session_start();
require_once("db.php");
$db = new Dbase();

$u_email = $_SESSION['mail'];
$c_code = $_POST['name'];

$sql = $db->sql("INSERT INTO `user_course`(`id`, `user_mail`, `course_code`) VALUES ('', '$u_email', '$c_code')");
$del = $db->sql("DELETE FROM `basket` WHERE `user_mail`='$u_email'");
?>