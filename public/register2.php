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

	<div class="tab-box">
		<div class="Doctor-Patient-Tab" align="center">
		  <button class="tab-button" id="doctor-button" onclick="changehdr('doctor')">Doctor</button>
		  <button class="tab-button" id="patient-button" onclick="changehdr('patient')">Paitent</button>
		  <button class="tab-button" id="patient-button" onclick="changehdr('admin')">Admin</button>
		</div>
	</div>

	<script>
		function changehdr(userType){

			if (userType == "doctor") {
				clearform($("#container_2"));
				clearform($("#container_3"));
				document.getElementById("container").style.display = "block";
				document.getElementById("container_2").style.display = "none";
				document.getElementById("container_3").style.display = "none";
			}
			else if (userType == "patient") {
				clearform($("#container"));
				clearform($("#container_3"));
				document.getElementById("container").style.display = "none";
				document.getElementById("container_2").style.display = "block";
				document.getElementById("container_3").style.display = "none";
			}
			else {
				clearform($("#container"));
				clearform($("#container_2"));
				document.getElementById("container").style.display = "none";
				document.getElementById("container_2").style.display = "none";
				document.getElementById("container_3").style.display = "block";
			}
		}

		function clearform($form) {
			$form.find(':input:not([name="register"], [name="gender"])').val('');
		}
	</script>

	<div align="center" id="container" class="user">
		<h2 id="header-text" align="center">Doctor Register</h2>
		<form method="post">
			<div id = "input_box">
				<div id="checking" style="display: none;">Checking Username</div>

				<input type="text" placeholder="Username" id="user_name" onkeyup="check_user()" 	   name="Username" class="input" required />
					   
				<input type="password" placeholder="Password" name="Password" class="input" 		   required/>

				<input type="date" placeholder="Date of Birth" id="dob" name="dob" class="input" required />

				<input type="text" placeholder="Address" id="address" name="address" class="input" required />

				<input type="tel" placeholder="Phone Number" id="phone" name="phone" class="input" required />

				<select type="text" placeholder="Gender" id="gender" name="gender" class="input" required >
					<option>Male</option>
					<option>Female</option>
					<option>Other</option>
				</select>

				<input type="email" placeholder="Email" id="email" name="email" class="input" required />

				<input type="text" placeholder="User auth" id="u_auth" name="u_auth" class="input" />

				<input type="submit" class="submit-button" href="/index.php" id="register" name="register"/>
			</div>
		</form>
	</div>

	<div align="center" style="display: none;" id="container_2" class="user">
		<h2 id="header-text" align="center">Patient Register</h2>
		<form method="post">
			<div id = "input_box">
				<div id="checking" style="display: none;">Checking Username</div>

				<input type="text" placeholder="Username" id="user_name_2" onkeyup="check_user()" 	   name="Username" class="input" required />
					   
				<input type="password" placeholder="Password" name="Password" class="input" 		   required/>

				<input type="date" placeholder="Date of Birth" id="dob_2" name="dob" class="input" required />

				<input type="text" placeholder="Address" id="address_2" name="address" class="input" required />

				<input type="tel" placeholder="Phone Number" id="phone_2" name="phone" class="input" required />

				<select type="text" placeholder="Gender" id="gender_2" name="gender" class="input" required >
					<option>Male</option>
					<option>Female</option>
					<option>Other</option>
				</select>

				<input type="email" placeholder="Email" id="email_2" name="email" class="input" required />

				<input type="text" placeholder="Doctor auth" id="d_auth" name="d_auth" class="input" />

				<input type="text" placeholder="Allergies" id="allergies" name="allergies" class="input" />

				<input type="text" placeholder="Medications" id="medications_2" name="medications" class="input" />

				<input type="text" placeholder="Pharmacy" id="pharmacy_2" name="pharmacy" class="input" />

				<input type="submit" class="submit-button" href="/index.php" id="register_2" name="register"/>
			</div>
		</form>
	</div>

	<div align="center" style="display: none;" id="container_3" class="user">
		<h2 id="header-text" align="center">Admin Register</h2>
		<form method="post">
			<div id = "input_box">
				<div id="checking" style="display: none;">Checking Username</div>

				<input type="text" placeholder="Username" id="user_name_3" onkeyup="check_user()" 	   name="Username" class="input" required />
					   
				<input type="password" placeholder="Password" name="Password" class="input" 		   required/>

				<input type="tel" placeholder="Phone Number" id="phone_3" name="phone" class="input" required />

				<input type="email" placeholder="Email" id="email_3" name="email" class="input" required />

				<input type="submit" class="submit-button" href="/index.php" id="register_3" name="register"/>
			</div>
		</form>
	</div>

	<?php

		if(isset($_POST['register'])) {
			$user_name = isset($_POST['Username']) ? $_POST['Username'] : '';
			$Password = isset($_POST['Password']) ? $_POST['Password'] : '';
			$dob = isset($_POST['dob']) ? $_POST['dob'] : '';
			$address = isset($_POST['address']) ? $_POST['address'] : '';
			$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
			$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
			$email = isset($_POST['email']) ? $_POST['email'] : '';

			if (isset($_POST['u_auth'])) {
				$auth = isset($_POST['u_auth']) ? $_POST['u_auth'] : '';
				$query = "INSERT INTO `users` (`username`, `password`, `dob`, `address`, `phone_number`, `gender`, `email`, `user_auth`)
					  VALUES ('".$user_name."', '".$Password."', '".$dob."','".$address."','".$phone."','".$gender."','".$email."','".$auth."')";
			}

			else if (isset($_POST['d_auth'])) {
				$auth = isset($_POST['d_auth']) ? $_POST['d_auth'] : '';
				$query = "INSERT INTO `users` (`username`, `password`, `dob`, `address`, `phone_number`, `gender`, `email`, `doctor_auth`)
					  VALUES ('".$user_name."', '".$Password."', '".$dob."','".$address."','".$phone."','".$gender."','".$email."','".$auth."')";
			}

			else {
				$auth = isset($_POST['a_auth']) ? $_POST['a_auth'] : '';
				$query = "INSERT INTO `users` (`username`, `password`,  `dob`, `address`, `phone_number`, `gender`, `email`, `admin_auth`)
					  VALUES ('".$user_name."', '".$Password."', '".$dob."','".$address."','".$phone."','".$gender."','".$email."', 1)";
			}

			$r = mysqli_query($link, $query);

			if($r){
				echo '<p style="color:green">User registered</p>';
			}
			else{
				echo '<p style="color:red">Error registering user --'.$query.'</p>';
			}
		}
	?>

	<script src="libs/jquery-3.4.1.min.js"></script>
	<script>
		document.getElementById("register").disabled = true;
		function check_user(){
			var user_name = document.getElementById("user_name").value;

			if (user_name) {
				$.post("funcs/user_check.php",
				{
					user: user_name
				},

				function(data, status){
					if(data == '<p style="color:red">User already exists</p>') {
						document.getElementById("register").disabled = true;
					}
					else{
						document.getElementById("register").disabled = false;	
					}

					document.getElementById("checking").style.display = "inline-block";
					document.getElementById("checking").innerHTML = data;
				}
				);	
			} 
			else {
				document.getElementById("checking").style.display = "none";
			}
		}
	</script>
</body>	
</html>

<?php include('footer.php'); ?>