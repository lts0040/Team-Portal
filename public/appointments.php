<?php
include ('funcs/getAuth.php'); 
include ('config.php'); 
session_start();
$page_title = "DP Portal";
include ($_SESSION['header']);

if ($_SESSION['header'] == 'header-for-Dr.php')
	{
        $sql = "SELECT * FROM users WHERE user_auth LIKE '%[" . $_SESSION['username'] . ",%' OR user_auth LIKE '%," . $_SESSION['username'] . ",%' OR  user_auth LIKE '%," . $_SESSION['username'] . "]%' OR user_auth LIKE '%[" . $_SESSION['username'] . "]%';";
		$result = mysqli_query($link, $sql);
		$resultCheck = mysqli_num_rows($result);
        
		
		if($resultCheck > 0){
			echo " <h2 style=\"text-align:center\" >Patient Appointments </h2>" ;
            
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">Patient</th>';
            echo '<th scope="col">Date Start</th>';
            echo '<th scope="col">Date End</th>';
            echo '<th scope="col">Purpose</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
			
			while( $row = mysqli_fetch_assoc($result) ){
				
				$queryRecord = "SELECT date_start, date_end, purpose FROM appointments WHERE p_username = '".$row['username']."';" ;
				
				$r = mysqli_query($link, $queryRecord);
				
                if ($r) {
                    while( $record = mysqli_fetch_assoc($r) ){
                        echo '<tr>';
                        echo '<th scope="row">' . $row['username'] . '</th>';
                        echo '<td>' . $record['date_start'] . '</td>';
                        echo '<td>' . $record['date_end'] . '</td>';
                        echo '<td>' . $record['purpose'] . '</td>';
                        echo '</tr>';
                    }   
                }       
			}
            echo '</tbody>';
            echo '</table>';
            echo '<br>';
		}
		else{
			echo '<p>No users!</p>';
            
		}
}
else if ($_SESSION['header'] == 'header-for-Patient.php')
	{
    $queryRecord = "SELECT d_username, date_start, date_end, purpose FROM appointments WHERE p_username ='".$_SESSION['username']."';" ;
				
    $r = mysqli_query($link, $queryRecord);
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">Doctor</th>';
    echo '<th scope="col">Date Start</th>';
    echo '<th scope="col">Date End</th>';
    echo '<th scope="col">Purpose</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
        
    while( $record = mysqli_fetch_assoc($r) ){
        echo '<tr>';
        echo '<th scope="row">' . $record['d_username'] . '</th>';
        echo '<td>' . $record['date_start'] . '</td>';
        echo '<td>' . $record['date_end'] . '</td>';
        echo '<td>' . $record['purpose'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '<br>';
}
else
	{
    echo "<p>Need to login in order to view appointments!</p>";
}

include ('footer.php');
?>