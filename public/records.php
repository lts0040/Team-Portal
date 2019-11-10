<?php
include ('funcs/getAuth.php'); 
include ('config.php'); 

$page_title = "DP Portal";

$isDoctor = getDoctorAuthID(); //echo $_SESSION['username']. $isDoctor ;
$isPatient = getPatientAuth();
if ($isDoctor > 0)
	{include('header-for-Dr.php'); 
        $sql = "SELECT * FROM users WHERE user_auth IS NOT NULL;";
		$result = mysqli_query($link, $sql);
		$resultCheck = mysqli_num_rows($result);
		
		if($resultCheck > 0){
			echo " <h2 style=\"text-align:center\" >Patient List </h2>" ;
			
			while( $row = mysqli_fetch_assoc($result) ){
				
				$queryRecord = "SELECT r.record, r.timestamp FROM records AS r JOIN users AS u ON u.uid = r.p_uid 
									WHERE u.username = '".$row['username']."';" ;
				
				$r = mysqli_query($link, $queryRecord);
				echo "<h3>Record for: " . $row['username'] . "</h3>";
                echo "<h3>Date: " . $row['timestamp'] . "</h3>";
				
				while( $record = mysqli_fetch_assoc($r) ){
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Field</th>';
                    echo '<th scope="col">Record</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    $p_record = json_decode($record['record'], true);
					foreach ($p_record as $name => $value) {
                        echo '<tr>';
                        echo '<th scope="row">' . $name . '</th>';
                        echo '<td>' . $value . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '<br>';
				}
			}
		}
		else{
			echo '<p>No users!</p>';
            
		}
}
else if ($isPatient > 0)
	{include ('header-for-Patient.php'); 
    $queryRecord = "SELECT r.record, r.timestamp FROM records AS r JOIN users AS u ON u.uid = r.p_uid 
									WHERE u.username = '".$_SESSION['username']."';" ;
				
    $r = mysqli_query($link, $queryRecord);
    
    while( $record = mysqli_fetch_assoc($r) ){
        echo "<h3>Date: " . $record['timestamp'] . "</h3>";
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Field</th>';
        echo '<th scope="col">Record</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $p_record = json_decode($record['record'], true);
        foreach ($p_record as $name => $value) {
            echo '<tr>';
            echo '<th scope="row">' . $name . '</th>';
            echo '<td>' . $value . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<br>';
    }
}
else
	{include ('header.php');
    echo "<p>Need to login in order to view records!</p>";
}

include ('footer.php');
?>