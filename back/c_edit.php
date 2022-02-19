<?php
    require_once "db.php";
    $db = new Dbase();

    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $month = $_POST['month'];
    $code = $_POST['code'];

    $sql = $db->sql("UPDATE `courses` SET `name`='$name',`price`='$price',`month`='$month',`code`='$code' WHERE id = '$id'");

    header("Location:../front/Mod.php");
?>