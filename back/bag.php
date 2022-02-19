<?php
if((isset($_POST['code']) and isset($_POST['mail']))){
    require_once("db.php");
    $db = new Dbase();

    $u_email = $_POST['mail'];
    $c_code = $_POST['code'];
    $price = $_POST['price'];

    $select = $db->sql("SELECT * FROM basket WHERE user_mail = '$u_email' AND product_code = '$c_code'");

    if(mysqli_num_rows($select) == 0){
        $sql = $db->sql("INSERT INTO `basket`(`id`, `user_mail`, `product_code`, `price`) VALUES ('', '$u_email', '$c_code', '$price')");
        header("Location: ../front/Courses.php");
    }
    else{
        header("Location: ../front/Courses.php?error=This course already in your bag!!!");
    }
}

?>