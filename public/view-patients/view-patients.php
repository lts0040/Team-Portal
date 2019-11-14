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
		$doctor_auth = getDoctorAuthID(); //doctor_auth stores patients' ids of that doctor
		
		if( empty($doctor_auth) ){
			echo 'Unauthorized to see this!';
			return;
		}
		
		echo " <h2 style=\"text-align:center\" >Patient List </h2>" ;
		
		foreach($doctor_auth as $item)	
		{	
			$ids = explode (",", $item); //parse ids between ,
	
			foreach($ids as $patientId)
			{	$queryRecord = "SELECT u.username, r.record FROM records AS r JOIN users AS u ON u.uid = r.p_uid 
									WHERE r.p_uid = '".$patientId."';" ;
				
				$r = mysqli_query($link, $queryRecord);
				
				while($record = mysqli_fetch_assoc($r)){
					echo $record['username'].": &nbsp " . $record['record']. "<br>" ;
				}
			}	
			
		}
		
	?>
	
	
	
	</body>

</html>