<?
include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";

$modify_password = $_POST["modify_password"];
$modify_phone = $_POST["modify_phone"];
$user_avatar = $_POST["user_avatar"];

session_start();
$user_num = $_SESSION["user_num"];

$sql = "update user set password='$modify_password', user_phone='$modify_phone', user_img='$user_avatar' ";
$sql .= " where user_num= $user_num ;";

$result = mysqli_query($con, $sql) or die($errorText = mysqli_error($con));
if ($result === true) {
    $_SESSION["user_img"] = $user_avatar;

    mysqli_close($con);

    echo "
    <script>
    alert('성공적으로 수정 되었습니다.');
        location.href = '../mypage/mypage_edit_myinfo.php';
    </script>
    ";
}else{
    mysqli_close($con);

    echo "
    <script>
    alert('수정 실패 Error : $errorText');
        history.go(-1);
    </script>
    ";
}




