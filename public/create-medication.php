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


<h2>Add Patient Medication</h2>


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
    <label>Medication Name</label>
    <input type="text" name="Name">
    </td>
  </tr>
  <tr>
    <td>
    <label>Medication Amount</label>
    <input type="text" name="Amount">
    </td>
  </tr>
  <tr>
    <td>
    <label>Medication Time</label>
    <input type="text" name="Time">
    </td>
  </tr>
 </tbody>
</table>

<input type="submit" name="submit" value="Submit" id="submitForm">  
</form>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" ){//&& $isDoctor > 0) {
if(isset($_POST)==true && empty($_POST)==false){
    echo "<p>Here is the data you inputted:</p>";
	echo "<p>Username: " . $_POST['Username'] . "</p>";
    echo "<p>Medication Name: " . $_POST['Name'] . "</p>";
    echo "<p>Medication Amount: " . $_POST['Amount'] . "</p>";
    echo "<p>Medication Time: " . $_POST['Time'] . "</p>";
    
    $sql_statement = "INSERT INTO medications (d_uid,p_uid,med_amount,med_name,med_time) VALUES(1," . $_POST['Username'] . ",'" . $_POST['Amount'] . "','" . $_POST['Name'] ."','". $_POST['Time'] . "');";
    if (!mysqli_query($link, $sql_statement)) {
        die('Error: ' . mysql_error());
    }
    else {
        echo "<p>Medication successfully added!</p>";
    }
}
}
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p>You do not have the ability to create medications!</p>";
}
?>

<?php
include ('footer.php');
?>