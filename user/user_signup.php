<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";
    
    $signup_email = $_POST['signup_email'];
    $signup_password = $_POST['signup_password'];
    $signup_name = $_POST['signup_name'];
    $signup_nickname = $_POST['signup_nickname'];
    $signup_birth_day = $_POST['signup_birth_day'];
    $gender = $_POST['gender'];
    $signup_phone = $_POST['signup_phone'];
    $avatar = $_POST['avatar'];

    $signup_email = test_input($signup_email);
    $signup_password = test_input($signup_password);
    $signup_name = test_input($signup_name);
    $signup_nickname = test_input($signup_nickname);
    $signup_birth_day = test_input($signup_birth_day);
    $gender = test_input($gender);
    $signup_phone = test_input($signup_phone);
    $avatar = test_input($avatar);
    $regist_day = date("Y-m-d (H:i)");

    //비밀번호 암호화
    $signup_password = openssl_encrypt($signup_password, 'aes-256-cbc', 'wootchacha', true, str_repeat(chr(0), 16));

    $query = "insert into user values
        (null,'$signup_email','$signup_password','$signup_name','$signup_nickname','$avatar','$signup_birth_day',$gender,'$signup_phone','$regist_day');";
    $result = mysqli_query($con, $query) or die($error = mysqli_error($con));

    if($result == true){
        mysqli_close($con);
        echo "<script>alert('회원가입을 성공했습니다.');
        location.href = 'http://".$_SERVER['HTTP_HOST']."/wootcha/index.php';</script>";
    }else{
        mysqli_close($con);
        echo "<script>alert('회원가입을 실패했습니다. : $error');
        history.go(-1);</script>"; 
    }
    
?>
