<?php 
session_start();
require_once "../back/db.php";
$db = new DBase();
$mail = $_SESSION['mail'];

if ($_SESSION['role'] == 'admin') {
    if(isset($_POST['admin'])){
        $_SESSION['role'] = 'admin';
        header("Location: Admin.php");
    }
    if(isset($_POST['moder'])){
        $_SESSION['role'] = 'moderator';
        header("Location: Mod.php");
    }
    if(isset($_POST['user'])){
        $_SESSION['role'] = 'user';
        header("Location: Home.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/form.css">
    <title>Choose</title>
</head>
<body>
<section class="block">
		<div class="meteor">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
		</div>

		<form action="" method="POST">
            <h2>Enter as</h2>
			<button type="submit" name='admin'>Admin</button>
            <button type="submit" name='moder'>Moderator</button>
            <button type="submit" name='user'>User</button>
		</form>
	</section>
</body>
</html>
<?php }
else {
    echo "
    <body style='background: #312747; display:flex; flex-direction:column; padding: 30% 30%; padding-top:15%; overflow-y: hidden;'>
    <h1 style='text-align:center; color:#fff; font-family: 'Poppins', sans-serif;'>No Access</h1>
    <button style='width: 40%;
    border-radius: 20px;
    font-size: 17px;
    border: none;
    background-color: #ff0083;
    color: #fff;
    padding: 2% 2%;
    transition: .5s;
    cursor: pointer;
    font-weight: bold;
    letter-spacing: 1px;
    text-decoration: none;
    align-self:center;'>
    <a style='text-decoration:none; color:#fff' href='Home.php'>Back to Home page </a>
    </button>
    </body>";
}?>