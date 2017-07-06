<?php 

   include('../conf.inc.php');
   $host = DBhost;
   $Database = DBname;
    try {
    $dbh = new PDO('mysql:host=$host;dbname=$Database' DBuser, DBPass);
        }catch (PDOException $e) {
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
        }

      
      include_once 'user.class.php';
      $user = new USER($dbh);

?>
