<?php
require 'header.php';
?>

<?php

if(!isset($_SESSION['username']))
	header("location:index.php");
else if($_SESSION['question'] == 8)
	header("location:result.php");

if(isset($_SESSION['question']))
	$_SESSION['question'] = $_SESSION['question'] + 1;
else 
	$_SESSION['question'] = 1;

# Check if the page load was for a question submit or is it a new quiz 
if(isset($_POST['submit'])){
	
	# This is an answer submit.

	$competency = $_SESSION["competency"];
	$available_ids = $_SESSION["available_ids"];	

	# Segregating answer_id and is_correct from form post variable
	$answer = explode( '|', $_POST["selected_answer"]);

	$answer_id = $answer[0];

	$is_correct = $answer[1];

	$is_correct = ($is_correct === chr(0x01));

	# Calculating the new competency based on the algo mentioned in readme.md
   	if($is_correct)
   		$competency = $competency + $_SESSION["previous_question_score"];
   	else{
   		$competency = $competency - (1 - $_SESSION["previous_question_score"]);
   		$is_correct = 0;
   	}		

	# Adding the previous question's answer to the database
   	$sql="INSERT INTO user_answers VALUES ($_SESSION[user_id],$_SESSION[previous_question_id],$answer_id,$is_correct)";

	$insert=mysql_query($sql);

	if($competency < 1)
		$competency = 1;

	if($competency < 2)
		$level = 1;
	else if($competency < 3)
		$level = 2;
	else
		$level = 3;

} else {

	# Starting a new quiz;

	# Calculating total number of questions
	$result=mysql_query("SELECT count(*) as total from questions where is_deleted = 0");
	$data=mysql_fetch_assoc($result);
	$num_of_questions = $data['total'];

	$available_ids = range(1, $num_of_questions);

	$competency = $level = 1;

}	
	$_SESSION["competency"] = $competency;

	$available_ids_list = implode( ', ', $available_ids);

	# Randomly selecting questions for the calculated level
	$sql = "SELECT * FROM questions WHERE id IN ($available_ids_list) AND level = $level AND is_deleted = 0 ORDER BY rand()";

	$result = mysql_query($sql);

	$question = mysql_fetch_assoc($result);

	$answers = mysql_query("SELECT * FROM answers WHERE question_id = " . $question['id']);

	# removing the fetched question's ids from available ids
	# so that this question is not presented to the user again
	if (($key = array_search($question['id'], $available_ids)) !== false) {
	    unset($available_ids[$key]);
	}

	# Setting required session variables for use in next question and storing data
	$_SESSION["available_ids"] = $available_ids;
	$_SESSION["previous_question_score"] = $question['score'];
	$_SESSION["previous_question_id"] = $question['id'];

?>

<div class="col-md-3">
</div>
<div class="col-md-6">
	<div class="panel panel-default question-box">
	  <div class="panel-heading">
	    <h3 class="panel-title question"><?php echo $question["question"]?></h3>
	    <h3 class="panel-title info"><?php echo $_SESSION["question"]?> off 8</h3>
	  </div>
	  <div class="panel-body">
	  	<form action="quiz.php" method="post">
	  		<div class="form-group" id="answers-group">

	   			<?php while($row = mysql_fetch_assoc($answers)) { ?>

	  				<span class="radio col-md-6">
						<input class="radio_buttons optional" id="answer<?php echo $row['id'] ?>" name="selected_answer" type="radio" value="<?php echo $row['id'] . '|' . $row['is_correct'] ?>"> <?php echo $row['answer'] ?>
		  			</span>
	 
			    <?php } ?> 
	  		</div>
	  		<button class="btn btn-default" type="submit" name="submit" id="submit-answer">
	  			Submit
	  		</button>
	  	</form>
	  </div>
	</div>
</div>
<div class="col-md-3">
</div>

<?php
require 'footer.php';
?>