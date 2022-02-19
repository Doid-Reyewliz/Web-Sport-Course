<?php session_start();
require_once "../back/lang.php";
$language= $_SESSION['lang'];?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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

        <form class="reg" action="../back/rg.php" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            
            <h2><?php echo $lang[$_SESSION['lang']]['reg'];?></h2>
            <input name="name" id="name" type="text" placeholder="<?php echo $lang[$_SESSION['lang']]['name'];?>" required>
            <input name="surname" id="surname" type="text" placeholder="<?php echo $lang[$_SESSION['lang']]['surn'];?>" required>
            <input name="log" id="log" type="text" placeholder="<?php echo $lang[$_SESSION['lang']]['mail'];?>" required>
            <input name="pass" id="pass" type="password" placeholder="<?php echo $lang[$_SESSION['lang']]['pass'];?>" required>
            <div>
                <input name="gen" type="radio" id="gen" value="male">
                <label for="male">Male</label>
                <input name="gen" type="radio" id="gen" value="female">
                <label for="female">Female</label>
            </div>
            <input type="date" name="bday" id="bday" required>
            <button id="submit" type="submit"><?php echo $lang[$_SESSION['lang']]['reg'];?></button>

            <p><?php echo $lang[$_SESSION['lang']]['have'];?> <a href="index.php"><?php echo $lang[$_SESSION['lang']]['in'];?></a></p>
        </form>
    </section>
</body>

</html>