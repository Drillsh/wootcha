<?php
if (isset($_GET["link"])){
$link = $_GET['link'];

} else {
    $link = "";
}
$movie_detail = crawl_movie_detail($link);
?>


<table id="movie_introduce_container">
<img src="./img/flim.png" id="side_picture_left">
<img src="./img/flim.png" id="side_picture_right">
<ul class="slides">
    <input type="radio" name="radio-btn" id="img-1" checked />
    <li class="slide-container">
        <div class="slide">
            <img src="http://farm9.staticflickr.com/8072/8346734966_f9cd7d0941_z.jpg" />
        </div>
        <div class="nav">
            <label for="img-6" class="prev">&#x2039;</label>
            <label for="img-2" class="next">&#x203a;</label>
        </div>
    </li>

    <input type="radio" name="radio-btn" id="img-2" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8504/8365873811_d32571df3d_z.jpg" />
        </div>
        <div class="nav">
            <label for="img-1" class="prev">&#x2039;</label>
            <label for="img-3" class="next">&#x203a;</label>
        </div>
    </li>

    <input type="radio" name="radio-btn" id="img-3" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8068/8250438572_d1a5917072_z.jpg" />
        </div>
        <div class="nav">
            <label for="img-2" class="prev">&#x2039;</label>
            <label for="img-4" class="next">&#x203a;</label>
        </div>
    </li>

    <input type="radio" name="radio-btn" id="img-4" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8061/8237246833_54d8fa37f0_z.jpg" />
        </div>
        <div class="nav">
            <label for="img-3" class="prev">&#x2039;</label>
            <label for="img-5" class="next">&#x203a;</label>
        </div>
    </li>

    <input type="radio" name="radio-btn" id="img-5" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8055/8098750623_66292a35c0_z.jpg" />
        </div>
        <div class="nav">
            <label for="img-4" class="prev">&#x2039;</label>
            <label for="img-6" class="next">&#x203a;</label>
        </div>
    </li>

    <input type="radio" name="radio-btn" id="img-6" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8195/8098750703_797e102da2_z.jpg" />
        </div>
        <div class="nav">
            <label for="img-5" class="prev">&#x2039;</label>
            <label for="img-1" class="next">&#x203a;</label>
        </div>
    </li>

    <li class="nav-dots">
      <label for="img-1" class="nav-dot" id="img-dot-1"></label>
      <label for="img-2" class="nav-dot" id="img-dot-2"></label>
      <label for="img-3" class="nav-dot" id="img-dot-3"></label>
      <label for="img-4" class="nav-dot" id="img-dot-4"></label>
      <label for="img-5" class="nav-dot" id="img-dot-5"></label>
      <label for="img-6" class="nav-dot" id="img-dot-6"></label>
    </li>
</ul>
<div id="movie_introduce">
<div id="movie_poster" onclick="window.open('./img/black_widow.jpg','poster','width=600, height=800, scrollbars=yes, top=2000, left=-1000');"><br><br><h2>영화 포스터</h2></div>
    <div id="movie_subject"><br><br><h2>영화 제목란</h2></div>

<span><button type=button id="favorite_movie"><img src="./img/good_before.png"></span>
<span><button type=button id="playlist_movie"><img src="./img/add_button.jpg"></span>
<div id="movie_smail_introduce">
    <h1>
        <br>
        <?php
        print_r (implode($movie_detail['movie_info']));
        ?>
    </h1>
</div>
<div id="movie_score">
    <br>
    <h2>평점 박스</h2>

<!--
    
        $sql = "select review_rating from review where review_num='$review_num'";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        $total_record = mysqli_num_rows($result);

        $row = mysqli_fetch_array($result);

        $review_rating = $row["review_rating"];


 -->

</div>

    <div id="movie_content">
        <h1>

    <?php 
    if (isset($movie_detail["movie_story"])) {
        print_r($movie_detail['movie_story']);
    } else {
        $movie_detail="";
    };
    ?>

    </h1>  
    </div>

<div id="movie_casting_container">
<br>
<h2>영화 출연진 목록</h2>

<div id="movie_cast_1"><?php print_r($movie_detail['movie_actor'][0]);?></div>
<div id="movie_cast_2"><?php print_r($movie_detail['movie_actor'][1]);?></div>
<div id="movie_cast_3"><?php print_r($movie_detail['movie_actor'][2]);?></div>
<div id="movie_cast_4"><?php print_r($movie_detail['movie_actor'][3]);?></div>
<div id="movie_cast_5"><?php print_r($movie_detail['movie_actor'][4]);?></div>
<div id="movie_cast_6"><?php print_r($movie_detail['movie_actor'][5]);?></div>
<span><input type=button id="movie_casting_prev" value="<"></span>
<span><input type=button id="movie_casting_next" value=">"></span>
</div>

<div id="movie_comment_container">

<div class="user_comment_title">
                <span>게스트 후기</span>

                <p class="star_rating">
                    <a href="#" class="on">★</a>
                    <a href="#" class="on">★</a>
                    <a href="#" class="on">★</a>
                    <a href="#">★</a>
                    <a href="#">★</a>
                </p>
            </div>

            <div id="movie_comment_box">
            
            <?php
                define('SCALE', 10);

                 // 넘어온 get방식에 키값 page가 세팅되어있느냐. 
                 // 없으면 post. 굳이 이렇게 쓰는것은 어디선가 get방식으로 보내겠다는 뜻.
                if (isset($_GET["page"]))
                    $page = $_GET["page"];
                else
                    $page = 1;

                // get방식으로 nowpagelist 값이 세팅되었는가?
                // $now_page_list 변수에 대입, 
                if (isset($_GET["nowpagelist"])) {
                    $now_page_list = $_GET["nowpagelist"];
                    $first_num = $now_page_list - 9;
                } else {
                    $now_page_list = 10;
                    $first_num = 1;
                }

                // review 테이블에서 모든 항목을 가져오되 seller_num 항목(칼럼)에서 $seller_num인 것을 가져오라.
                $sql = "select * from review";
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                $total_record = mysqli_num_rows($result); // 전체 글 수 // 레코드셋 개수체크함수

                $scale = 3;

                // 전체 페이지 수($total_page) 계산
                if ($total_record % $scale == 0)
                    $total_page = floor($total_record / $scale);
                else
                    $total_page = floor($total_record / $scale) + 1;

                // 표시할 페이지($page)에 따라 $start 계산
                $start = ($page - 1) * $scale;

                $number = $total_record - $start;

                for ($i = $start; $i < $start + $scale && $i < $total_record; $i++) {

                    // 내부 결과 포인터를 지정한 행 번호로 이동 하는 함수.
                    mysqli_data_seek($result, $i);
                    
                    // 가져올 레코드로 위치(포인터) 이동
                    $row = mysqli_fetch_array($result);
                   
                    // 하나의 레코드 가져오기
                    $review_num = $row["review_num"];
                    $mv_num = $row["mv_num"];
                    $review_date = $row["review_date"];
                    $review_site = $row["review_site"];
                    $review_rating = $row["review_rating"];
                    $review_short = $row["review_short"];
                    $review_like = $row["review_like"];
                    $review_regtime = $row["review_regtime"];

                ?>
            

<div class="user_comment_content">

<div class="comment_profile_img">
    <img src="./img/2020_02_27_07_32_34.jpg">
</div>

<!-- get 방식으로 이름, 등록날짜를 보낸다. -->
<div class="comment_profile_name">
    <a href="#"><span><strong><?= $mv_num ?></strong> · &nbsp;<?= $review_date ?></span></a>
    <p class="star_rating_content">
        <a href="#" class="on">★</a>
        <a href="#" class="on">★</a>
        <a href="#" class="on">★</a>
        <a href="#">★</a>
        <a href="#">★</a>
    </p>
</div>

<div class="comment_line">
    <span><?= $review_short ?></span>
</div>

<div class="div_chu_box">

    <div class="div_chu">
<!-- <img src="./img/like.png" onclick="update_chu('up','<?= $review_rating ?>')"> &nbsp; <?= $review_like ?> &nbsp; -->
        <div id="like_count" class="like_count<?php echo $num; ?>" onclick="update_like('up','<?= $num ?>')"><img src="./img/like.png"> &nbsp;<?= $review_like ?></div>

    </div>

</div>
                
<?php
$number--;
}
mysqli_close($con);

?>
</div>




<div class="page_line">

                        <ul class="page_num">


                            <?php
                            $now_page_list_add = $now_page_list;
                            if ($total_page >= 2 && $page >= 2) {
                                $new_page = $page - 1;

                                if ($page > 10) {
                                    $now_page_list_minas = $now_page_list - 10;
                                    $next_new_page = $now_page_list_minas - 1;
                                    echo "<li><a href='./movie_introduce_index.php?page=$next_new_page&nowpagelist=$now_page_list_minas'>◀◀&nbsp;</a> </li>";
                                }
                                if (($new_page) == ($now_page_list_add - 10)) {

                                    $new_page = $now_page_list_add - 11;
                                    $now_page_list_add -= 10;
                                    echo "<li><a href='./movie_introduce_main.php?page=$new_page&nowpagelist=$now_page_list_add'>&nbsp;◀&nbsp;</a> </li>";
                                } else {
                                    echo "<li><a href='./movie_introduce_index.php?page=$new_page&nowpagelist=$now_page_list_add'>&nbsp;◀&nbsp;</a> </li>";
                                }
                            } else
                                echo "<li>&nbsp;</li>";

                            // 게시판 목록 하단에 페이지 링크 번호 출력
                            for ($i = $first_num; $i < $now_page_list; $i++) {
                                if ($page == $i)     // 현재 페이지 번호 링크 안함
                                {
                                    echo "<li><b>&nbsp;$i&nbsp;</b></li>";
                                } else {
                                    echo "<li><a href='./movie_introduce_index.php?page=$i&nowpagelist=$now_page_list'>&nbsp;$i&nbsp;</a><li>";
                                }
                            }
                            if ($total_page >= 2 && $page != $total_page) {
                                $new_page = $page + 1;




                                if (($now_page_list_add - 1) == $page) {
                                    $new_page = $now_page_list_add + 1;
                                    $now_page_list_add += 10;
                                    echo "<li><a href='./movie_introduce_main.php?page=$new_page&nowpagelist=$now_page_list_add'>&nbsp;▶</a> </li>";
                                } else {
                                    echo "<li><a href='./movie_introduce_main.php?page=$new_page&nowpagelist=$now_page_list_add'>&nbsp;▶</a> </li>";
                                }


                                // echo "<li> <a href='comment_list.php?page=$new_page&nowpagelist=$now_page_list'>▶&nbsp;</a> </li>";

                                if ($now_page_list + 10 < floor($total_record / SCALE)) {
                                    $now_page_list_add = $now_page_list + 10;
                                    $next_new_page = $now_page_list + 1;
                                    echo "<li> <a href='./movie_introduce_main.php?page=$next_new_page&nowpagelist=$now_page_list_add'>&nbsp;▶▶</a> </li>";
                                }
                            } else
                                echo "<li>&nbsp;</li>";
                            ?>
                        </ul> <!-- page num -->

                    </div> <!-- end of user_comment -->


</div>


</div>

</table>
                        <!-- </div>
                        </div> -->