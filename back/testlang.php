<?php

if(isset($_POST['lang'])){
   setcookie('lang', $_POST['lang'], time() + (3600*24*365));
}
 header("Location:login.php");
?>