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

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="/appointments.php">Appointments</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/records.php">Records</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/medications.php">Medications</a>
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
      <a class="nav-link" href="/login.php">Login</a>
    </li>
    <li class="nav-item" style="float:right !important;">
      <a class="nav-link" href="/logout.php">Logout</a>
    </li>
  </ul>
</nav>
