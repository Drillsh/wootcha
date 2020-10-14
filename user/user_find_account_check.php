<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";
    $find_mode = $_POST['find_mode'];
    $find_account_name = $_POST['find_account_name'];
    $find_account_phone = $_POST['find_account_phone'];
    $find_account_name = test_input($find_account_name);
    $find_account_phone = test_input($find_account_phone);
    $find_account_name = mysqli_real_escape_string($con, $find_account_name);
    $find_account_phone = mysqli_real_escape_string($con, $find_account_phone);

    if ($find_mode == "email") {
        // 일단 지금 하던대로 하는데 휴대전화 인증 식으로 해야 보안에 좋음
        $find_account_password = $_POST['find_account_password'];
        $find_account_password = test_input($find_account_password);
        $find_account_password = mysqli_real_escape_string($con, $find_account_password);

        $query = "select * from user where user_name='$find_account_name' and user_phone='$find_account_phone' and password='$find_account_password';";
        $result = mysqli_query($con, $query) or die($error = mysqli_error($con));

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_array($result);
            $user_name = $row['user_name'];
            $user_mail = $row['user_mail'];
            // ajax request로 넘겼을 때 문자열 가장 앞에 코드 1 정상 작동한 것.
            echo "1$user_name 고객님의 이메일(ID)은 $user_mail 입니다.";
        }else{
            echo "일치하는 데이터가 존재하지 않습니다.";
        }
    }elseif ($find_mode == "password") {
        $find_account_email = $_POST['find_account_email'];
        $find_account_email = test_input($find_account_email);
        $find_account_email = mysqli_real_escape_string($con, $find_account_email);

        $query = "select * from user where user_name='{$find_account_name}'and user_phone='{$find_account_phone}' and user_mail='{$find_account_email}';";
        $result = mysqli_query($con, $query) or die($error = mysqli_error($con));

        if ($result->num_rows > 0) {
            $row = mysqli_fetch_array($result);
            $user_name = $row['user_name'];
            $password = $row['password'];
            // ajax request로 넘겼을 때 문자열 가장 앞에 코드 1 정상 작동한 것.
            echo "1$user_name 고객님의 비밀번호는 $password 입니다.";
        }else{
            echo "일치하는 데이터가 존재하지 않습니다.";
        }
    }
    
?>
