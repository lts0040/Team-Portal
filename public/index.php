<?php

$page_title = "DP Portal";

include('header.php'); 
include('config.php');

if(isset($_SESSION['username']))
	echo 'Hello'.$_SESSION['username'];
?>
<h1>Welcome to Doctor Patient Portal</h1>
<p>This is the main text for the home page of the doctor patient portal!</p>

<?php include('footer.php'); ?>