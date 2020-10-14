<?
include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";

$password = $_POST["ps"];
$password = test_input($password);
$password = mysqli_real_escape_string($con, $password);

session_start();
$user_num = $_SESSION["user_num"];

$sql = "select * from user where user_num = $user_num and password= '$password' ";

$result = mysqli_query($con, $sql) or die($errorText = mysqli_error($con));

if ($result->num_rows == 1) {
    $sql = "delete from user where user_num = $user_num";
    $result = mysqli_query($con, $sql);
    if ($result == true) {
        echo "회원 탈퇴를 성공했습니다.";
        
        // 세션 지우기
        unset($_SESSION["user_mail"]);
        unset($_SESSION["user_nickname"]);
        unset($_SESSION["user_num"]);
        unset($_SESSION["user_img"]);
    }
}else{
    echo "비밀번호가 일치하지 않습니다.";
}
mysqli_close($con);

// mysql 날짜만 쿼리로 등록해서 트리서 만들면 됨

