<!DOCTYPE html>
<?php
require_once("connexion.ini.php");

if(isset($_REQUEST["submit"])){
    // ############ CHECKING THE VALIDITY OF INFOS ############
    if(isset($_REQUEST["email"])&isset($_REQUEST["password"])&isset($_REQUEST["username"])){
        if(!preg_match("/^([A-z]|[0-9]){4,15}@[a-z]{3,5}\.[a-z]{2,3}$/",$_REQUEST["email"])&!preg_match("/^.{0,15}$/i",$_REQUEST["password"])&!preg_match("/^\w{3,10}$/",$_REQUEST["username"])){
            echo '<script>
                    alert("Adress or password invalid !");
                </script>';
        }
        else{
            extract($_REQUEST);
            $Encryptedpassword = sha1($password);
            mysqli_query($db,"INSERT INTO users (username,email,password,c_date) VALUES('$username','$email','$Encryptedpassword','".date("Y-m-d H:i:s")."')");
            CloseDB($db);
            // ############ CREATING SESSION ############
            $_SESSION["username"]=$username;
            $_SESSION["email"]=$email;
            $_SESSION["password"]=$Encryptedpassword;
            // ############ CREATING COOKIE ############
            setcookie("email",$email,time()+24*3600);
            setcookie("username",$username,time()+24*3600);
            setcookie("password",$Encryptedpassword,time()+24*3600);
            echo '<script>
                    alert("You are now a member !");
                </script>';
            if(isset($_REQUEST["KeepLogin"]))
                header("location:index.php");
            else{
                header("location:LogOut.php");
            }
        }
    }
}
// isset($_REQUEST["KeepLogin"]
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUNNYxPRODUCTION | SIGNUP</title>
    <link rel="stylesheet" href="../Style/Connexion.css" />
</head>
<body>
<header>
    <div class="blur-area"></div>
    <section>
        <h1 class="form-title">SIGN UP</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="JohnnySardine" autofocus required pattern="^\w{3,10}$">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Johnny.Sardine@company.com" required pattern="^([A-z]|[0-9]){4,15}@[a-z]{3,5}\.[a-z]{2,3}$">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Y4UV4#D%^W956@#" required>
            <input type="submit" value="Sign Up" name="submit">
            <div class="KeepLogin">
                <input type="checkbox" name="KeepLogin" id="KeepLogin">
                <label for="KeepLogin">Keep me loged in !</label>
            </div>
        </form>
        <div class="Redirect">
            <a id="Redirect-SignUp" href="index.php"><<< Back Home</a>
        </div>  
    </section>
</body>
</html>