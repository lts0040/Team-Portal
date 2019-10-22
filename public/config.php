<?php
date_default_timezone_set('America/New_York');
$link = new mysqli("127.0.0.1", "root", "Team_Portal!", "dp_portal");
$link->set_charset('utf8');
// Check connection
$link->query("set character_set_client='utf8'"); 
$link->query("set character_set_results='utf8'"); 
$link->query("set collation_connection='utf8_general_ci'");
$link->set_charset('utf8');
if($link === false){
die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
