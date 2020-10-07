<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";
    
    // 값은 잘 넘어옴
    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];

    $sql = "select * from user where user_mail='$login_email'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        
    // 이 문장 사용하면 오류도 안나고 이 뒤로 진행되지 않음
    // $num_match = mysqli_num_rows($result) or die(mysqli_error($con));
    // 그래서 $result->num_rows 사용함

    if(!$result->num_rows){
     echo("
           <script>
             window.alert('등록되지 않은 계정입니다!')
             history.go(-1);
             document.trigger_user_login.click();
           </script>
         ");
    }else{
        $row = mysqli_fetch_array($result);
        $db_pass = $row["password"];

        mysqli_close($con);

        if($login_password != $db_pass){
           echo("
              <script>
                window.alert('비밀번호가 틀립니다!');
                history.go(-1);
              </script>
           ");
           exit;
        }else{
            session_start();
            $_SESSION["user_mail"] = $row["user_mail"];
            $_SESSION["user_nickname"] = $row["user_nickname"];
            $_SESSION["user_num"] = $row["user_num"];
            $_SESSION["user_img"] = $row["user_img"];

            echo("
              <script>
                location.href = '../index.php';
              </script>
            ");
        }
     }        
?>
