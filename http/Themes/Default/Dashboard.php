<?php 

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/panel 2/_conf/inc/connection.class.php";

@require $path;

$stmt = $dbh->prepare("SELECT * FROM reports");
$stmt->execute();
$count = $stmt->rowCount();

if(!$user->is_loggedin())
{
 $user->redirect('login');
}
?>

<div class="container">
<h2>Useful information</h2>
		<ul>
		<li><b>Amount Of bots:</b> <?php echo $count; ?>
		<li><b>Amount Of Danger Users:</b> ?</li>
		<li><b>Average CPU Temp:</b> ?</li>
		
</div>