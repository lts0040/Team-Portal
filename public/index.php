<?php 
session_start();
include ('funcs/getAuth.php'); 
include ('config.php'); 

$page_title = "DP Portal";

$isDoctor = getDoctorAuthID(); //echo $_SESSION['username']. $isDoctor ;
$isPatient = getPatientAuth();
if ($isDoctor > 0)
	{include('header-for-Dr.php'); }
else if ($isPatient > 0)
	{include ('header-for-Patient.php'); }
else
	{include ('header.php');}

include('config.php');

if(isset($_SESSION['username']))
	echo 'Hello '.$_SESSION['username'];
?>
<h1>Welcome to Doctor Patient Portal</h1>
<p>This is the main text for the home page of the doctor patient portal!</p>

<?php include('footer.php'); ?>