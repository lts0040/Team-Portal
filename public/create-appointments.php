<?php
include ('funcs/getAuth.php'); 
include ('config.php'); 
$page_title = "DP Portal";
if(session_status() == PHP_SESSION_NONE) {
  session_start();
}
include($_SESSION['header']);
?>


<h2>Add Appointment</h2>

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
    echo "<p>Doctor: " . $_SESSION['username'] . "</p>";
    echo "<p>Time start: " . $_POST['time_start'] . "</p>";
    echo "<p>Time end: " . $_POST['time_end'] . "</p>";
    echo "<p>Purpose: " . $_POST['purpose'] . "</p>";
    $sql = "SELECT * FROM appointments WHERE p_username='".$_POST['Username']."' OR d_username='".$_SESSION['username']."' AND date_start<='".$_POST['time_start']."' AND date_end>='".$_POST['time_start']."';";

    $result = mysqli_query($link, $sql);
    
    if(mysqli_num_rows($result) == 0) {
        if ($_POST['time_end'] < $_POST['time_start']) {
            echo "<p>Error: End time is before start time!</p>";
        }
        else {
            $sql_statement = "INSERT INTO appointments (d_username,p_username,date_start,date_end,purpose) VALUES('" . $_SESSION['username'] . "','" . $_POST['Username'] . "','" . $_POST['time_start'] . "','" . $_POST['time_end'] . "','" . $_POST['purpose'] . "');";
            
            if (!mysqli_query($link, $sql_statement)) {
                echo 'Error: ' . mysqli_error($link);
            }
            else {
                echo "<p>Appointment successfully added!</p>";
            }
        }
    }
    else {
        echo "<p>Error: Conflicting appointment time with doctor/patient</p>";
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