<?php
include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";
include $_SERVER['DOCUMENT_ROOT']."/wootcha/mypage/mypage_db_helper.php";

$userpage_user_num = $_GET["user_num"]; // 주의
$count = $_GET["count"]; // 주의

// 좋아하는 영화 리스트
// 좋아하는 영화 리스트
$sql = "select F.fav_num, F.mv_num, M.mv_title, M.mv_img_path from fav_movie F 
inner join movie M 
on F.mv_num = M.mv_num 
where F.user_num = $userpage_user_num order by F.fav_num DESC limit " . $count . "," . 8;
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

if($result->num_rows >= 1){
    for($i = $count; $i < $result->num_rows + $count; $i++){ 
        mysqli_data_seek($result,$i);
        $row_review = mysqli_fetch_array($result);
        $fav_num = $row_review['fav_num'];
        $mv_num = $row_review['mv_num'];
        $mv_title = $row_review['mv_title'];
        $mv_img_path = $row_review['mv_img_path'];

        echo "<li class='list_item'>
            <a href='/wootcha/movie_introduce_page/movie_introduce_index.php?mv_num= $mv_num'>
                <img src=' $mv_img_path ' alt=''>
                <h3>$mv_title</h3>
            </a>
        </li>";

                        // while문 끝
                        }
                    }
                    ?>