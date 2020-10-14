<?php

$y   = $_POST['y'];
$m   = $_POST['m'];
$mode   = $_POST['mode'];

include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";
if($m<10){
    $m = "0".$m;
}

//연결실패 에러점검
if(!mysqli_affected_rows($con)){
    mysqli_close($con);
    echo ('Could not update data - ' . mysqli_error($con));
}

//나이데이터 가져오기
$sql = "SELECT 
        SUM(IF(FLOOR( (CAST(REPLACE(NOW(),'-','') AS UNSIGNED) -
               CAST(REPLACE(user_age,'-','') AS UNSIGNED)) / 10000 ) BETWEEN 0 AND 19,
            1,
            0)) AS teen,
        SUM(IF(FLOOR( (CAST(REPLACE(NOW(),'-','') AS UNSIGNED) -
               CAST(REPLACE(user_age,'-','') AS UNSIGNED)) / 10000 ) BETWEEN 20 AND 29,
            1,
            0)) AS twenty,
        SUM(IF(FLOOR( (CAST(REPLACE(NOW(),'-','') AS UNSIGNED) -
               CAST(REPLACE(user_age,'-','') AS UNSIGNED)) / 10000 ) BETWEEN 30 AND 39,
            1,
            0)) AS thirty,
        SUM(IF(FLOOR( (CAST(REPLACE(NOW(),'-','') AS UNSIGNED) -
               CAST(REPLACE(user_age,'-','') AS UNSIGNED)) / 10000 ) BETWEEN 40 AND 49,
            1,
            0)) AS forty,
        SUM(IF(FLOOR( (CAST(REPLACE(NOW(),'-','') AS UNSIGNED) -
               CAST(REPLACE(user_age,'-','') AS UNSIGNED)) / 10000 ) BETWEEN 50 AND 200,
            1,
            0)) AS senior
        FROM
        `user`
        WHERE
        user_signup_day BETWEEN '$y-$m-01' AND LAST_DAY('$y-$m-01');";

$total_arr = array();

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

array_push($total_arr, $row['teen']);
array_push($total_arr, $row['twenty']);
array_push($total_arr, $row['thirty']);
array_push($total_arr, $row['forty']);
array_push($total_arr, $row['senior']);

mysqli_close($con);

echo json_encode($total_arr);

?>

