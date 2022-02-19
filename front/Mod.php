<?php session_start();
require_once "../back/lang.php";
$language= $_SESSION['lang'];
if ($_SESSION['role'] == 'moderator') {
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
    <button onclick="topFunction()" id="top_btn"></button>
    <section class="content">
        <h1 class="title"><?php echo $lang[$_SESSION['lang']]['add'];?></h1>

        <?php if (isset($_GET['edit'])) {echo "<span class='edit'; style='width: 300px; margin-left: 40%; padding-top: 0; font-size: 18px;'>" . $_GET['edit'] . "</span>";}?>
        <br>
        <div class="new">
            <div class="course">
                <div class="add_new">
                    <input class="c_name" name="name" type="text" placeholder="<?php echo $lang[$_SESSION['lang']]['name'];?>" autocomplete="off">
                    <input class="comp" name="comp" type="number" min="1" max="12" placeholder="<?php echo $lang[$_SESSION['lang']]['period'];?> (<?php echo $lang[$_SESSION['lang']]['month'];?>)" autocomplete="off">
                    <input class="dif" name="dif" type="text" placeholder="<?php echo $lang[$_SESSION['lang']]['price'];?>" autocomplete="off">
                    <input class="code" name="code" type="text" placeholder="Code" autocomplete="off">
                    <div>
                        <button id="add" type="submit"></button>
                        <?php if (isset($_GET['error'])) {
                            echo "<span class='error'>" . $_GET['error'] . "</span>";
                        } ?>
                    </div>
                </div>
            </div>
        </div> 
        <h1 class="title"><?php echo $lang[$_SESSION['lang']]['edit'];?></h1>
        <div id="search">
            <input name="search" class="search" type="text" placeholder=" <?php echo $lang[$_SESSION['lang']]['search'];?>">
        </div>
        <div class="courses"></div>
    </section>
<?php
} else {
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
}
?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

//scroll on top
var mybutton = document.getElementById("top_btn");
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.visibility = "visible";
    } else {
        mybutton.style.visibility = "hidden";
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

$(document).ready(function(){
    $('#add').click(function(){
        var name=$('.c_name').val();
        var comp=$('.comp').val();
        var dif=$('.dif').val();
        var code=$('.code').val();

        $.ajax({
            url:'../back/add.php',
            method:'POST',
            cache: false,
            data:{
                name:name,
                comp:comp,
                dif:dif,
                code:code
            },
            success:function(response){
                alert("Successfully Added");
                window.location.reload()
            }
        });
    });
});
</script>
</html>