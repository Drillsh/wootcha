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

    
    

    // mysqli_query($con, "insert into user values(null, );") or die(mysqli_error($con));


?>
<script>
alert($signup_email,$signup_password,$signup_name,$signup_email,$signup_nickname,$signup_birth_day,$signup_email);
</script>