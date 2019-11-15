<?php
if(session_status() == PHP_SESSION_NONE) {
  session_start();
}
require_once 'tools.php';
include('config.php');
if (!$page_title){
  $page_title = "DP Portal";
 // require ('/funcs/getDoctorAuth.php');
}
?>
<head>
<title><?php echo $page_title;?></title>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="/libs/bootstrap-4.3.1-dist/css/bootstrap.min.css"> 
<!-- JQUERY -->
<script src="/libs/jquery-3.3.1.slim.min.js"></script>
<!-- Popper.js -->
<script src="/libs/popper-1.14.7.min.js"></script>
<!-- Bootstrap core JS -->
<script src="/libs/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
</head>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="/">DP Portal</a>    
</nav>
