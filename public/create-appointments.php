<?php
include ('funcs/getAuth.php');
include ('config.php');

$page_title = "DP Portal";

$hasDoctor = getDoctorAuthID(); //echo $_SESSION['username']. $isDoctor ;
$hasPatient = getPatientAuth();
$isAdmin = getAdminAuth();

if ($hasDoctor !== "false")
	{$_SESSION['header'] = 'header-for-Dr.php'; include($_SESSION['header']);}
else if ($hasPatient !== "false")
	{$_SESSION['header'] = 'header-for-Patient.php'; include($_SESSION['header']);header("location:index.php"); }
else if ($isAdmin == 1)
	{$_SESSION['header'] = 'header-for-Admin.php'; include($_SESSION['header']);}
else
	{$_SESSION['header'] = 'header.php'; include($_SESSION['header']); header("location:login.php"); }

?>


<h2>Add Appointment</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table id="dataTable" class="form" border="1">
 <tbody>
  <tr>
    <td>
    <label>Username</label>
    <input type="text" name="Username">
    </td>
  </tr>
  <tr>
    <td>
    <label>Start Time</label>
    <input type="datetime-local" name="time_start">
    </td>
  </tr>
  <tr>
    <td>
    <label>End Time</label>
    <input type="datetime-local" name="time_end">
    </td>
  </tr>
  <tr>
    <td>
    <label>Purpose</label>
    <input type="text" name="purpose">
    </td>
  </tr>
 </tbody>
</table>

<input type="submit" name="submit" value="Submit" id="submitForm">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST)==true && empty($_POST)==false){
    echo "<p>Here is the data you inputted:</p>";
	echo "<p>Username: " . $_POST['Username'] . "</p>";
    echo "<p>Time start: " . $_POST['time_start'] . "</p>";
    echo "<p>Time end: " . $_POST['time_end'] . "</p>";
    echo "<p>Purpose: " . $_POST['purpose'] . "</p>";

    $sql_statement = "INSERT INTO appointments (d_username,p_username,date_start,date_end,purpose) VALUES('" . $_SESSION['username'] . "','" . $_POST['Username'] . "','" . $_POST['time_start'] . "','" . $_POST['time_end'] . "','" . $_POST['purpose'] . "');";
    
    if (!mysqli_query($link, $sql_statement)) {
        die('Error: ' . mysql_error());
    }
    else {
        echo "<p>Appointment successfully added!</p>";
    }
}
}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p>You do not have the ability to create records!</p>";
}
?>

<?php
include ('footer.php');
?>
