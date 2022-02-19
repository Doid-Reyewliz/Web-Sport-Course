<?php
session_start();
require_once "../back/lang.php";
$language= $_SESSION['lang'];
if (isset($_SESSION['id'])) {

    require_once "../back/db.php";
    $db = new Dbase();

    $id = $_SESSION['id'];
    $sql = $db->query("SELECT * FROM `users` WHERE id = $id");

    foreach($sql as $key => $value) {
        $name = $sql[$key]['name'];
        $surname = $sql[$key]['surname'];
        $login = $sql[$key]['login'];
        $pass = $sql[$key]['password'];
        $gen = $sql[$key]['gender'];
        $bday = $sql[$key]['birthday'];
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit</title>
    <link rel="stylesheet" type="text/css" href="../css/form.css">
</head>

<body>
    <section class="block">
        <div class="meteor">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        <form class="reg" action="../back/e.php" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['reg'])) { ?>
				<p class="rege"><?php echo $_GET['reg']; ?></p>
			<?php } ?>
            
            <h2><?php echo $lang[$_SESSION['lang']]['e_p'];?></h2>
            <input name="name" id="name" type="text" placeholder="Name" value="<?php echo $name; ?>" required>
            <input name="surname" id="surname" type="text" placeholder="Surname" value="<?php echo $surname; ?>" required>
            <input name="log" id="log" type="text" placeholder="Email" value="<?php echo $login; ?>" required>
            <input name="pass" id="pass" type="password" placeholder="Password" value="<?php echo $pass; ?>" required>
            <div>
                <input name="gen" type="radio" id="gen" value="male" <?php if ($gen == "male") { echo "checked";}?>>
                <label for="male">Male</label>
                <input name="gen" type="radio" id="gen" value="female" <?php if ($gen == "female") { echo "checked";}?>>
                <label for="female">Female</label>
            </div>
            <input type="date" name="bday" id="bday" value="<?php echo $bday; ?>" required>
            <button id="submit" type="submit"><?php echo $lang[$_SESSION['lang']]['edit'];?></button>
            <a href="Home.php"><?php echo $lang[$_SESSION['lang']]['back'];?></a>
        </form>
    </section>
</body>

</html>
<?php
}
?>