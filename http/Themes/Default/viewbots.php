
		<div class="container">

    </tr>
		<?php

		$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/panel 2/_conf/inc/connection.class.php";

		@include $path;

		$functions->viewBots();
		$functions->notLoggedIn();
?>
</div>
</table>