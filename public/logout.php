<?php
$page_title = "DP Portal";

error_reporting(-1);
ini_set('display_errors', 'true');

include('header.php'); 

if(isset($_SESSION['username'])) {
	unset($_SESSION['username']);
	header("location:login.php");
}
else {
	header("location:login.php");
}

?>

<?php include('footer.php'); ?>