<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";
    
    session_start();
    $user_num = $_SESSION['user_num'];

    // POST 방식으로 data 받음
    $follow_user_num = $_POST['follow_user_num'];
    if ($user_num != $follow_user_num) {
        if (isset($_POST['checked'])) {
            $check_flag = $_POST['checked'];
        }else{
            $check_flag = "";
        }
        if ($check_flag == "check") {
            $query = "insert into user_follow values(null, $user_num, $follow_user_num);";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
        }else{
            $query = "delete from user_follow where user_num= $user_num and follow_user_num= $follow_user_num";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));
        }
        $query = "select * from user_follow where follow_user_num= $follow_user_num;";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
    
        echo "<p>$result->num_rows 명</p>";
        mysqli_close($con);
    }else{
        exit; 
        return false;
        mysqli_close($con);
    }
?>

