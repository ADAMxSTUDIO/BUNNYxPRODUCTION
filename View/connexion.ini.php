<?php
// ################ CONNEXION TO PhpMyAdmin ################
define("host","localhost");
define("user", "root");
define("password","");
define("database","bunnyxproduction");

$db = mysqli_connect(host,user,password,database)
or die("Erreur, Re-essayer a entrer vos donnees correctement !");
$reqHeadphones = mysqli_query($db,"SELECT * FROM headphones");
$reqChairs = mysqli_query($db,"SELECT * FROM chairs");
$reqUser = mysqli_query($db, "SELECT * FROM users");

function CloseDB($db){
    mysqli_close($db);
}

// ini_set("session.gc_maxlifetime",5);
// ini_set("session.cookie_lifetime",5);

session_start();
ob_start();