<?php
require 'conf/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Computerized Adaptive Testing (CAT)</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/style.css" rel="stylesheet" media="screen">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="../../assets/js/html5shiv.js"></script>
	<script src="../../assets/js/respond.min.js"></script>
	<![endif]-->
	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
      <ul class="nav navbar-nav">
      	<li><h1>Computerized Adaptive Testing (CAT)<small>by Sambhav Sharma</small></h1></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">

      	<?php
      		if(isset($_SESSION['username'])){
      			echo '
      				<li class="dropdown">
          				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          				' . $_SESSION["username"] . '
      						<span class="caret"></span>
          				</a>
          			    <ul class="dropdown-menu">
            				<li><a href="sign-out.php">Sign out</a></li>
            			</ul>
        			</li>
      			';
      		}
        ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>