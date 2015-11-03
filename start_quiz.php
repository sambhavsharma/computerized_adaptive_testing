<?php
require 'conf/config.php';

$username=$_POST['username'];

$sql="SELECT * FROM users WHERE username='$username'";

$result=mysql_query($sql);

$count=mysql_num_rows($result);

$user = mysql_fetch_assoc($result);

if($count==0){
	$sql="INSERT INTO users (username) VALUES ('$username')";
	$result=mysql_query($sql);	

} else {
	$sql="DELETE FROM user_answers WHERE user_id " . $user['id'];
	$result=mysql_query($sql);	
}

$_SESSION["username"] = $username;
$_SESSION["user_id"] = $user['id'];
$_SESSION['question'] = 0;

header("location:quiz.php");

?>