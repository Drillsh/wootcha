<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";

    // 관리자 아이디, 비밀번호 선언
    define('ADMIN_ID', "admin");
    define('ADMIN_PW', "admin123!");

    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];

    $login_password = test_input($login_password);
    $login_password = mysqli_real_escape_string($con, $login_password);

    $login_email = test_input($login_email);
    $login_email = mysqli_real_escape_string($con, $login_email);

    // 관리자 아이디, 비밀번호 입력시 관리자 페이지 이동
    if ($login_email == ADMIN_ID && $login_password == ADMIN_PW) {
        session_start();
        $_SESSION["admin"] = "admin";
        $_SESSION["admin_img"] = "admin.png";
        header('Location: /wootcha/admin/admin_index.php');
    }

    $login_password = openssl_encrypt($login_password, 'aes-256-cbc', 'wootchacha', true, str_repeat(chr(0), 16));

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
