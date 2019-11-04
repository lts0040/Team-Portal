<div class="chat_list">

<?php
	$q = 'SELECT DISTINCT `from_user`, `to_user`, `message`, `timestamp` FROM `messages` WHERE `from_user` = "'.$_SESSION['username'].'" OR `to_user` = "'.$_SESSION['username'].'" ORDER BY `m_uid` DESC';

	$r = mysqli_query($link, $q);

	if($r) {
		if(mysqli_num_rows($r) > 0) {
			$counter = 0;
			$added_user = array();
			while($row = mysqli_fetch_assoc($r)) {
				$from_user = $row['from_user'];
				$to_user = $row['to_user'];
				$message = $row['message'];
				$time = $row['timestamp'];

				if($_SESSION['username'] == $from_user) {
					if(in_array($to_user, $added_user)) {

					}
					else {
						?>	
							<div class="chat_people" style="border-bottom: 1px solid #cdcdcd !important; padding-top: 5px; padding-bottom: 5px;">
								<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
								<a href="?user=<?php echo $to_user ?>"
								    <span class="chat_ib">
								      <h5><?php echo $to_user ?> <span class="chat_date"><?php echo $time ?></span></h5>
								      <p><?php echo $message ?></p>
								    </span>
								</a>
							</div>
						<?php

						$added_user = array($counter => $to_user);
						$counter++;
					}
				}
				elseif($_SESSION['username'] == $to_user) {
					if(in_array($from_user, $added_user)) {

					}
					else {
						?>
							<div class="chat_people" style="border-bottom: 1px solid #cdcdcd !important; padding-top: 5px; padding-bottom: 5px;">
								<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
								<a href="?user=<?php echo $from_user ?>">
								    <span class="chat_ib">
								      <h5><?php echo $from_user ?> <span class="chat_date"><?php echo $time ?></span></h5>
								      <p><?php echo $message ?></p>
								    </span>
								</a>
							</div>
						<?php

						$added_user = array($counter => $from_user);
						$counter++;
					}
				}
			}
		}
		else {
			echo 'no messages';
		}
	}
	else {
		echo $q;
	}
?>
</div>