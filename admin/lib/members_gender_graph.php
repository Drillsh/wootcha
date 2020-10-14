<?php
$y   = $_POST['y'];
$m   = $_POST['m'];

include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";
if($m<10){
    $m = "0".$m;
}

//연결실패 에러점검
if(!mysqli_affected_rows($con)){
    mysqli_close($con);
    echo ('Could not update data - ' . mysqli_error($con));
}

//남녀 비율 데이터 가져오기
$sql = "SELECT 
        SUM(user_gender = 0) AS male,
        SUM(user_gender = 1) AS female
        FROM
        `user`
        WHERE
        user_signup_day BETWEEN '$y-$m-01' AND LAST_DAY('$y-$m-01');";

$total_arr = array();

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

array_push($total_arr, $row['male']);
array_push($total_arr, $row['female']);

mysqli_close($con);

echo json_encode($total_arr);

?>

