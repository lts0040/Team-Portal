<?php
	session_start();
	include('../config.php');
	if(isset($_POST['search']) && isset($_SESSION['username'])) {

		$q = 'SELECT DISTINCT `from_user`, `to_user`, `message`, `timestamp` FROM `messages` WHERE ((`from_user` like "'.$_POST['search'].'%" OR `to_user` like "'.$_POST['search'].'%") AND (`to_user` = "'.$_SESSION['username'].'" OR `from_user` = "'.$_SESSION['username'].'"))
			  OR (`message` like "%'.$_POST['search'].'%" AND (`from_user` = "'.$_SESSION['username'].'" OR `to_user` = "'.$_SESSION['username'].'")) ORDER BY `m_uid` DESC';
		$r = mysqli_query($link, $q);
		if($r){
			if(mysqli_num_rows($r) > 0) {
				$counter = 0;
				$added_user = array();
				$html = "";
				while($row = mysqli_fetch_assoc($r)) {
					$from_user = $row['from_user'];
					$to_user = $row['to_user'];
					$message = $row['message'];
					$time = $row['timestamp'];

					if($_SESSION['username'] == $from_user) {
						if(in_array($to_user, $added_user)) {

						}
						else {	
								$html .= '<div class="chat_people" style="border-bottom: 1px solid #cdcdcd !important; padding-top: 5px; padding-bottom: 5px;">
									<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
									<a href="?user='.$to_user.'">
									    <span class="chat_ib">
									      <h5>'.$to_user.'<span class="chat_date">'.$time.'</span></h5>
									      <p>'.$message.'</p>
									      <p>poop</p>
									    </span>
									</a>
								</div>';

							$added_user = array($counter => $to_user);
							$counter++;
						}
					}
					elseif($_SESSION['username'] == $to_user) {
						if(in_array($from_user, $added_user)) {

						}
						else {
								$html .= '<div class="chat_people" style="border-bottom: 1px solid #cdcdcd !important; padding-top: 5px; padding-bottom: 5px;">
									<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
									<a href="?user='.$from_user.'"">
									    <span class="chat_ib">
									      <h5>'.$from_user.' <span class="chat_date">'.$time.'</span></h5>
									      <p>'.$message.'</p>
									      <p>poop</p>
									    </span>
									</a>
								</div>';

							$added_user = array($counter => $from_user);
							$counter++;
						}
					}
				}
				echo $html;
			}
			else {
				echo 'No messages found ';
			}
		}
		else {
			echo $q;
		}
	}
	else {
		echo 'Error';
	}
?>