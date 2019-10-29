<?php

$page_title = "DP Portal";

error_reporting(-1);
ini_set('display_errors', 'true');

include('header.php'); 
include('config.php');
?>

<html>
<head>
	<link href="register.css" type="text/css" rel="stylesheet">
</head>
<body>
	<h1 align="center">Register</h1>
	<div align="center" id="container">
		<form method="post">
			<div id = "input_box">
				<input type="text" placeholder="Username" id="user_name" onkeyup="check_user()" 	   name="Username" class="input" required /><br><br>
					   <div id="checking">Checking</div>

				<input type="password" placeholder="Password" name="Password" class="input" 		   required/><br><br>
				<input type="submit" href="/index.php" id="register" name="register"/>
			</div>
		</form>
	</div>

	<?php if(isset($_POST['register'])) {
		$user_name = $_POST['Username'];
		$Password = $_POST['Password'];

		$query = "INSERT INTO `users` (`username`, `password`)
				  VALUES ('".$user_name."', '".$Password."')";
		$r = mysqli_query($link, $query);

		if($r){
			echo 'User registered';
		}
		else{
			echo 'Error registering user';
		}
	}
	?>

	<script src="libs/jquery-3.4.1.min.js"></script>
	<script>
		document.getElementById("register").disabled = true;
		function check_user(){
			var user_name = document.getElementById("user_name").value;

			$.post("funcs/user_check.php",
			{
				user: user_name
			},

			function(data, status){
				if(data == '<p style="color:read">User already exists</p>') {
					document.getElementById("register").disabled = true;
				}
				else{
					document.getElementById("register").disabled = false;	
				}

				document.getElementById("checking").innerHTML = data;
			}
			);
		}
	</script>
</body>	
</html>

<?php include('footer.php'); ?>