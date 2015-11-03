<?php
require 'header.php';
?>

<?php

	$sql = "select count(*) from user_answers where user_id = " . $_SESSION['user_id'] . " AND is_correct = (1)";
	
	$result = mysql_query($sql);

	$num_correct_answers = mysql_result($result,0);

?>

<div class="col-md-3">
</div>

<div class="col-md-6">
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title question">Result</h3>
	  </div>
	  <div class="panel-body">

	  		<h3>
	   			<?php echo $num_correct_answers . ' correct answers!' ?>
	  		</h3>
	  </div>
	</div>
</div>

<div class="col-md-3">
</div>

<?php
require 'footer.php';
?>