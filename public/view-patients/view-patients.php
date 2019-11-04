<?php
	session_start();
	$page_title = "DP Portal";
	include('../config.php');
	include('../funcs/getAuth.php');
	include('../header-for-Dr.php'); 
?>
<html>
	<head>
		<link href="register.css" type="text/css" rel="stylesheet">
	</head>
	<body>
	
	<?php include '../funcs/getAuth.php';
		$isDoctor = getDoctorAuthID();
		
		if($isDoctor == 0){
			echo 'Unauthorized to see this!';
			return;
		}
		
		$sql = "SELECT * FROM users WHERE user_auth IS NOT NULL;";
		$result = mysqli_query($link, $sql);
		$resultCheck = mysqli_num_rows($result);
		
		if($resultCheck > 0){
			echo " <h2 style=\"text-align:center\" >Patient List </h2>" ;
			
			while( $row = mysqli_fetch_assoc($result) ){
				
				$queryRecord = "SELECT r.record FROM records AS r JOIN users AS u ON u.uid = r.p_uid 
									WHERE u.username = '".$row['username']."';" ;
				
				$r = mysqli_query($link, $queryRecord);
				echo $row['username']  ;
				
				while( $record = mysqli_fetch_assoc($r) ){
					echo ": &nbsp " . $record['record']. "<br>" ;
				}
			}
		}
		else{
			echo 'No users!';
		}
		
		
	?>
	
	
	
	</body>

</html>