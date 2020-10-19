<?php
  session_start();
  unset($_SESSION["user_mail"]);
  unset($_SESSION["user_nickname"]);
  unset($_SESSION["user_num"]);
  unset($_SESSION["user_img"]);
  unset($_SESSION["admin"]);
  unset($_SESSION["admin_img"]);
  
  echo("
       <script>
          alert('로그아웃 되었습니다.');
          location.href = '../index.php';
         </script>
       ");
?>
