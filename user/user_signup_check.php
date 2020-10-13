<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";
    
    if (isset($_POST['mode']) && $_POST['mode'] == "email") {
        $signup_email = $_POST['value'];
        $signup_email = test_input($signup_email);

        $query = "select * from user where user_mail = '$signup_email'";
        $result = mysqli_query($con, $query) or die($error = mysqli_error($con));

        if ($result->num_rows > 0) {
            echo "중복된 이메일(ID)이 존재합니다. 다른 이메일을 사용해주세요";
        }
    }elseif (isset($_POST['mode']) && $_POST['mode'] == "nickname") {
        $signup_nickname = $_POST['value'];
        $signup_nickname = test_input($signup_nickname);

        $query = "select * from user where user_nickname = '$signup_nickname'";
        $result = mysqli_query($con, $query) or die($error = mysqli_error($con));

        if ($result->num_rows > 0) {
            echo "중복된 닉네임이 존재합니다. 다른 닉네임을 사용해주세요";
        }
    }
    
?>
