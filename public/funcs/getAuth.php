<?php
	//session_start();
	//include('../config.php');
	
	if(!function_exists('getDoctorAuthID' 	)) {
		function getDoctorAuthID() {
			$isDoctor = 0;
			if(isset($_SESSION['username'])) {
				$user_name = $_SESSION['username']; 
				//echo "Currently login as: " .$user_name."<br>";
				$sql = 'SELECT doctor_auth FROM `users` WHERE `username` = "'.$user_name.'" AND doctor_auth IS NOT NULL';
				$sqlResult = mysqli_query($_SESSION['link'], $sql);
				
				if ( $doctorAuth= mysqli_fetch_assoc($sqlResult)) {
				  
					$isDoctor = $doctorAuth["doctor_auth"];
				}
				else{
					$isDoctor = 0;
				}
			}
			return $isDoctor;
		}
	}  
	
	if(!function_exists('getPatientAuth' 	)) {
		function getPatientAuth() {
			$isPatient = 0;
			if(isset($_SESSION['username'])) {
				$user_name = $_SESSION['username']; 
				//echo "Currently login as: " .$user_name."<br>";
				$sql = 'SELECT user_auth FROM `users` WHERE `username` = "'.$user_name.'" AND user_auth IS NOT NULL';
				$sqlResult = mysqli_query($_SESSION['link'], $sql);
				
				if ( $patientAuth= mysqli_fetch_assoc($sqlResult)) {
				   
					$isPatient = $patientAuth["user_auth"];
				}
				else{
					$isPatient = 0;
				}
			}
			return $isPatient;
		}
	}  