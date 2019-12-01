<?php
	if(session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	//session_start();
	//include('../config.php');
	
	if( !function_exists('getDoctorAuthID') ) {
		function getDoctorAuthID() {
			if(isset($_SESSION['username'])) {
				$user_name = $_SESSION['username']; 
				//echo "Currently login as: " .$user_name."<br>";
				$sql = 'SELECT doctor_auth FROM `users` WHERE `username` = "'.$user_name.'" AND doctor_auth IS NOT NULL';
				$sqlResult = mysqli_query($_SESSION['link'], $sql);
                $rowcount=mysqli_num_rows($sqlResult);
                if ($rowcount > 0) {
                    $doctorAuth= json_decode(mysqli_fetch_array($sqlResult,MYSQLI_NUM)[0]);
                }
                else {
                    $doctorAuth = false;
                }				
				
			}
			else {
                $doctorAuth = false;
            }
			return $doctorAuth;
		}
	}  
	
	if( !function_exists('getPatientAuth') ) {
		
		function getPatientAuth() {
			if(isset($_SESSION['username'])) {
				$user_name = $_SESSION['username']; 
				//echo "Currently login as: " .$user_name."<br>";
				$sql = 'SELECT user_auth FROM `users` WHERE `username` = "'.$user_name.'" AND user_auth IS NOT NULL';
				$sqlResult = mysqli_query($_SESSION['link'], $sql);
                $rowcount=mysqli_num_rows($sqlResult);
                if ($rowcount > 0) {
                    $userAuth= json_decode(mysqli_fetch_array($sqlResult,MYSQLI_NUM)[0]);
                }
                else {
                    $userAuth = false;
                }				
				
			}
			else {
                $userAuth = false;
            }
			return $userAuth;
		}
	}  
	
	
	if( !function_exists('getAdminAuth') ) {
		
		function getAdminAuth() {
			if(isset($_SESSION['username'])) {
				$user_name = $_SESSION['username']; 
				//echo "Currently login as: " .$user_name."<br>";
				$sql = 'SELECT admin_auth FROM `users` WHERE `username` = "'.$user_name.'" AND admin_auth IS NOT NULL AND admin_auth = 1';
				$sqlResult = mysqli_query($_SESSION['link'], $sql);
                $rowcount=mysqli_num_rows($sqlResult);
                if ($rowcount > 0) {
                    $adminAuth= 1;
                }
                else {
                    $adminAuth = 0;
                }				
				
			}
			else {
                $adminAuth = 0;
            }
			return $adminAuth;
		}
	}  