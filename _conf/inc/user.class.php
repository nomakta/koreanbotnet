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
          $stmt = $this->db->prepare("SELECT * FROM users WHERE username=:username LIMIT 1");
          $stmt->execute(array(':username'=>$username'));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($password, $userRow['password']))
             {
                $_SESSION['user_session'] = $userRow['user_id'];
                return true;
             }
             else
             {
                return false;
             }
   }
   
  
}
?>
