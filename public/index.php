<?php 
session_start();
include ('funcs/getAuth.php'); 
include ('config.php'); 

$page_title = "DP Portal";

$isDoctor = getDoctorAuthID(); //echo $_SESSION['username']. $isDoctor ;
$isPatient = getPatientAuth();
if (!empty($isDoctor))
	{include('header-for-Dr.php');}
else if (!empty($isPatient))
	{include ('header-for-Patient.php'); }
else
	{include ('header.php');}

//include('config.php');

if(isset($_SESSION['username']))
	echo '<h1>Hello '.$_SESSION['username'].'! </h1>';
echo '<h2>Welcome to Doctor Patient Portal</h2>';
?>

<p>This is the main text for the home page of the doctor patient portal!</p>

<?php include('footer.php'); ?>