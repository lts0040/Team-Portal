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


?>


<main role="main">

      <!-- Main Description -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-4">Welcome to the Doctor Patient Portal!</h1>
          <p>Hello <?php echo $_SESSION['username']?>, this is a website designed to manage the all of the doctor and patient functions for a small clinic!</p>
          <!--<p><a class="btn btn-primary btn-lg" href="#" role="button">Test Button &raquo;</a></p>-->
        </div>
      </div>

      <div class="container">
        <!-- Functions column -->
        <div class="row">
          <div class="col-md-4">
            <h2>Appointments</h2>
            <p>Manage and view appointments by setting and viewing appointment dates and information!</p>
            <p><a class="btn btn-secondary" href="/appointments.php" role="button">Appointments &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Records</h2>
            <p>Add and view patient records of any form along with critical information about the records!</p>
            <p><a class="btn btn-secondary" href="/records.php" role="button">Records &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Medications</h2>
            <p>Add and manage patient medications to stay up to date!</p>
            <p><a class="btn btn-secondary" href="/medications.php" role="button">Medications &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Messaging</h2>
            <p>Easily contact doctors and patients through our messaging portal!</p>
            <p><a class="btn btn-secondary" href="/messaging.php" role="button">Messages &raquo;</a></p>
          </div>
        </div>

        <hr>

      </div> <!-- /container -->

    </main>

<?php include('footer.php'); ?>