<?php 

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/panel 2/_conf/conf.inc.php";
require $path;




$hostname = DBhost;
$db = DBname;

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$db", DBuser, DBpass);
        }catch (PDOException $e) {
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
        }

  	include_once 'bots.class.php';
	include_once 'user.class.php';
    include_once 'functions.class.php';   
  

    $bots = new Bots($dbh);
    $user = new USER($dbh);
    $functions = new FUNCTIONS($dbh);


?>
