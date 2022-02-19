<?php
session_start();
require_once "../back/lang.php";
    if (isset($_POST["lang"])) {
        setcookie('lang',$_POST["lang"], time()+60);
        $language= $_POST["lang"];
        $_SESSION['lang'] = $language;
    }
    else{
        $language= "en";
        $_SESSION['lang'] = $language;
    }

if ($_SESSION['role'] == 'admin') {
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://img.icons8.com/metro/26/ff0083/home.png"/>
    <link rel="stylesheet" href="../css/page.css">
    <title>Home</title>
</head>

<header>
    <nav>
        <ul class="nav">
            <li><a href="Home.php"><?php echo $lang[$_SESSION['lang']]['home'];?></a></li>
            <li><a href="Admin.php"><?php echo $lang[$_SESSION['lang']]['admin'];?></a></li>
            <li><a href="#" class="active"><?php echo $lang[$_SESSION['lang']]['users'];?></a></li>
        </ul>

        <ul>
            <form action='' method='POST'>
                <select name="lang">
                    <option value="" disabled selected></option>
                    <option value="en"<?php if($_SESSION['lang'] == "en" ) { echo "selected"; } ?>>En</option>
                    <option value="ru"<?php if($_SESSION['lang'] == "ru" ) { echo "selected"; } ?>>Ru</option>
                </select>
                <input type="submit" id="btn" value="Enter">
            </form>
            <li class="profile"><a href="Profile.php"><img src="https://img.icons8.com/metro/26/ffffff/name.png"/><?php echo "<p>" . $_SESSION['name'] . "</p>" ?></a></li>
            <li><a href="Basket.php"><img src="https://img.icons8.com/metro/26/ffffff/shopping-bag.png"/></a></li>
            <li><a href="index.php"><img src="https://img.icons8.com/metro/26/ffffff/exit.png"/></a></li>
        </ul>
    </nav>
</header>

<body>
    <h1 class="title"><?php echo $lang[$_SESSION['lang']]['all_u'];?></h1>
    <div class="table">
        <div class="t">
            <?php
            require_once "../back/db.php";;
            $db = new Dbase();
            $q = $db->query("SELECT * FROM users");

            echo "<table><tr><th>#</th><th>{$lang[$_SESSION['lang']]['name']}</th><th>{$lang[$_SESSION['lang']]['surn']}</th><th>{$lang[$_SESSION['lang']]['mail']}</th><th>{$lang[$_SESSION['lang']]['pass']}</th><th>{$lang[$_SESSION['lang']]['bday']}</th><th>{$lang[$_SESSION['lang']]['gen']}</th><th></th></tr>";
            if (!empty($q)) {
                foreach ($q as $row) {
                    if ($row['id'] < 0) {
                        continue;
                    } else {
                        echo "<tr><td>" . $row["id"] .
                            "</td><td>" . $row["name"] .
                            "</td><td>" . $row["surname"] .
                            "</td><td>" . $row["login"] .
                            "</td><td>" . $row["password"] .
                            "</td><td>" . $row["birthday"] .
                            "</td><td>" . $row["gender"] .
                            "</td><td>" . "<button class='trash'; type='submit' data-id='$row[id]'></button>" .
                            "</td></tr>";
                    }
                }
                echo "</table>";
            }
            ?>
        </div>
    </div>
<?php
} else {
    echo "<body style= 'background-image: linear-gradient(to bottom left, #ffa249, #9e00f6);'><h1 style='
    color: #fff;
    margin-top: 15%;
    margin-left: 23%;
    width: 50%;
    padding: 2%;
    text-align: center;
    background: #9e00f6;
    backdrop-filter: blur(5px);
    border-radius: 20px;
    background: rgba(255, 255, 255, .1);
    box-shadow: 0 25px 45px rgba(0, 0, 0, .1);
    border: 3px solid rgba(255, 255, 255, .5);
    border-right: 3px solid rgba(255, 255, 255, .2);
    border-bottom: 3px solid rgba(255, 255, 255, .2);

    '>How did you end up here? <br>Anyway, you don't have an <b>access</b> to this page !<h1>
    <a style='
    margin-left: 41%;
    color: #fff;
    padding: .6%;
    margin-top: 1%;
    text-decoration:none; background: #9e00f6;
    backdrop-filter: blur(5px);
    border-radius: 10px;
    background: rgba(255, 255, 255, .1);
    box-shadow: 0 25px 45px rgba(0, 0, 0, .1);
    border: 3px solid rgba(255, 255, 255, .5);
    border-right: 3px solid rgba(255, 255, 255, .2);
    border-bottom: 3px solid rgba(255, 255, 255, .2);' href='Home.php'>Go to Home page </a>
    
    </body>";
}
?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('.trash').click(function(){
        var el = this;
        var deleteid = $(this).data('id');
        var confirmalert = confirm("<?php echo $lang[$_SESSION['lang']]['sure'];?>");

        if (confirmalert == true) {
        $.ajax({
            url: '../back/del.php',
            type: 'POST',
            data: { id:deleteid },
            success: function(response){
                $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
                });
            }
            });
        }
    });
});
</script>

</html>