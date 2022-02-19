<?php
session_start();
require_once "../back/lang.php";
require_once "db.php";

$language= $_SESSION['lang'];
$db = new Dbase();

$output = "";

//for Admin
if($_SESSION['role'] == 'admin'){
    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $sql = $db->sql("SELECT * FROM courses WHERE name LIKE '%$search%'");
    }
    else $sql = $db->sql("SELECT * FROM courses ORDER BY id ASC");

    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output .= "<div class='course'>
                            <div class='Text'>
                                <h2>{$row['name']}</h2>
                                <h4>{$lang[$_SESSION['lang']]['period']}: <span>{$row['month']}</span> {$lang[$_SESSION['lang']]['month']}</h4>
                                <h4>{$lang[$_SESSION['lang']]['price']}: <span>$ {$row['price']}</span></h4>
                            </div>
                            <form>
                                <button class='rem' data-id='{$row['code']}'></button>
                            </form>
                        </div>";
        }
        echo $output;
    }
    else{
        echo "<h3 class='empty'>{$lang[$_SESSION['lang']]['empty']}</h3>";
    }
}

//for Moderator
elseif($_SESSION['role'] == 'moderator'){
    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $sql = $db->sql("SELECT * FROM courses WHERE name LIKE '%$search%'");
    }
    else $sql = $db->sql("SELECT * FROM courses ORDER BY id ASC");

    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output .= "<div class='course'>
                            <form class='edit' action='../back/c_edit.php' method='POST'>
                                <input id='name' type='text' name='name' value='{$row['name']}'>
                                <input id='price' type='text' name='price' value='{$row['price']}'>
                                <input id='month' type='number' min='1' max='12' name='month' value='{$row['month']}'>
                                <input id='code' type='text' name='code' value='{$row['code']}'>
                                <input id='id' hidden type='text' name='id' value='{$row['id']}'>
                                <button class='b_edit' type='submit'></button>
                            </form>
                        </div>";
        }
        echo $output;
    }
    else{
        echo "<h3 class='empty'>{$lang[$_SESSION['lang']]['empty']}</h3>";
    }
}

//for User
else{
    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $sql = $db->sql("SELECT * FROM courses WHERE name LIKE '%$search%'");
    }
    else $sql = $db->sql("SELECT * FROM courses ORDER BY id ASC");

    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output .=  "<div class='course'>
                            <div class='Text'>
                                <h2>{$row['name']}</h2>
                                <h4>{$lang[$_SESSION['lang']]['period']}: {$row['month']} month</h4>
                                <h4>{$lang[$_SESSION['lang']]['price']}: <span>$ {$row['price']}</span></h4>
                            </div>
                            <form action='../back/bag.php' method='POST'>
                                <input hidden name='price' type='text' value='{$row['price']}'>
                                <input hidden name='code' type='text' value='{$row['code']}'>
                                <input hidden name='mail' type='text' value='{$_SESSION['mail']}'>
                                <button class='sub' type='submit'></button>
                            </form>
                        </div>";
        }
        echo $output;
    }
    else{
        echo "<h2 class='empty'>{$lang[$_SESSION['lang']]['empty']}</h2>";
    }
}

?>

<script>
//Remove For Admin
$(document).ready(function(){
    $('.rem').click(function(){
        var el = this;
        var deleteprod = $(this).data('id');
        var confirmalert = confirm("<?php echo $lang[$_SESSION['lang']]['sure']; ?>");

        if (confirmalert == true) {
            $.ajax({
                url: '../back/del.php',
                type: 'POST',
                data: { code:deleteprod },
                success: function(response){
                    $(el).closest('.course').fadeOut(800,function(){
                    $(this).remove();
                    });
                }
            });
        }
    });
});

//Edit For Moderator
$(document).ready(function(){
    $('.b_edit').click(function(){
        alert("<?php echo $lang[$_SESSION['lang']]['edited']; ?>");
    });
});
</script>