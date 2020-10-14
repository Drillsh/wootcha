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
        $kakao_email_login = $_POST['kakao_email_login'];
        $kakao_nickname_login = $_POST['kakao_nickname_login'];
        $kakao_img_login = $_POST['kakao_img_login'];

        $kakao_email_login = test_input($kakao_email_login);
        $kakao_email_login = mysqli_real_escape_string($con, $kakao_email_login);

        $query = "select * from user where user_mail = '$kakao_email_login'";
        $result = mysqli_query($con, $query) or die($error = mysqli_error($con));

        if ($result->num_rows <= 0) {
            // 카카오 계정이 db에 없으니 회원가입으로 ~
            



        }elseif ($result->num_rows == 1) {
           // session으로 넣음



        }

        $signup_nickname = test_input($signup_nickname);
        $signup_nickname = mysqli_real_escape_string($con, $signup_nickname);

        $query = "select * from user where user_nickname = '$signup_nickname'";
        $result = mysqli_query($con, $query) or die($error = mysqli_error($con));

        if ($result->num_rows > 0) {
            echo "중복된 닉네임이 존재합니다. 다른 닉네임을 사용해주세요";
        }
    }
    
?>
