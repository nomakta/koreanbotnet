
<?php 
Class User
{
  
  private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
  public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {

         return true;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true; 
    }
  
    
  public function CreateUser($username, $password, $permissions)
   {
  
   }
  
  // i finish later bye
  public function Login($username, $password) 
   {  
    try
       {
          	$query = $this->db->prepare("SELECT * FROM users WHERE username = :user AND `password` = :pass");
			      $query->execute(array(':user'=>$username, ':pass'=>$password));
			     $count = $query->rowCount();
	     
          		if($count == 1)
          		{
          		$_SESSION['user_session'] = $username;
					    return true;
               }
        } catch(Exception $e) { return false; }
   }
}

?>