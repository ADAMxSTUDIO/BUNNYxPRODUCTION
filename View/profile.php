<!DOCTYPE html>
<?php
require_once("connexion.ini.php");

if(!(($_COOKIE["email"]&$_COOKIE["password"])
    and(($_SESSION["email"]&$_SESSION["password"]))) )
    header("location:index.php");
extract($_GET);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUNNYxPRODUCTION | PROFILE</title>
    <link rel="stylesheet" href="../Style/Profile.css" />
</head>
<body>
    <div class="blur-area"></div>
    <section class="profile">
        <div class="profile-picture">
            <label for="picture">Picture</label>
            <?php if($picture=mysqli_fetch_array(mysqli_query($db,"SELECT picture FROM users WHERE id=" . $id ))["picture"]){
                echo "<a href=\"update.php?id=$id&amp;focus=picture\"><img id=\"picture\" src=".mysqli_fetch_array(mysqli_query($db,"SELECT picture FROM users WHERE id=" . $id ))["picture"]." alt=\"profile picture\" /></a>";
                }
                else{?>
            <a href="update.php?id=<?php echo $id;?>&amp;focus=picture"><img id="picture" src="../RESSOURCES/AnnonymousIcon.jpg" alt="profile picture" /></a>
            <?php }?>
        </div>
        <div class="profile-username">
            <label for="username">Username</label>
            <a href="update.php?id=<?php echo $id;?>&amp;focus=username"><h2 id="username" class="profile-username"><?php echo mysqli_fetch_array(mysqli_query($db,"SELECT username FROM users WHERE id=" . $id ))["username"];?></h2></a>
        </div>
        <div class="profile-email">
            <label for="email">Email</label>
            <a href="update.php?id=<?php echo $id;?>&amp;focus=email"><h2 id="email" class="profile-email"><?php echo mysqli_fetch_array(mysqli_query($db,"SELECT email FROM users WHERE id=" . $id))["email"];?></h2></a>
        </div>
        <div class="profile-password">
            <label for="password">Password</label>
            <a href="update.php?id=<?php echo $id;?>&amp;focus=password"><h2 id="password" class="profile-password">
                <?php $encryptedPassword = mysqli_fetch_array(mysqli_query($db,"SELECT password FROM users WHERE id=" . $id))["password"];
                for($i=0;$i<strlen($encryptedPassword);$i++){
                    echo str_replace($encryptedPassword, "*",$encryptedPassword);
                }?></h2></a>
        </div>
        <div class="profile-c_date">
            <label for="c_date">Created At</label>
            <h2 id="c_date" class="profile-c_date"><?php echo mysqli_fetch_array(mysqli_query($db,"SELECT c_date FROM users WHERE id=$id"))["c_date"];?></h2>
        </div>
        <a id="Redirect" href="index.php"><< Back Home</a>
    </section>
</body>
</html>