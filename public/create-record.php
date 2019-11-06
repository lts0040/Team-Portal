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


<h2>Add Patient Record</h2>
<p>
  <input type="button" value="Add Field" onClick="addRow('dataTable')" /> 
  <input type="button" value="Remove Field" onClick="deleteRow('dataTable')" /> 
</p>

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
    <label>Timestamp</label>
    <input type="datetime-local" name="Timestamp">
    </td>
  </tr>
  <tr>
	<p>
	<td>
	<label>Field</label>
	<input type="text" name="R_FIELD[]">
	</td>
	<td>
	<label>Value</label>
	<input type="text" name="R_VALUE[]">
	</td>
	</p>
  </tr>
 </tbody>
</table>

<input type="submit" name="submit" value="Submit" id="submitForm">  
</form>
<script>
function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 100){                            // limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[2].cells.length;
		for(var i=0; i <colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[2].cells[i].innerHTML;
		}
	}else{
		 alert("Maximum Field Count is 100.");
	}
}

function deleteRow(tableID) {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
    if(rowCount <= 3) {               // limit the user from removing all the fields
        alert("Cannot remove last field.");
    }
    else {
        table.deleteRow(rowCount-1);
    }
}
</script>

<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" ){//&& $isDoctor > 0) {
if(isset($_POST)==true && empty($_POST)==false){
    echo "<p>Here is the data you inputted:</p>";
	echo "<p>Username: " . $_POST['Username'] . "</p>";
    echo "<p>Timestamp: " . $_POST['Timestamp'] . "</p>";
    $fields = $_POST['R_FIELD'];
    $values = $_POST['R_VALUE'];
    $json_export = array();
    for ($x = 0; $x < count($fields); $x++) {
        if((!empty($fields[$x]) && !empty($values[$x]))) {
            $json_export[$fields[$x]] = $values[$x];
        }
    }
    $json_string = json_encode($json_export,true);
    echo "<p>Data: " . $json_string . "</p>";
    
    $sql_statement = "INSERT INTO records (d_uid,p_uid,record,timestamp) VALUES(1," . $_POST['Username'] . ",'" . $json_string . "','" . $_POST['Timestamp'] . "');";
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