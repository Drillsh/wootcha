<?php
include_once "../common/database/db_connector.php";
include_once "./mypage_db_helper.php";
include_once "../common/crawling/movie_cgv_crawling.php";
                    
    // 로그인 후 이용 방지
    if(!isset($_SESSION['user_mail'])){
        mysqli_close($con);
        echo "<script>alert('잘못된 접근입니다. 로그인 후 이용하세요.');
        history.go(-1);</script>";
        exit;
    }
    
    // 세션의 user_num과 get으로 받은 user_num이 같으면 마이 페이지
    $userpage_user_num = $_GET['userpage_user_num'];
    // 같을 경우
    if ($userpage_user_num == $user_num) {
        $title_sub = "마이";
        $title_main = "내가";
        $write_review_user_num = $user_num;
        $img = $user_img;
        $nickname = $user_nickname;
    // 다를 경우 = userpage_user_num으로 넘어온 user의 페이지
    }else{
        $result = mysqli_query($con, "select user_nickname, user_img from user where user_num = $userpage_user_num;");
        
        // get 방식으로 db에 없는 값으로 접근했을 때
        if ($result->num_rows == 0) {
            mysqli_close($con);
            echo "<script>alert('잘못된 접근입니다.');
            history.go(-1);</script>";
            exit;
        }else{
            $userpage_rows = mysqli_fetch_array($result);
            $userpage_user_nickname = $userpage_rows['user_nickname'];
            $userpage_user_img = $userpage_rows['user_img'];
            // 리뷰목록 select에 사용할 user_num
            $write_review_user_num = $userpage_user_num;
            $img = $userpage_user_img;
            $nickname = $userpage_user_nickname;
        }
        $title_sub = "유저";
        $title_main = $userpage_user_nickname." 님이";
    }

    // 네비게이션 바 session과 다를 때는 내정보 수정 안나오게 


?>

<div class="profile_img_box">
    <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/user/img/<?=$img?>" alt="프로필 이미지">
</div>
<!-- 닉네임 -->
<h3><?=$nickname?> 님</h3>
<ul>
    <li><a href="./mypage_index.php?userpage_user_num=<?=$userpage_user_num?>">작성한 리뷰</a></li>
    <li><a href="./mypage_like_movie.php?userpage_user_num=<?=$userpage_user_num?>">좋아요</a></li>
    <li><a href="./mypage_follow.php?userpage_user_num=<?=$userpage_user_num?>">팔로우</a></li>
<?php
    if ($userpage_user_num == $user_num) echo "<li><a href='./mypage_edit_myinfo.php?userpage_user_num=$userpage_user_num'>내 정보</a></li>";
?>
  
</ul>
