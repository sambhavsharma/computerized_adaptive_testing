<?php

session_start();

# Clearing user answers, we can change this part and develop another logic
# if the application needs to save user answers even after the end of session
$sql = "DELETE FROM user_answers WHERE user_id = " . $_SESSION['user_id'];

mysql_query($sql);

session_destroy();

header("location:index.php");

?>