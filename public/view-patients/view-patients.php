<?php
	//session_start();
	$page_title = "DP Portal";
	include('../config.php');
	include('../funcs/getDoctorAuth.php');
	include('../header.php'); 
?>
<html>
	<head>
		<link href="register.css" type="text/css" rel="stylesheet">
	</head>
	<body>
	
	<?php
		
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
				echo $row['username'] . "<br>";
			}
		}
		else{
			echo 'No users!';
		}
	?>
	
	
	
	</body>

</html>