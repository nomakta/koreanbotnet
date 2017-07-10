<?php 
<<<<<<< HEAD
Class Functions
=======
Class functions
>>>>>>> origin/master
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
<<<<<<< HEAD
    
   public function getinfo($type)
   { 
=======

    function GetInformation()
    {
>>>>>>> origin/master
    
    // Give the amount of bots connected
    $bots1 = $this->db->prepare("SELECT * FROM reports");
    $bots1->execute();
    $botscount = $bots1->rowCount();
    
    
    // Give the amount of tasks
    $tasks1 =  $this->db->prepare("SELECT * FROM tasks");
    $tasks1->execute();
    $taskcount = $tasks1->rowCount();
    
<<<<<<< HEAD
    $message = $botscount;
   
   echo $message;
    }

}


?>
=======
    $message = "<li><b>Amount of bots: </b" . $botscount "</li> <li><b>Amount of tasks: </li></b>" . $taskcount;
   
   
    return $message;
    }


}

?>
>>>>>>> origin/master
