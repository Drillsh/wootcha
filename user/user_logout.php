<?php
  session_start();
  unset($_SESSION["user_mail"]);
  unset($_SESSION["user_nickname"]);
  unset($_SESSION["user_num"]);
  unset($_SESSION["user_img"]);
  
  echo("
       <script>
          location.href = '../index.php';
         </script>
       ");
?>
