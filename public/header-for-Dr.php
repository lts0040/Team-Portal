<?php
require_once 'tools.php';
include ('config.php'); 
if (!$page_title){
  $page_title = "DP Portal";
if(session_status() == PHP_SESSION_NONE) {
  session_start();
}
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

  <!-- Links -->
  <ul class="navbar-nav">

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="/appointments.php" id="navbardrop" data-toggle="dropdown">
        Appointments
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="/appointments.php">Current Appointments</a>
        <a class="dropdown-item" href="/create-appointments.php">Create Appointment</a>
      </div>
    </li>
	<li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="/records.php" id="navbardrop" data-toggle="dropdown">
        Records
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="/records.php">View Records</a>
        <a class="dropdown-item" href="/create-record.php">Create Record</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="/medications.php" id="navbardrop" data-toggle="dropdown">
        Medications
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="/medications.php">View Medications</a>
        <a class="dropdown-item" href="/create-medication.php">Create Medication</a>
      </div>
    </li>
	<li class="nav-item">
			  <a class="nav-link" href="/view-patients/view-patients.php">View Patient</a>
			</li>
    <li class="nav-item">
      <?php 
        if(isset($_SESSION['username'])) {
          $q = 'SELECT `from_user`, `to_user` FROM `messages` WHERE `to_user` = "'.$_SESSION['username'].'" OR `from_user` = "'.$_SESSION['username'].'" ORDER BY `m_uid` DESC LIMIT 1';

          $r = mysqli_query($link, $q);

          if($r) {
            if(mysqli_num_rows($r) > 0) {
              $value = mysqli_fetch_object($r);
              $to_user = $value->to_user;
              $from_user = $value->from_user;

              if($to_user == $_SESSION['username']) {
                $_SESSION['to_user'] = $from_user;
              }
              else {
                $_SESSION['to_user'] = $to_user;
              }
            }
            else {
              $_SESSION['to_user'] = $_SESSION['username'];
            }
          } 
        }
        ?>
      <a class="nav-link" href="/messaging.php?user=<?php echo $_SESSION['to_user']; ?>">Messages</a>
    </li>
    
    <li class="nav-item" style="float:right !important;">
      <a class="nav-link" href="/logout.php">Logout</a>
    </li>
  </ul>
</nav>
