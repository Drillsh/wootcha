<div class="slideShow">
        <div class="slideShow_slides">
            <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/main/image/slide-1.jpg" alt="slide1"></a>
            <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/main/image/slide-2.jpg" alt="slide2"></a>
            <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/main/image/slide-3.jpg" alt="slide3"></a>
            <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/main/image/slide-4.jpg" alt="slide4"></a>
        </div>
        <div class="slideShow_nav">
            <a href="#" class="prev">이전</a>
            <a href="#" class="next">다음</a>
        </div>
        <div class="slideShow_indicator">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
        </div>
</div>

<!-- 총 리스트 -->
<div class="css-89vjyi-MainSection ebeya3l11">
  
  <div class="css-gxko42-StyledHomeListContainer ebeya3l2">

  </div>
</div>


<div class="main_center">
<div class="main_all">

    <span class="main_title" class="sub_title">테스트 &nbsp;:::&nbsp; BEST REVIEW LIST</span>

    <?php
      include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";
      include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/crawling/movie_cgv_crawling.php";

      $sql = "select * from review R inner join movie M on R.mv_num = M.mv_num order by review_like desc limit 5";
      $result = mysqli_query($con, $sql);
    ?>

      <div class="search_member">

    <?php
      while($row = mysqli_fetch_array($result)){
        $mv_num = $row['mv_num'];
        $review_rating = $row['review_rating'];
        $review_short = $row['review_short'];
        $mv_title = $row['mv_title'];
        $img_link = get_cgv_movie_middle_poster_url($mv_title, $con);
      ?>

            <a class="main_a_contentbox" href="#">
              <p class="summary_first">
                <img src="<?=$img_link?>">
                <!-- <div class="main_div_contentbox"> -->
                  <span class="summary_span_title"><?=$mv_num?></span>
                  <span class="summary_span_rating"><?=$review_rating?></span>
                  <span class="summary_span_short"><?=$review_short?></span>
                <!-- </div> -->
              </p>
            </a>

      <?php
          }   
      ?>

    </div>
  </div> <!-- end 배스트리스트 -->

<div class="main_all_reviewlist">

    <span class="main_title_reviewlist" class="sub_title">테스트 &nbsp;:::&nbsp; 최근 리뷰</span>

    <?php
      $sql = "select * from review R inner join movie M on R.mv_num = M.mv_num order by review_date desc";
      $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    ?>

      <div class="search_member_reviewlist">

    <?php
      while($row = mysqli_fetch_array($result)){
        $user_num = $row['user_num'];
        $mv_num = $row['mv_num'];
        $review_rating = $row['review_rating'];
        $review_short = $row['review_short'];
        $review_long = $row['review_long'];
        $mv_title = $row['mv_title'];
        $img_link = get_cgv_movie_middle_poster_url($mv_title, $con);
      ?>

            <a class="main_a_contentbox" href="#">
              <p class="summary_first_reviewlist">
                <img src="<?=$img_link?>">
                  <span class="summary_span_title_reviewlist"><?=$mv_num?></span>
                  <span class="summary_span_rating_reviewlist"><?=$review_rating?></span>
                  <span class="summary_span_user_num_reviewlist"><?=$user_num?></span>
                  <span class="summary_span_short_reviewlist"><?=$review_short?></span>
                  <span class="summary_span_long_reviewlist"><?=$review_long?></span>
              </p>
            </a>

      <?php
        }
          mysqli_close($con);
      ?>

    </div>
</div> <!-- end 무비리스트 -->
</div>



