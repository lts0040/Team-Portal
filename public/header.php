<?php
require_once 'tools.php';
if (!$page_title){
  $page_title = "DP Portal";
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
      <a class="nav-link" href="#test1">test 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#test2">test 2</a>
    </li>

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        dropdown 1
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#d1">Link 1</a>
        <a class="dropdown-item" href="#d2">Link 2</a>
        <a class="dropdown-item" href="#d3">Link 3</a>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/messaging.php">Messages</a>
    </li>
    <li class="nav-item" style="float:right !important;">
      <a class="nav-link" href="/login.php">Login</a>
    </li>
    <li class="nav-item" style="float:right !important;">
      <a class="nav-link" href="/logout.php">Logout</a>
    </li>
  </ul>
</nav>
