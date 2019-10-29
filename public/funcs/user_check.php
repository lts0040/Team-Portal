<?php
	include('../config.php');
	if(isset($_POST['user'])) {
		$q = 'SELECT * FROM `users` WHERE `username` = "'.$_POST['user'].'"';
		$r = mysqli_query($link, $q);
		if($r){
			if(mysqli_num_rows($r) > 0){
				echo '<p style="color:read">User already exists</p>';
			}
			else{
				echo '<p style="color:green">This username is not taken</p>';
			}	
		}
		else{
			echo $q;
		}
	}
?>