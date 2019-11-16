<?php 
session_start();
include ('funcs/getAuth.php'); 
include ('config.php'); 

$page_title = "DP Portal";

$hasDoctor = getDoctorAuthID(); //echo $_SESSION['username']. $isDoctor ;
$hasPatient = getPatientAuth();
$isAdmin = getAdminAuth();

if ($hasDoctor !== "false")
	{$_SESSION['header'] = 'header-for-Dr.php'; include($_SESSION['header']);}
else if ($hasPatient !== "false")
	{$_SESSION['header'] = 'header-for-Patient.php'; include($_SESSION['header']);}
else if ($isAdmin == 1)
	{$_SESSION['header'] = 'header-for-Admin.php'; include($_SESSION['header']);}
else
	{$_SESSION['header'] = 'header.php'; include($_SESSION['header']); header("location:login.php"); }

//include('config.php');

if(isset($_SESSION['username']))
	echo '<h1>Hello '.$_SESSION['username'].'! </h1>';
echo '<h2>Welcome to Doctor Patient Portal!</h2>';
?>

<p>This is the home page of the doctor patient portal! This website is meant to manage doctor patient interactions for a small clinic!</p>

<?php include('footer.php'); ?>