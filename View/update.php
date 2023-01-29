<!DOCTYPE html>
<?php
require_once("connexion.ini.php");

if(!(($_COOKIE["email"]&$_COOKIE["password"])
and(($_SESSION["email"]&$_SESSION["password"]))) )
    header("location:index.php");
extract($_REQUEST);
$value = mysqli_fetch_array(mysqli_query($db, "SELECT * from users where id=".$id))[$focus];


if(isset($_REQUEST["update"])){
    // ############ PASSWORD VERIFICATION ###########
    if(isset($password) & sha1($password) == mysqli_fetch_array(mysqli_query($db, "SELECT password FROM users WHERE id=".$id))["password"]){
    #################################################
    // ############ PASSWORD UPDATE ################# 
        if($focus=="password"){
            $New = sha1($New);
            $update = mysqli_query($db, "UPDATE users SET ".$focus."='".$New."'  WHERE id=".$id);
            header("location:LogOut.php");
        }
    #################################################
    //    ############ PICTURE UPDATE ############
        elseif($focus=="picture"){
                $picture = $_FILES["New"];
                $info = pathinfo($picture["name"]);
                $path = "../RESSOURCES/Picture/".$info["basename"];
                if(!$picture["error"]&$picture["size"]<4000000){
                    $allowesExtensions = ["jpg", "jpeg", "png"];
                    if(in_array(strtolower($info["extension"]),$allowesExtensions)){
                        if(!is_dir("../RESSOURCES/Picture")){
                            mkdir("../RESSOURCES/Picture");
                        }
                        $New = $path;
                        move_uploaded_file($picture["tmp_name"],$path);
                        $update = mysqli_query($db, "UPDATE users SET picture='".$path."'  WHERE id=".$id);
                    }
                    else
                    ?>
                    <script>
                        alert("Picture type is not allowed !");
                    </script>';
                    <?php
                    }
                else
                    ?>
                    <script>
                        alert("Picture size exeeds 4 Mo !");
                    </script>';
        <?php
        }
        ######################################################
        //       ############ OTHER UPDATE ############
        else
        $update = mysqli_query($db, "UPDATE users SET ".$focus."='".$New."'  WHERE id=".$id);
        ######################################################
        
        // ############ SETTING SESSION & COOKIE ############
        $_SESSION[$focus] = $New;
        setcookie($focus,$New,time()+24*3600); 
        #####################################################

        echo '<script>
                alert("'.ucfirst($focus).' updated successfuly !");
                </script>';

        // ############## KEEP LOGIN ##############
        if(isset($_REQUEST["KeepLogin"]))
            header("location:profile.php?id=$id");
        else
            header("location:LogOut.php");
        ###########################################
    }
    else
        echo 
            '<script>
                alert("Password invalid !");
            </script>';

}
if(isset($_REQUEST["delete"])){
    $delete = mysqli_query($db, "DELETE FROM users WHERE id=".$id);
    header("location:LogOut.php");
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUNNYxPRODUCTION | UPDATE INFOS</title>
    <link rel="stylesheet" href="../Style/Connexion.css" />
</head>
<body>
    <div class="blur-area"></div>
    <section>
        <h1 class="form-title">UPDATE</h1>
        <form action="#" method="post" enctype="multipart/form-data">
            <label id="label" for="<?php echo $focus; ?>"><?php echo ucfirst($focus); ?></label>
            <?php
            if($focus=="password"){
            echo '<script>
            var input = document.getElementById("label");
            var label = document.getElementById("password");
            input.style = "display:none;";
            label.style = "display:none;";
            </script>';
            // echo "<input type=\"password\" name=\"".$_GET["focus"]."\" id=\"$focus\" autofocus value=\"$value\">";
            }
            elseif($focus=="email")
            echo "<input type=\"email\" name=\"".$_GET["focus"]."\" id=\"$focus\" autofocus value=\"$value\" pattern=\"^([A-z]|[0-9]){4,15}@[a-z]{3,5}.[a-z]{2,3}$\">";
            else {?>
            <input type="text" name="<?php echo $_GET["focus"]; ?>" id="<?php echo $focus; ?>" autofocus value="<?php echo $value;?>">
            <?php }?>
            <label for="New">New <?php echo ucfirst($focus); ?></label>
            <?php
            if($focus=="picture")
            echo "<input type=\"file\" name=\"New\" id=\"New\" accept=\"image/jpg,image/png,image/jpeg\">";
            else{?>
            <input type="text" name="New" id="New"><?php }?>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required />
            <div class="KeepLogin">
                <input type="checkbox" name="KeepLogin" id="KeepLogin">
                <label for="KeepLogin">Keep me loged in !</label>
            </div>
            <div class="update">
                <input type="submit" value="Update" name="update">
                <input type="submit" value="Delete Account" name="delete">
            </div>
        </form>
        <div class="Redirect">
            <a id="Redirect" href="index.php"><<< Back Home</a>
            <a id="Redirect" href="profile.php?id=<?php echo $_GET["id"];?>"><< View Profile</a>
        </div>
    </section>
</body>
</html>