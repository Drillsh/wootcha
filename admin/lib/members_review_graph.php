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

//리뷰 랭크 데이터 가져오기
$sql = "SELECT U.user_nickname, R.count 
        from (select user_num, count(user_num) as count from review group by user_num) as R 
        left join `user` as U 
        on R.user_num = U.user_num
        order by count desc
        limit 5;";

$user_arr = array();
$count_arr = array();
$total_arr = array();

$result = mysqli_query($con, $sql);

for($i=0; $i<5; $i++){
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);

    array_push($user_arr, $row['user_nickname']);
    array_push($count_arr, $row['count']);
}
array_push($total_arr, $user_arr);
array_push($total_arr, $count_arr);

mysqli_close($con);

echo json_encode($total_arr);


?>

