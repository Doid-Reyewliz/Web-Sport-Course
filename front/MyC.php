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
    <link rel="stylesheet" href="../css/page.css">
    <title>My Courses</title>
</head>

<header>
    <nav>
        <ul class="nav">
            <li><a href="Home.php"><?php echo $lang[$_SESSION['lang']]['home'];?></a></li>
            <li><a href="#" class="active"><?php echo $lang[$_SESSION['lang']]['my_c'];?></a></li>
            <li><a href="Courses.php"><?php echo $lang[$_SESSION['lang']]['course'];?></a></li>
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
        <h1 class="title"><?php echo $lang[$_SESSION['lang']]['my_c'];?></h1>
        <div class="my_courses">
            <?php
            require_once("../back/db.php");
            $db = new Dbase();

            $mail = $_SESSION['mail'];
            $check = $db->sql("SELECT `course_code` FROM `user_course` WHERE `user_mail` = '$mail'");

            $course = $db->query("SELECT * FROM courses");

            if (mysqli_num_rows($check) > 0) {
                $course_array = $db->query("SELECT `course_code` FROM `user_course` WHERE `user_mail` = '$mail'");
                foreach ($course_array as $key => $value) {
                    $arr[] = $course_array[$key]['course_code'];
                    $courses = implode(", ", $arr);
                }

                foreach ($course as $key => $value) {
                    if (stristr($courses, $course[$key]["code"])) {
            ?>
                        <div class="my_course">
                            <div class="text">
                                <h2><?php echo $course[$key]["name"]; ?></h2>
                                <h4><?php echo $lang[$_SESSION['lang']]['period'];?>: <span><?php echo $course[$key]["month"]; ?> <?php echo $lang[$_SESSION['lang']]['month'];?></span></h4>
                            </div>

                            <button data-id='<?php echo $course[$key]['code']; ?>' class="unsub" type="submit"><?php echo $lang[$_SESSION['lang']]['uns'];?></button>
                        </div>
            <?php
                    }
                }
            }
            else{?>
                <h4 class="empty" style="text-align:center;"><?php echo $lang[$_SESSION['lang']]['error'];?></h4>
            <?php }

            ?>
        </div>
    </section>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('.unsub').click(function(){
        var el = this;
        var deleteprod = $(this).data('id');
        var confirmalert = confirm("Unsubscribe from this course?");

        if (confirmalert == true) {
        $.ajax({
            url: '../back/unsub.php',
            type: 'POST',
            data: { code:deleteprod },
            success: function(response){
                $(el).closest('.my_course').fadeOut(800,function(){
                    $(this).remove();
                });
            }
            });
        }
    });
});
</script>
</html>