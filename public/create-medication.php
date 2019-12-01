<?php
include ('funcs/getAuth.php'); 
include ('config.php'); 
$page_title = "DP Portal";
if(session_status() == PHP_SESSION_NONE) {
  session_start();
}
include($_SESSION['header']);
?>


<h2>Add Patient Medication</h2>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table id="dataTable" class="form" border="1">
 <tbody>
  <tr>
    <td>
    <label>Username</label>
    <select id="selectUser" name="Username">
        <?php
            $query = 'SELECT username FROM users WHERE user_auth IS NOT NULL';
            $r = mysqli_query($link, $query);
            if($r) {
                while($row = mysqli_fetch_assoc($r)) {
                    $doctor = $row['username'];
                    ?>
                        <option><?php echo $doctor; ?></option>
                    <?php
                }
            }
            else {
            }
        ?>
    </select>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST)==true && empty($_POST)==false){
    echo "<p>Here is the data you inputted:</p>";
	echo "<p>Username: " . $_POST['Username'] . "</p>";
    echo "<p>Medication Name: " . $_POST['Name'] . "</p>";
    echo "<p>Medication Amount: " . $_POST['Amount'] . "</p>";
    echo "<p>Medication Time: " . $_POST['Time'] . "</p>";
    
    $sql_statement = "INSERT INTO medications (d_username,p_username,med_amount,med_name,med_time) VALUES('" . $_SESSION['username'] . "','" . $_POST['Username'] . "','" . $_POST['Amount'] . "','" . $_POST['Name'] ."','". $_POST['Time'] . "');";
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