<?php 

   include($_SERVER['DOCUMENT_ROOT'].'/_conf/config.php')

    try {
    $dbh = new PDO('mysql:host=' + DBhost + ';dbname=' + DBname, DBuser, DBPass);
        }catch (PDOException $e) {
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
        }
?>
