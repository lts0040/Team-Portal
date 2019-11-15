<?php
$page_title = "DP Portal";
session_start();
include($_SESSION['header']); 

if(!isset($_SESSION['username'])) {
  header("location:login.php");
}

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<html>
<head>

<link href="messaging.css" type="text/css" rel="stylesheet">

</head>
<!-- <button style="width: 200px;" onclick="addhtml()">Add HTML Test</button> -->
<body>
<div id="New-Message">
  <p class="Message-Header">New Message</p>
  <p class="Message-Body">
    <form align="center" method="post">
      <input type="text" list="user" class="Message-Input" placeholder="to username" name='user_name'><br><br>

      <datalist id="user"></datalist>

      <input type="text" class="Message-Input" name="subject" placeholder="subject"></input><br><br>

      <textarea class="Message-Input" name="message" style="height: 150px" placeholder="write your message"></textarea><br><br>

      <button onclick="document.getElementById('New-Message').style.display='none'">Cancel</button>

      <input type="submit" value="send" name="send"/>

    </form>
  </p>
  <p class="Message-Footer">Click send to send message</p>
</div>

<?php
  if(isset($_POST['send'])){
    $receiver_user = $_POST['user_name'];

    $q = 'SELECT uid FROM `users` WHERE `username` = "'.$receiver_user.'"';
    $r = mysqli_query($link, $q);

    if($r) {
      if(mysqli_num_rows($r) > 0) {
        $value = mysqli_fetch_object($r);
        //$to_uid = $value->uid;
        
        //$from_uid = $_SESSION['uid'];
        $from_user = $_SESSION['username'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $q = 'INSERT INTO `messages` (`from_user`, `to_user`, `timestamp`, `subject`, `message`)
              VALUES ("'.$from_user.'","'.$receiver_user.'",NOW(),"'.$subject.'","'.$message.'")';

        $r = mysqli_query($link, $q);

        if($r) {
          header("location:messaging.php?user=".$receiver_user);
        }
        else {
          echo "Message send error";
        }
      }
      else {
        echo '<p style="color:red" align="center">To username not found!</p>';
      }
    }    
  }
?>

<div class="container">
<h3 class=" text-center">Messaging</h3>
<div class="messaging">
  <div class = "Button-Container">
    <button onclick="document.getElementById('New-Message').style.display='block'" class="New-Button">New Message</button>
  </div>
    <div class="inbox_msg">
      <div class="inbox_people">
        <div class="headind_srch">
          <div class="recent_heading">
            <h4>Recent Messages</h4>
          </div>
          <div class="srch_bar">
            <div class="stylish-input-group">
              <input type="text" class="search-bar" id="search-bar" onkeyup="load_message()" placeholder="Search" >
              <span class="input-group-addon">
              <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
              </span> 
            </div>
          </div>
        </div>
        <div class="inbox_chat" id="inbox_chat">
          <?php
            require_once("message-list.php");
          ?>
        </div>
      </div>
      <div class="mesgs">
        <?php
          require_once("message-view.php");
        ?>
      </div>
    </div>   
  </div>
</div>
</body>
</html>

<?php
  if(isset($_POST['button_send'])){
    if(isset($_SESSION['username']) and isset($_GET['user'])) {
      if(isset($_POST['message_box'])) {
        if($_POST['message_box'] != '') {
          $from_user = $_SESSION['username'];
          $to_user = $_GET['user'];
          $message = $_POST['message_box'];
          $format_time = date('g:i A', strtotime('-1 hours', time()));
          $format_date = date('m/d/y', strtotime('-1 hours', time()));

          $q = 'INSERT INTO `messages` (`from_user`, `to_user`, `timestamp`, `message`)
                  VALUES ("'.$from_user.'","'.$to_user.'",NOW(),"'.$message.'")';

                $r = mysqli_query($link, $q);

                if($r) {
                  echo 'message sent';

                  $html = "<div class='outgoing_msg'><div class='sent_msg'><p>".$message."</p><span class='time_date'>".$format_time."    |    ".$format_date."</span></div></div>";

                  echo '<script type="text/javascript">
                          var New_html =  $("div.msg_history").html();

                          New_html = New_html.concat("'.$html.'");

                          $("div.msg_history").html(New_html);
                        </script>';
                }
                else {
                  echo $q;
                }
        }
        else {
          echo 'Message box is empty';
        }
      }
      else {
        echo 'Message box is empty';
      }
    }
    else {
      echo 'Login or select a user to send message to';
    }
  }
?>

<script src="libs/jquery-3.4.1.min.js"></script>
  <script>
    function load_message(){
      var search = document.getElementById("search-bar").value;

      if (search) {
        $.post("funcs/message-check.php",
        {
          search: search
        },

        function(data, status){
          $("div.chat_list").html(data);
        }
        );  
      } 
    }

   /* function addhtml() { //testing adding message to message view after POST
      var Nhtml = $("div.msg_history").html();

      Nhtml = Nhtml.concat("<div class='outgoing_msg'><div class='sent_msg'><p>'.$message.'</p><span class='time_date'>'.$format_time.'    |    '.$format_date.'</span></div></div>");

      alert(Nhtml);

      $("div.msg_history").html(Nhtml);
    }*/
  </script>

<?php include('footer.php'); ?>