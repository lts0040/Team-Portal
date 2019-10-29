<?php

$page_title = "DP Portal";

include('header.php'); 
include('config.php');
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<html>
<head>

<link href="messaging.css" type="text/css" rel="stylesheet">

</head>
<body>
<div id="New-Message">
  <p class="Message-Header">New message</p>
  <p class="Message-Body">
    <form align="center" method="post">
      <input type="text" list="user" class="Message-Input" placeholder="username" name='username'><br><br>
      <datalist id="user"></datalist>

      <textarea class="Message-Input" style="height: 150px" placeholder="write your message"></textarea><br><br>
      <button onclick="document.getElementById('New-Message').style.display='none'">Cancel</button>
      <input type="submit" value="send" name="send"/>
    </form>
  </p>
  <p class="Message-Footer">Click send to send message</p>
</div>
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
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>
          </div>
          <div class="inbox_chat">
            <?php
              require_once("message-list.php");
            ?>
          </div>
        </div>
        <div class="mesgs">
          <?php
              require_once("message-view.php");
            ?>
          <div class="type_msg">
            <div class="input_msg_write">
              <input type="text" class="write_msg" placeholder="Type a message" />
              <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>
      </div>
      
    </div></div>
    </body>
    </html>

<?php include('footer.php'); ?>