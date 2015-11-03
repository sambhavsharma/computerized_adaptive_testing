<?php
require 'header.php';
?>

	<div class="container">

	<form class="form-signin" method="post" action="start_quiz.php">
		
		<?php
			if(!isset($_SESSION['username'])){
				echo '<h2 class="form-signin-heading"> We need a username! </h2>';
				echo '<label for="username" class="sr-only">Username</label>';
				echo '<input name="username" type="input" id="username" class="form-control" placeholder="Username" required autofocus>';
			}
			else
				echo '<h2 class="form-signin-heading"> Welcome ' . $_SESSION['username'] . '!</h2>';
		?>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Start</button>
	</form>

    </div>

<?php
require 'footer.php';
?>