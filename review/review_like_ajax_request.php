<?php
    $review_num = $_POST['review_num'];

    session_start();
    if(isset($_SESSION['user_num'])){
        $user_num = $_SESSION['user_num'];
    }else{
        $url = "http://".$_SERVER['HTTP_HOST']."/wootcha/index.php";
        echo "<script>alert('로그인 후 이용하세요.');
        location.href = '$url';</script>";
        exit;
    }
    

    // 먼저 review_like 테이블에서 insert 한게 있는지 확인
    include_once "../common/database/db_connector.php";
    $query = "select * from review_like where review_num = $review_num and user_num = $user_num";
    $result = mysqli_query($con, $query);
    
    // insert 된 데이터가 없을 때
    if ($result->num_rows == 0) {
        $query = "insert into review_like values($review_num, $user_num, 1);";

    // insert 데이터 있을 때
    }elseif ($result->num_rows == 1) {
        $row = mysqli_fetch_array($result);
        
        // select 한 데이터가 0 이냐 1이냐
        if ($row['like_state'] == 0) {
            $query = "update review_like set like_state = 1 where review_num = $review_num and user_num = $user_num;";
        }elseif ($row['like_state'] == 1) {
            $query = "update review_like set like_state = 0 where review_num = $review_num and user_num = $user_num;";
        }
    }
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    
    // 수정 및 삽입 후 해당 리뷰의 total 좋아요를 가져옴
    $result = mysqli_query($con, "select review_like from review where review_num=$review_num") or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);
    $review_like = $row['review_like'];

    // 반납
    mysqli_close($con);
    
    echo "<p>$review_like</p>";
?>