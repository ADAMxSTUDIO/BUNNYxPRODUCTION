<!DOCTYPE html>
<?php
require_once("connexion.ini.php");

if(isset($_REQUEST["submit"])){
    if(isset($_REQUEST["email"])&isset($_REQUEST["password"])){
    
        // ############ CHECKING THE VALIDITY OF INFOS ############
        if(!preg_match("/^([A-z]|[0-9]){4,15}@[a-z]{3,5}\.[a-z]{2,3}$/",$_REQUEST["email"])&!preg_match("/^.{0,15}$/i",$_REQUEST["password"])){
            echo '<script>
                alert("Adress or password invalid !");
            </script>';
        }
        else{  
            extract($_REQUEST);
            // ############ MY METHOD TO CHECK THE IDENTITY ############
            // while($user=mysqli_fetch_array($reqUser)){
            //     if($_REQUEST["email"]==$user["email"]&&
            //         $_REQUEST["password"]==$user["password"]){
            //             $_SESSION["email"]=$user["email"];
            //             $_SESSION["password"]=$user["password"];
            //     }
            //     else
            //     echo '<script>
            //     alert("Adress or password incorrect !");;
            //     </script>';
            // }

            // The verification doesn't work, because the password is encrypted
            
            // ############ EXELIB METHOD TO CHECK THE IDENTITY ############
            $verification = "SELECT * FROM users WHERE email = '$email' and password = '".sha1($password)."'";
            $reqVerify = mysqli_query($db, $verification);
            $result = mysqli_num_rows($reqVerify);
            if($result == 1){
                $_SESSION["email"]=$email;
                $_SESSION["password"]=sha1($password);
                $_SESSION["username"]=mysqli_fetch_array($reqVerify)["username"];
                $keys=["email","password","username"];
                foreach($keys as $i){
                    setcookie($i,$_SESSION[$i],time()+24*3600);
                }
            }
            else{
                echo '<script>
                alert("Adress or password incorrect !");;
                </script>';
            }
        }
    }
    
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUNNYxPRODUCTION</title>
    <link rel="stylesheet" href="../Style/Home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- The fixed header of the home page -->
    <header>
        <div class="logo">
            <a href="index.php">BUNNY<span>x</span>PRODUCTION</a>
        </div>
        <nav>
            <a href="#Headphones">Headphones</a>
            <a href="#Chairs">Chairs</a>
            <a href="#SetUp">Set Up</a>
        </nav>
    </header>
    <!-- The main section right after the header  -->
    <section class="main">
        <div class="main-text">
            <h1>Hello, I'm ADAM </h1><br>
            <p>SETUP DECORTOR<span><br>
            We make the best looking anime setup</span></p><br><br>
        </div>
        <div class="main-btn">
            <a href="#SetUp">View our SetUp</a>
        </div><br><br>
        <div class="main-links">
            <a href="https://www.youtube.com/c/%D8%AA%D8%B4%D9%8A%D8%B2%D9%88%D9%85%D9%8A"><i class="fa-brands fa-youtube"></i></a>
                <a href="https://www.instagram.com/cheezomi/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.tiktok.com/@cheezomi?_d=secCgYIASAHKAESMgow6jrBkgMHWIeNy546WzvFcRK7tHU1iOX%2BZDdDW1uPjf3ZPBvwJ6SagqpRwrogs1VtGgA%3D&language=en&sec_uid=MS4wLjABAAAA0s33C98UUrFlUWpHJknB70kg7mOUPkweb4Oxcxdp7Tg4BL7wxFzsmDa-qKsjNtGk&sec_user_id=MS4wLjABAAAA0s33C98UUrFlUWpHJknB70kg7mOUPkweb4Oxcxdp7Tg4BL7wxFzsmDa-qKsjNtGk&share_app_name=musically&share_author_id=6898708004897997830&share_link_id=ae4d31bc-b6f3-4356-b558-e02be16cd9db&timestamp=1610987985&u_code=dfi8ijaim143g3&user_id=6898708004897997830&utm_campaign=client_share&utm_medium=android&utm_source=more&source=h5_m&_r=1"><i class="fa-brands fa-tiktok"></i></a>
                <a href="https://www.twitch.tv/cheezomi/"><i class="fa-brands fa-twitch"></i></a>
        </div><br><br>
        <div class="animated-stuff">
            <div class="animated-box"></div>
            <div class="animated-circle"></div>
        </div>
    </section>
    <!-- The Founders section -->
    <section class="Founders">
        <h1 class="section-title">Founders</h1>
        <div class="Founders-cards">
            <?php 
            $reqFd = mysqli_query($db, "SELECT * FROM founders");
            while($founder = mysqli_fetch_array($reqFd)){
            ?>
            <div class="Founders-card" style="background-image: url(<?=@$founder["pic"];  ?>)">
                <div class="Founders-cards-label">
                    <p><?=@$founder["name"];  ?></p>
                </div>
                <div class="Founders-cards-description">
                    <p><?=@$founder["about"];  ?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
    <!-- The Headphones section -->
    <section class="Headphones" id="Headphones">
        <h1 class="section-title">Headphones</h1>
        <div class="Headphones-cards">
            <?php
            while($headphones=mysqli_fetch_array($reqHeadphones)){?>
            <div class="headphones-card" style="margin: 2em 0;">
                <div class="headphones-card-discount">
                    <p><?php if(isset($headphones["discount"]))echo @$headphones["discount"]; else echo 0;?>%OFF</p>
                </div>
                <div class="headphones-card-image">
                    <img src="<?php echo @$headphones["img"];?>" alt="Headphone.jpg" title="Headphone.jpg">
                </div>
                <div class="headphones-card-description">
                    <h3><?php echo substr(@$headphones["label"],0,20);?></h3>
                    <p max_lines="30"><?php echo substr(@$headphones["description"],0,39);?></p>
                    <p class="price">MAD <span><?php echo @$headphones["price"];?></span></p>
                </div>
            </div>
            <?php }?>
        </div>
    </section>
    <!-- The Chairs section -->
    <section class="Chairs" id="Chairs">
        <h1 class="section-title">Chairs</h1>
        <div class="Chairs-cards">
            <?php
            while($Chairs=mysqli_fetch_array($reqChairs)){?>
            <div class="Chairs-card" style="margin: 2em 0;">
                <div class="Chairs-card-discount">
                    <p><?php if(isset($Chairs["discount"]))echo @$Chairs["discount"]; else echo 0;?>%OFF</p>
                </div>
                <div class="Chairs-card-image">
                    <img src="<?php echo @$Chairs["img"];?>" alt="Chair.jpg" title="Chair.jpg">
                </div>
                <div class="Chairs-card-description">
                    <h3><?php echo substr(@$Chairs["label"],0,20);?></h3>
                    <p max_lines="30"><?php echo substr(@$Chairs["description"],0,39);?></p>
                    <p class="price">MAD <span><?php echo @$Chairs["price"];?></span></p>
                </div>
            </div>
            <?php }?>
        </div>
    </section>
    <!-- The bottom sticky connexion bar -->
    <section class="connexion">
        <?php
        function LogedIn($method,$db){
        // ############ DELETE FORM VIA JAVASCRIPT ############
            echo '<script>
                    var form = document.getElementsByTagName("form");
                    from.style = "display:none;";
                    var connexion = document.getElementsByClassName("connexion");
                    // var paragraph = document.createElement("p");
                    // paragraph.innerHTML = "Welcome";
                    // connexion.appendChild(paragraph);
                    // paragraph.setAttribute("style","color:black;");
                </script>';
        #####################################################
        // ############ INSERT WELCOME, USERNAME ############
            $password = $method["password"];
            $email = $method["email"];
            $verification = "SELECT * FROM users WHERE email='$email' and password='$password'";
            $reqVerify = mysqli_fetch_array(mysqli_query($db, $verification))["id"];
            echo "<div class=\"LogedIn\">";
            echo "<a href=\"profile.php?id=$reqVerify\">
                <div class=\"LogedIn-content\">
                <div class=\"LogedIn-content-icon\">";
            if($picture=mysqli_fetch_array(mysqli_query($db,$verification))["picture"])
                echo "<img id=\"picture\" src=".mysqli_fetch_array(mysqli_query($db,$verification))["picture"]." alt=\"profile picture\" /></div>";
            else {?>
            <img id="picture" src="../RESSOURCES/AnnonymousIcon.jpg" alt="profile picture" /></div>
            <?php }
            echo "<p>Welcome back, <span>".$method["username"]."</span></p></div></a>";
            echo "<a href=\"LogOut.php\">Log Out</a>";
            echo "</div>";
        #####################################################
        }


        // ######################## FROM ########################
        // ############ USE SESSION & COOKIE ############
        if(isset($_SESSION["email"])&isset($_SESSION["password"])){
            LogedIn($_SESSION,$db);
        }
        elseif(isset($_COOKIE["email"])&isset($_COOKIE["password"])){
            LogedIn($_COOKIE,$db);
        }
        #################################################

        // ############ DISPLAY FORM IF NOT LOGED IN ############
        else{ ?>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Johnny.Sardine@company.com" autofocus required pattern="^([A-z]|[0-9]){4,15}@[a-z]{3,5}.[a-z]{2,3}$">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Y4UV4#D%^W956@#" required>
            <input type="submit" value="Log In" name="submit">
            <a id="form-join" href="SignUp.php">Join now</a>
        </form>
        <?php }
        ##########################################################?>
    </section>


    <footer>
        <h4>PROJECT FINISHED ABOVE 20 H BY 
            <div class="logo">
            <a href="#">ADAM<span>x</span>STUIDIO</a>
        </div></h4>
    </footer>
</body>
</html>