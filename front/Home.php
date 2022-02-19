<?php session_start(); 

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
            <li><a href="#" class="active"><?php echo $lang[$_SESSION['lang']]['home'];?></a></li>
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
            <li><a href="Basket.php"><img src="https://img.icons8.com/metro/26/ffffff/shopping-bag.png"/></a></li>
            <li><a href="index.php"><img src="https://img.icons8.com/metro/26/ffffff/exit.png"/></a></li>
        </ul>
        
    </nav>
</header>

<body>
    <button onclick="topFunction()" id="top_btn"></button>
    <section class="contentBox">
        <img class="wave" src="../image/curve.png">
        <div class="ad">
            <h2><?php echo $lang[$_SESSION['lang']]['h2'];?></h2>
            <br>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut natus corrupti tempora quos unde dolor officia inventore sit illo! Perspiciatis voluptatem reprehenderit, mollitia odit consequuntur minima maiores nemo! Ipsa, consequuntur!</p>
            <br>
            <button><?php echo $lang[$_SESSION['lang']]['read'];?></button>
        </div>
        <div class="imgBox">
            <img src="../image/s1.png">
        </div>
    </section>

    <section class="info">
        <ul>
            <li>
                <div>
                    <div><img src="https://img.icons8.com/cotton/64/ffffff/laptop--v1.png"/></div>
                    <h4><?php echo $lang[$_SESSION['lang']]['online'];?></h4>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                </div>
            </li>
            <li>
                <div>
                    <div><img src="https://img.icons8.com/cotton/64/000000/read.png"/></div>
                    <h4><?php echo $lang[$_SESSION['lang']]['under'];?></h4>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                </div>
            </li>
            <li>
                <div>
                    <div><img src="https://img.icons8.com/cotton/64/000000/coins.png"/></div>
                    <h4><?php echo $lang[$_SESSION['lang']]['cheap'];?></h4>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
                </div>
            </li>
        </ul>
    </section>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
//scroll on top
var mybutton = document.getElementById("top_btn");
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        mybutton.style.visibility = "visible";
    } else {
        mybutton.style.visibility = "hidden";
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

// $(document).ready(function(){
//     $('#btn').click(function(){

//         var lang = $('.lang').val();
    
//         $.ajax({
//             url: '../back/lag.php',
//             type: 'POST',
//             data: { lang: lang},
//             success: function(response){}
//         });
//     });
// });
</script>
</html>