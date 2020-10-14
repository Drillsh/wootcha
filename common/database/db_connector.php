<?php
// 시간 설정
date_default_timezone_set("Asia/Seoul");

$serverName = "jbstv.synology.me:3307";
$db_userName = "wootchadb";
$db_password = "Yongho123!";
$db_name = "wootchadb";
$db_flag = false;

//DB 접속
$con = mysqli_connect($serverName, $db_userName, $db_password);
if (!$con) {
    die("DB Connection Filed: " . mysqli_connect_error());
}

//wootchadb 존재 여부 확인
$sql = "show databases";
$result = mysqli_query($con, $sql) or die("DB not exist" . mysqli_error($con));
while ($row = mysqli_fetch_array($result)) {
    if ($row["Database"] == "wootchadb") {
        $db_flag = true;
        break;
    }
}

//wootchadb 없을 경우 생성
if ($db_flag === false) {
    $sql = "create database ". $db_name;
    $value = mysqli_query($con, $sql) or die("create Error" . mysqli_error($con));
    if ($value === true) {
        echo "<script> alert('wootchadb가 생성되었습니다');</script>";
    }
}

//DB 선택하기
$dbCon = mysqli_select_db($con, $db_name) or die("select Error" . mysqli_error($con));
if (!$dbCon) {
    echo "<script> alert('DB가 선택되었습니다');</script>";
}

include_once 'create_procedure.php';
$prcd_name = array('get_join_g_members', 'get_wthdr_g_members', 'get_wthdr_a_members', 'get_day_reivew_for_one_month');
for($i=0; $i<sizeof($prcd_name); $i++){
    create_procedure($con, $prcd_name[$i]);
}

//alert 메시지와 함께 이전 페이지로 돌아가는 함수
function alert_back($message){
    echo("
        <script>
        alert('$message');
        history.go(-1);
        </script>
        ");
    exit;
}

//데이터를 가공하는 함수
function test_input($data) {
    $data = trim($data); //문자열 앞, 뒤 공백제거
    $data = stripslashes($data); //'\'제거
    $data = htmlspecialchars($data); // injection보안, &, ', ", <, > 변환
    return $data;
}
