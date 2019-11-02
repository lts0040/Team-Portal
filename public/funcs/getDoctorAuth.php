<?php
	session_start();
	
	include('../config.php');

	$user_name = $_SESSION['username']; echo "Currently login as: " .$user_name;
	$sql = 'SELECT doctor_auth FROM `users` WHERE `username` = "'.$user_name.'" AND doctor_auth IS NOT NULL';
	$sqlResult = mysqli_query($link, $sql);
	
	if ( $doctorAuth= mysqli_fetch_assoc($sqlResult)) {
       // printf  ($doctorAuth["doctor_auth"]);
		$isDoctor = $doctorAuth["doctor_auth"];
    }
	else{
		$isDoctor = 0;
	}
		

?>