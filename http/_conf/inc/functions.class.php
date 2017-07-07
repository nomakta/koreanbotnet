<?php 
Class functions
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }

    function GetInformation()
    {
    
    // Give the amount of bots connected
    $bots1 = $this->db->prepare("SELECT * FROM reports");
    $bots1->execute();
    $botscount = $bots1->rowCount();
    
    
    // Give the amount of tasks
    $tasks1 =  $this->db->prepare("SELECT * FROM tasks");
    $tasks1->execute();
    $taskcount = $tasks1->rowCount();
    
    $message = "<li><b>Amount of bots: </b" . $botscount "</li> <li><b>Amount of tasks: </li></b>" . $taskcount;
   
   
    return $message;
    }


}

?>
