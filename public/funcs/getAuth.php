<?php
	//session_start();
	//include('../config.php');
	
	if( !function_exists('getDoctorAuthID') ) {
		function getDoctorAuthID() {
			$doctorAuth = array();
			if(isset($_SESSION['username'])) {
				$user_name = $_SESSION['username']; 
				//echo "Currently login as: " .$user_name."<br>";
				$sql = 'SELECT doctor_auth FROM `users` WHERE `username` = "'.$user_name.'" AND doctor_auth IS NOT NULL';
				$sqlResult = mysqli_query($_SESSION['link'], $sql);
			
				$doctorAuth= mysqli_fetch_array($sqlResult,MYSQLI_NUM);
				
				//echo "doctorAuth: ";
				//foreach($doctorAuth as $id) { echo $id."<br>";}
			}
			return $doctorAuth;
		}
	}  
	
	if( !function_exists('getPatientAuth') ) {
		
		function getPatientAuth() {
			$patientAuth = array();
			if(isset($_SESSION['username'])) {
				$user_name = $_SESSION['username']; 
				//echo "Currently login as: " .$user_name."<br>";
				$sql = 'SELECT user_auth FROM `users` WHERE `username` = "'.$user_name.'" AND user_auth IS NOT NULL';
				$sqlResult = mysqli_query($_SESSION['link'], $sql);
				
				$patientAuth= mysqli_fetch_array($sqlResult,MYSQLI_NUM);
				
			}
			return $patientAuth;
		}
	}  
	
	
	if( !function_exists('getAdminAuth') ) {
		
		function getAdminAuth() {
			$adminAuth = array();
			if(isset($_SESSION['username'])) {
				$user_name = $_SESSION['username']; 
				//echo "Currently login as: " .$user_name."<br>";
				$sql = 'SELECT admin_auth FROM `users` WHERE `username` = "'.$user_name.'" AND admin_auth IS NOT NULL AND admin_auth = 1';
				$sqlResult = mysqli_query($_SESSION['link'], $sql);
				
				$adminAuth= mysqli_fetch_array($sqlResult,MYSQLI_NUM);
				
			}
			return $adminAuth;
		}
	}  