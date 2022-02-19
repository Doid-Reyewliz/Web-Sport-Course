<?php session_start();
require_once "../back/lang.php";
if($_SESSION['lang'] == ''){
	$_SESSION['lang'] = 'en';
}
else{
	$language= $_SESSION['lang'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/form.css">
    <title>Sign In</title>
</head>
<body>
    <section class="block">
		<div class="meteor">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
		</div>

		<form action="../back/lg.php" method="POST">
			<?php if (isset($_GET['error'])) { ?>
				<p class="error"><?php echo $_GET['error']; ?></p>
			<?php } ?>
            <?php if (isset($_GET['reg'])) { ?>
				<p class="rege"><?php echo $_GET['reg']; ?></p>
			<?php } ?>

			<h2><?php echo $lang[$_SESSION['lang']]['in'];?></h2>
			<input type="mail" name="log" placeholder="<?php echo $lang[$_SESSION['lang']]['mail'];?>"><br>
			<input type="password" name="pass" placeholder="<?php echo $lang[$_SESSION['lang']]['pass'];?>"><br>
			<button type="submit" style='text-transform: uppercase;'><?php echo $lang[$_SESSION['lang']]['in'];?></button>

			<a href="Register.php"><?php echo $lang[$_SESSION['lang']]['create'];?></a>
		</form>
	</section>
</body>
</html>