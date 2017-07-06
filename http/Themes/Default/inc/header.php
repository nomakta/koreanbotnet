

		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Linkcabin">
	<link href="<?php echo PanelPATH ?>/dist/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo PanelPATH ?>/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo PanelPATH ?>/dist/css/bootstrap-glyphicons.css" rel="stylesheet">
	<script src="<?php echo PanelPATH ?>/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo PanelPATH ?>/assets/js/jquery.js"></script>
	<script src="<?php echo PanelPATH ?>/js/dropdown.js"></script>
</head>

<body>



<?php
if  (isset($_SESSION['user_session']))
{
?>

<nav class="navbar navbar-static-top" role="navigation">
	<div class="container">
	<div class="navbar-header">
	<a href="" class="navbar-brand"><?php echo PanelName; ?></a>
	</div>

	 <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li><a href="dashboard">Home</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Functions <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="viewreport.php?status=0">View Reports</a></li>
		  <li><a href="tasks.php?status=1&uide=">Create Task</a></li>
		  <li><a href="tasks.php?status=0">View Tasks</a></li>
        </ul>
      </li>
      <li><a href="logout">Logout</a></li>
	  </ul>
	  <p class="navbar-text pull-right">Logged in as <b><?php echo $_SESSION['user_session']; ?></b></p>
	  </div>
</nav>
<?php }else{	?>
	

</nav>
<!-- End of Nav -->

<nav class="navbar navbar-static-top" role="navigation">
	<div class="container">
	<div class="navbar-header">
	<a href="" class="navbar-brand"><?php echo PanelName; ?></a>
	</div>
	

</nav>
<?php } ?>