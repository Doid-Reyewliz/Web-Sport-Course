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
?>
<!DOCTYPE html>
<html lang="en">

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
            <?php if ($_SESSION['role'] == 'admin') { ?>
                <li><a href="Admin.php"><?php echo $lang[$_SESSION['lang']]['admin'];?></a></li>
                <li><a href="Users.php"><?php echo $lang[$_SESSION['lang']]['users'];?></a></li>
            <?php } elseif ($_SESSION['role'] == 'moderator') { ?>
                <li><a href="Mod.php">Manage Courses</a></li>
            <?php } else { ?>
                <li><a href="MyC.php"><?php echo $lang[$_SESSION['lang']]['my_c'];?></a></li>
                <li><a href="Courses.php"><?php echo $lang[$_SESSION['lang']]['course'];?></a></li>
            <?php } ?>
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
            <li><a href="#" class="active"><img src="https://img.icons8.com/metro/26/ffffff/shopping-cart.png"/></a></li>
            <li><a href="index.php"><img src="https://img.icons8.com/metro/26/ffffff/exit.png"/></a></li>
        </ul>
    </nav>
</header>

<body>
    <h1 class="title"><?php echo $lang[$_SESSION['lang']]['basket'];?></h1>
    <section class="order">
        <div class="b_products">
        <?php
        require_once "../back/db.php";
        $db = new Dbase();

        $mail = $_SESSION['mail'];
        $count = 0;
        $price = 0;

        $select = $db->sql("SELECT * FROM basket WHERE user_mail = '$mail'");

        if(mysqli_num_rows($select) > 0){

            $sql = $db->query("SELECT basket.product_code, courses.month, courses.name, courses.price FROM basket INNER JOIN courses ON basket.product_code = courses.code WHERE basket.user_mail = '$mail'");

            foreach($sql as $row){
                $price = $row['price'];
                echo    "<div class=\"product\">
                            <h2>{$row['name']}</h2>
                            <h4>Period: <span> {$row['month']} month</span></h4>
                            <h4>Price: <span>$ {$row['price']}</span></h4>
                            <button class='return' type='submit'></button>
                        </div>";
                    $count+=$price;
            }
        }
        else{
            echo "<h1 class=\"empty\">Your Bag is Empty</h1>";
        }
        ?>
        </div>
        <p id="count" hidden><?php echo $count; ?></p>
        <div class="total">
            <p><?php echo $lang[$_SESSION['lang']]['total'];?>: <span id="total">$<?php echo $count; ?></span></p>
            <button id='sub' type="submit"><?php echo $lang[$_SESSION['lang']]['buy'];?></button>
        </div>
    </section>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#sub').click(function(){
            var name;
            var period;
            $('h2').each(function(){
                name = $(this).text();

                $.ajax({
                    url : "../back/sub.php",
                    type: "POST",
                    chache: false,
                    data:{name:name},
                    success:function(response){
                        $('.product').remove();
                        $('.b_products').html("<h1 class=\"empty\"><?php echo $lang[$_SESSION['lang']]['basket_e'];?></h1>");
                        $('#total').text("$0")
                    }
                });
            });

            alert("<?php echo $lang[$_SESSION['lang']]['basket_p'];?>");
        });
    });
</script>

</html>