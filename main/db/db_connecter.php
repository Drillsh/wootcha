<?php
    // 1. 데이터베이스 시간설정
    date_default_timezone_set("Asia/Seoul");

    // 2. 데이터베이스 접속  기능부여 : 데이터베이스 생성
    $servername = "localhost";
    $username = "root";
    $password = "123456";
    $con = mysqli_connect($servername, $username, $password);
    if (!$con) {
        die("connect faild".mysqli_connect_error());
    }

    // 3. 데이터베이스 확인하기
    $database_flag = false;
    $sql = "show databases";
    $result = mysqli_query($con, $sql) or die("Error".mysqli_error($con));
    while ($row = mysqli_fetch_array($result)) {
        if($row["Database"] == "wootchatestdb"){
            $database_flag = true;
            break;
        }
    }

    // 4. 데이터베이스 없으면 생성하기
    if ($database_flag === false) {
        $sql = "create database wootchatestdb";
        $value = mysqli_query($con, $sql) or die("Error".mysqli_error($con));
        if($value === true){
            echo "<script>alert('sample DB가 생성되었습니다.');</script>";
        }
    }

    // 5. 데이터베이스 접속
    $dbcon = mysqli_select_db($con, "wootchatestdb") or die("Error".mysqli_error($con));
    if(!$dbcon){
        echo "<script>alert('wootchatestdb DB가 선택되지 않았습니다.');</script>";
    }


    // 기능성 함수
    function alert_back($message){
        echo("
			<script>
			alert('$message ');
			history.go(-1)
			</script>
            ");
            exit;
    }

    function test_input($data){
        $data = trim($data);
	    $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>