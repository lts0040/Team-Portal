<div class="msg_history" id="message-history" style="overflow:scroll">
<?php
    if(isset($_GET['user'])) {
      $_GET['user'] = $_GET['user'] ;  
    }
    else { //handling case where user is not located in address bar
      $q = 'SELECT `from_user`, `to_user` FROM `messages` WHERE `from_user` = "'.$_SESSION['username'].'" OR `to_user` = "'.$_SESSION['username'].'" ORDER BY `timestamp` DESC LIMIT 1';  

      $r = mysqli_query($link, $q);

      if($r) {
        if(mysqli_num_rows($r) > 0) {
          while($row = mysqli_fetch_assoc($r)) {
            $from_user = $row['from_user'];
            $to_user = $row['to_user'];

            if($_SESSION['username'] == $from_user) {
              $_GET['user'] = $from_user;
            }
            else {
              $_GET['user'] = $to_user; 
            }
          }
        }
        else {
          echo "No messages!";
        }
      }
      else {
        $q;
      }
    }
    $q = 'SELECT * FROM `messages` WHERE `from_user` = "'.$_SESSION['username'].'" AND to_user = "'.$_GET['user'].'"
      OR 
      `from_user` = "'.$_GET['user'].'" AND `to_user` = "'.$_SESSION['username'].'"';

      $r = mysqli_query($link, $q);

      if($r) {
        while($row = mysqli_fetch_assoc($r)) {
          $from_user = $row['from_user'];
          $to_user = $row['to_user'];
          $message = $row['message'];
          $time = strtotime($row['timestamp']);
          $format_time = date("g:i A", $time);
          $format_date = date("m/d/y", $time);

          if($from_user == $_SESSION['username']) {
            ?>

              <div class="outgoing_msg">
                  <div class="sent_msg">
                    <p><?php echo $message; ?></p>
                    <span class="time_date"> <?php echo $format_time."    |    ".$format_date ?></span> 
                  </div>
              </div>

            <?php
          }
          else {
            ?>

              <div class="incoming_msg">
                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> 
                </div>
                <div class="received_msg">
                  <div class="received_withd_msg">
                    <p><?php echo $message; ?></p>
                    <span class="time_date"> <?php echo $format_time."    |    ".$format_date ?></span> 
                  </div>
                </div>
              </div>

            <?php
          }
        }
      }
      else {
        echo $q; 
      }
  ?>
  <script>
    var elem = document.getElementById("message-history");
    elem.scrollTop = elem.scrollHeight;
  </script>
</div>
<div class="type_msg" id = "message-view-container">
  <div class="input_msg_write" id = "message-container">
    <form method="post" id="message-form">
      <input type="text" id="message-text" name="message_box" class="write_msg" placeholder="Type a message" />
      <button class="msg_send_btn" style="width: 50px; border-radius: 3px; right: 5px; top: 9px;" type="submit" name="button_send">send</button>
    </form>
  </div>
</div>
