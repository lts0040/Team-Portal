<?php
include ('funcs/getAuth.php');
include ('config.php');

$page_title = "DP Portal";

$isDoctor = getDoctorAuthID(); //echo $_SESSION['username']. $isDoctor ;
$isPatient = getPatientAuth();
if ($isDoctor > 0)
	{include('header-for-Dr.php');

}
else if ($isPatient > 0)
	{include ('header-for-Patient.php');
    echo "<p>Need doctor authorization to add records!</p>";
}
else
	{include ('header.php');
    echo "<p>Need to login in order to view records!</p>";
}

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
if ($_SERVER["REQUEST_METHOD"] == "POST" ){//&& $isDoctor > 0) {
if(isset($_POST)==true && empty($_POST)==false){
    //echo "<p>Here is the data you inputted:</p>";
	//echo "<p>Username: " . $_POST['Username'] . "</p>";
    //echo "<p>Timestamp: " . $_POST['Timestamp'] . "</p>";

//    $sql_statement = "INSERT INTO appointments (p_uid,d_uid,date_start,date_end,purpose) VALUES(" . $_POST('Username') . ", 1," . $_POST('time_start') . ", " . $_POST('time_end') . ", " . $_POST('purpose') . ");";
    $sql_statement = "INSERT INTO appointments (p_uid,d_uid,date_start,date_end,purpose) VALUES (" . $_POST('Username') . ", 1," . $_POST('time_start') . ", " . $_POST('time_end') . ", " . $_POST('purpose') . ");";
    if (!mysqli_query($link, $sql_statement)) {
        die('Error: ' . mysql_error());
    }
    else {
        echo "<p>Record successfully added!</p>";
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
