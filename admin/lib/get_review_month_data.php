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

//리뷰데이터 가져오기
$review_cnt = array();

$sql = "CALL get_day_reivew_for_one_month($y, $m)";
$result = mysqli_query($con, $sql);

for($i=0; $i<mysqli_num_rows($result); $i++){
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);
    //row0번이 일, 1번이 갯수
    $data = $row[1];
    $data = $data==NULL? 0: $data;
    array_push($review_cnt, $data);
}
mysqli_close($con);
echo json_encode($review_cnt);


?>

