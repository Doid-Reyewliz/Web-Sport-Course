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
    <link rel="shortcut icon" href="https://img.icons8.com/metro/26/ff0083/market-square.png"/>
    <link rel="stylesheet" href="../css/page.css">
    <title>Courses</title>
</head>

<header>
    <nav>
        <ul class="nav">
            <li><a href="Home.php"><?php echo $lang[$_SESSION['lang']]['home'];?></a></li>
            <li><a href="MyC.php"><?php echo $lang[$_SESSION['lang']]['my_c'];?></a></li>
            <li><a href="#" class="active"><?php echo $lang[$_SESSION['lang']]['course'];?></a></li>
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
    <section class="content">
        <h1 class="title"><?php echo $lang[$_SESSION['lang']]['course'];?></h1>

        <div id="search">
            <input name="search" class="search" type="text" placeholder=" <?php echo $lang[$_SESSION['lang']]['search'];?>">
        </div>

        <div class="courses"></div>
    </section>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
//search
$(document).ready(function(){
    loadData();
    function loadData(query){
        $.ajax({
            url : "../back/search.php",
            type: "POST",
            chache: false,
            data:{query:query},
            success:function(response){
                $(".courses").html(response);
            }
        });
    }

    $(".search").keyup(function(){
        var search = $(this).val();
        if (search !="") {
            loadData(search);
        }else{
            loadData();
        }
    });
});
</script>
</html>