<?php
session_start();
$page_title = "DP Portal";

include ($_SESSION['header']);

if ($_SESSION['header'] == 'header-for-Dr.php')
	{ 
        $sql = "SELECT * FROM users WHERE user_auth LIKE '%" . '"' . $_SESSION['username'] . '"' . "%';";
		$result = mysqli_query($link, $sql);
		$resultCheck = mysqli_num_rows($result);
		
		if($resultCheck > 0){
			echo " <h2 style=\"text-align:center\" >Patient Records </h2>" ;
			
			while( $row = mysqli_fetch_assoc($result) ){
				
				$queryRecord = "SELECT record, d_username, timestamp FROM records WHERE p_username = '".$row['username']."' ORDER BY p_username ASC, timestamp DESC;" ;
				
				$r = mysqli_query($link, $queryRecord);

                if($r) {
                    if ($r->num_rows != 0) {
        				echo "<h3>Records for: " . $row['username'] . "</h3>";
                        while( $record = mysqli_fetch_assoc($r) ){
                            echo "<h3>Doctor: " . $record['d_username'] . "</h3>";
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
                    else { 
                    } 
                }
				
			}
		}
		else{
			echo '<p>No users found!</p>';
            
		}
}
else if ($_SESSION['header'] == 'header-for-Patient.php')
	{
    $queryRecord = "SELECT record, d_username, timestamp FROM records WHERE p_username = '".$_SESSION['username']."' ORDER BY timestamp DESC;" ;
				
    $r = mysqli_query($link, $queryRecord);
    
    if ($r) {
        if ($r->num_rows != 0) {
            while( $record = mysqli_fetch_assoc($r) ){
                echo "<h3>Date: " . $record['timestamp'] . "</h3>";
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
        else {
            echo '<h1>No records found!</h1>';
        }
    }
}
else
	{
    echo "<p>Need to login in order to view records!</p>";
}

include ('footer.php');
?>