<?php 

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/panel 2/_conf/inc/connection.class.php";

@require $path;

if(!$user->is_loggedin())
{
 $user->redirect('login');
}

?>

<div class="container">
<h2>Useful information</h2>
		<ul>
		<?php echo $functions->getinfo(); ?>
	
		
</div>