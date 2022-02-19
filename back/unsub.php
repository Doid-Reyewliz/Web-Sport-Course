<?php
session_start();

if(isset($_POST['code'])){
    require_once("db.php");
    $db = new Dbase();

    $u_email = $_SESSION['mail'];
    $c_code = $_POST['code'];
    $sql =  $db->sql("DELETE FROM `user_course` WHERE user_mail = '$u_email' AND course_code = '$c_code'");
}
?>