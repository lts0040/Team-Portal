<?php
include ('funcs/getAuth.php');
include ('config.php');

$page_title = "DP Portal";

$isDoctor = getDoctorAuthID(); //echo $_SESSION['username']. $isDoctor ;
$isPatient = getPatientAuth();
if ($isDoctor > 0) // Doctor side
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

        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Field</th>';
        echo '<th scope="col">Record</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
				while( $record = mysqli_fetch_assoc($r) ){

            echo '<tr>';
            echo '<th scope="row">' . $name . '</th>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $record['time_start'] . '</td>';
            echo '<td>' . $record['time_end'] . '</td>';
            echo '<td>' . $record['purpose'] . '</td>';
            echo '</tr>';

				}
        echo '</tbody>';
        echo '</table>';
        echo '<br>';
			}
		}
		else{
			echo '<p>No users!</p>';

		}
}
else if ($isPatient > 0) //Patient side
	{include ('header-for-Patient.php');
    $queryRecord = "SELECT r.record, r.timestamp FROM records AS r JOIN users AS u ON u.uid = r.p_uid
            WHERE u.username = '".$_SESSION['username']."';" ;

    $r = mysqli_query($link, $queryRecord);

    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">Field</th>';
    echo '<th scope="col">Record</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while( $record = mysqli_fetch_assoc($r) ){

        echo '<tr>';
        echo '<th scope="row">' . $name . '</th>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $record['time_start'] . '</td>';
        echo '<td>' . $record['time_end'] . '</td>';
        echo '<td>' . $record['purpose'] . '</td>';
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
