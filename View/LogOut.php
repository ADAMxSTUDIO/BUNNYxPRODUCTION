<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUNNYxPRODUCTION | LOGOUT</title>
</head>
<body>
    <?php
    require_once("connexion.ini.php");
    
    session_destroy();
    setcookie("email",$email,time()+24*3600);
    setcookie("username",$username,time());
    setcookie("password",$password,time());
    header("location:index.php");
    ?>
</body>
</html>