<script src=""></script>
<script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/mypage/js/mypage_nav_follow.js"></script>
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
    $same_user_flag = false;
    // 세션의 user_num과 get으로 받은 user_num이 같으면 마이 페이지
    $userpage_user_num = $_GET['userpage_user_num'];
    // 같을 경우
    if ($userpage_user_num == $user_num) {
        $title_sub = "마이";
        $title_main = "내가";
        $write_review_user_num = $user_num;
        $img = $user_img;
        $nickname = $user_nickname;
        $same_user_flag = true;
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
        $same_user_flag = false;
    }

    // 네비게이션 바 session과 다를 때는 내정보 수정 안나오게 


?>

<div class="profile_img_box">
    <?php
        // 선택 이미지의 파일명이 22자리, api 이미지는 22자리 이상
        if (strlen($img) > 22) {
            echo "<img src='$img' alt='프로필 이미지'>";
        }else{
    ?>
            <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/user/img/<?=$img?>" alt="프로필 이미지">
    <?php
        }
    ?>
    
</div>
<!-- 닉네임 -->
<h3><?=$nickname?> 님</h3>
<div class="follow_box">
<?php
    // 해당 유저를 session의 user_num이 팔로우를 하는가
    $sql = "select * from user_follow where user_num = $user_num and follow_user_num = $userpage_user_num;";
    $result_follow = mysqli_query($con, $sql);
    
    // 해당 유저 페이지의 총 팔로워의 수
    $sql = "select * from user_follow where follow_user_num = $userpage_user_num;";
    $result_follow_user = mysqli_query($con, $sql);

    // 각 리뷰별 session의 user가 좋아요를 눌렀었는지 조회한 데이터를 기준으로 icon 변경
    if ($userpage_user_num != $user_num) {
        if ($result_follow->num_rows == 1) {
            $follow_img = "follow_color";
            $follow_checked = "checked";
        }else{
            $follow_img = "follow";
            $follow_checked = "";
        }
    }else{
        $follow_img = "follow_color";
        $follow_checked = "";
    }

    // if ($same_user_flag != true) {
?>
    <form id="follow_form" action="./mypage_follow_d_m_i.php" method="post">
        <input type="hidden" name="follow_user_num" id="follow_user_num" value="<?=$_GET['userpage_user_num']?>">
        <input type="checkbox" id="follow_checkbox" <?=$follow_checked?>>
        <label for="follow_checkbox">
            <img src="./img/<?=$follow_img?>.png" alt="" class="follow_ckeckbox_class">
            <span id="follow_checkbox_label">
                <p><?=$result_follow_user->num_rows?>명</p>
            </span>
        </label>
    </form>
<?php
    // }
    $weightTag_1=$weightTag_2=$weightTag_3=$weightTag_4=$weightTag_5=$weightTag_6=$weightTag_7=$weightTag_8= "";
        // 현재 페이지에 따라서 글씨 굵기 변경
        switch ($now_page_name) {
            case 'review':
                $weightTag_1 = "<h4>";
                $weightTag_2 = "</h4>";
                break;
            case 'like':
                $weightTag_3 = "<h4>";
                $weightTag_4 = "</h4>";
                break;
            case 'follow':
                $weightTag_5 = "<h4>";
                $weightTag_6 = "</h4>";
                break;
            case 'myinfo':
                $weightTag_7 = "<h4>";
                $weightTag_8 = "</h4>";
                
                break;
            default:
                # code...
                break;
        }


?>
        
</div>
<ul>
    <li><?=$weightTag_1?><a href="./mypage_index.php?userpage_user_num=<?=$userpage_user_num?>">작성한 리뷰</a><?=$weightTag_2?></li>
    <li><?=$weightTag_3?><a href="./mypage_like_movie.php?userpage_user_num=<?=$userpage_user_num?>">좋아요</a><?=$weightTag_4?></li>
    <li><?=$weightTag_5?><a href="./mypage_follow.php?userpage_user_num=<?=$userpage_user_num?>">팔로잉</a><?=$weightTag_6?></li>
<?php
    if ($userpage_user_num == $user_num) echo "<li>$weightTag_7<a href='./mypage_edit_myinfo.php?userpage_user_num=$userpage_user_num'>내 정보</a>$weightTag_8</li>";
?>
  
</ul>
<a href="#" id="btn_top"><img src="../common/img/page_up.png" alt=""></a>

<script>
    //  페이지 상단으로 올리기
    $(function() {
      $(window).scroll(function() {
          if ($(this).scrollTop() > 200) {
              $('#btn_top').fadeIn();
          } else {
              $('#btn_top').fadeOut();
          }
      });
      
      $("#btn_top").click(function() {
          $('html, body').animate({
              scrollTop : 0
          }, 400);
          return false;
      });
  });

</script>