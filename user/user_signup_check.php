<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";
    
    if (isset($_POST['mode']) && $_POST['mode'] == "email") {
        $signup_email = $_POST['value'];
        $signup_email = test_input($signup_email);
        $signup_email = mysqli_real_escape_string($con, $signup_email);

        $query = "select * from user where user_mail = '$signup_email'";
        $result = mysqli_query($con, $query) or die($error = mysqli_error($con));

        if ($result->num_rows > 0) {
            echo "중복된 이메일(ID)이 존재합니다. 다른 이메일을 사용해주세요";
        }
    }elseif (isset($_POST['mode']) && $_POST['mode'] == "nickname") {
        $signup_nickname = $_POST['value'];
        $signup_nickname = test_input($signup_nickname);
        $signup_nickname = mysqli_real_escape_string($con, $signup_nickname);

        $query = "select * from user where user_nickname = '$signup_nickname'";
        $result = mysqli_query($con, $query) or die($error = mysqli_error($con));

        if ($result->num_rows > 0) {
            echo "중복된 닉네임이 존재합니다. 다른 닉네임을 사용해주세요";
        }
    }elseif (isset($_POST['mode']) && $_POST['mode'] == "kakao") {
        $email = $_POST['email'];
    
        $email = test_input($email);
        $email = mysqli_real_escape_string($con, $email);

        // 카카오에서 전달받은 email이 없으면 회원가입 화면으로 전달
        $query = "select * from user where user_mail = '$email'";
        $result = mysqli_query($con, $query) or die($error = mysqli_error($con));

        if ($result->num_rows <= 0) {
            // 카카오 계정이 db에 없으니 회원가입으로 ~
            $result = mysqli_query($con, $query) or die($error = mysqli_error($con));

            echo "0";
        }elseif ($result->num_rows == 1) {
            // 이미 가입된 계정임
           // session으로 넣음
           $row = mysqli_fetch_array($result);
           
           session_start();
           $_SESSION["user_num"] = $row['user_num'];
           $_SESSION["user_mail"] = $row['user_mail'];
           $_SESSION["user_nickname"] = $row['user_nickname'];
           $_SESSION["user_img"] = $row['user_img'];

           echo "1";
        }
    }
    
?>
