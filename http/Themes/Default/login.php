<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/panel 2/_conf/inc/connection.class.php";

require $path;


if($user->is_loggedin())
{
	echo "Already logged in?";
  $user->redirect($path . 'Dashboard.php');
}

if(isset($_POST['smbt1']))
{

 $usr = $_POST['username'];
 $pass = $_POST['password'];

 $passprot = crypt($pass, '8FLFsie49A9fkpQ3uTTE9843');
 $passprot1 = base64_encode($passprot);
 $passprot2 = md5($passprot1);
 if($user->login($usr,$passprot2))
 {
  echo "Logged in!";

 }
 else
 {
 	// We do nothing
 
 } 
}
?>


<!-- Start of Main -->

<div class="container">

<!-- Nav Text Fix -->

<h2>Login</h2>

<form method="POST" action="" name="frm1" enctype="application/x-www-form-urlencoded">
<div class="input-group">
<input type="text" class="form-control" placeholder="Username" name="username">
<br><br>
<input type="password" class="form-control" placeholder="Password" name="password">
</div>
<br>

<input type="submit" name="smbt1" class="btn btn-success" value="Login">
</form>