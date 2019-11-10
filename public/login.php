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
	<h1 align="center">Login</h1>
	<div align="center" id="container">
		<form method="post">
			<div id = "input_box">
				<input type="text" placeholder="Username" id="user_name" name="Username" class="input" required />

				<input type="password" placeholder="Password" name="Password" class="input" 		   required/>
				<a href="/register2.php">Register Here</a><br><br>
				<input type="submit" value="Login" href="/index.php" class="submit-button" id="login" name="login"/>
			</div>
		</form>
	</div>

	<?php if(isset($_POST['login'])) {
		$user_name = $_POST['Username'];
		$Password = $_POST['Password'];

		$query = 'SELECT uid FROM `users` where `username` = "'.$user_name.'" AND `password` = "'.$Password.'"';

		$r = mysqli_query($link, $query);

		if($r){
			if(mysqli_num_rows($r) > 0) {
				$_SESSION['username'] = $user_name;
				$value = mysqli_fetch_object($r);
				$_SESSION['uid'] = $value->uid;
				header("location:index.php");
			}
			else {
				echo '<p style="color:red" align="center">Login Failed</p>';
			}
		}
		else{
			echo $q;
		}
	}
	?>
</body>	
</html>

<?php include('footer.php'); ?>