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
				
				$queryRecord = "SELECT m.med_amount, m.med_name, m.med_time FROM medications AS m JOIN users AS u ON u.uid = m.p_uid 
									WHERE u.username = '".$row['username']."';" ;
				
				$r = mysqli_query($link, $queryRecord);
				echo "<h3>Medication for: " . $row['username'] . "</h3>";
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">Medication</th>';
                echo '<th scope="col">Amount</th>';
                echo '<th scope="col">Time</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                    
				while( $record = mysqli_fetch_assoc($r) ){
                    echo '<tr>';
                    echo '<th scope="row">' . $record['med_name'] . '</th>';
                    echo '<td>' . $record['med_amount'] . '</td>';
                    echo '<td>' . $record['med_time'] . '</td>';
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
else if ($isPatient > 0)
	{include ('header-for-Patient.php'); 
    $queryRecord = "SELECT m.med_amount, m.med_name, m.med_time FROM medications AS m JOIN users AS u ON u.uid = m.p_uid 
									WHERE u.username = '".$_SESSION['username']."';" ;
				
    $r = mysqli_query($link, $queryRecord);
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">Medication</th>';
    echo '<th scope="col">Amount</th>';
    echo '<th scope="col">Time</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
        
    while( $record = mysqli_fetch_assoc($r) ){
        echo '<tr>';
        echo '<th scope="row">' . $record['med_name'] . '</th>';
        echo '<td>' . $record['med_amount'] . '</td>';
        echo '<td>' . $record['med_time'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '<br>';
}
else
	{include ('header.php');
    echo "<p>Need to login in order to view medications!</p>";
}

include ('footer.php');
?>