<?php
if (isset($_GET["item"])) {
    $item = $_GET['item'];
    $item = json_decode($item, true);

    $movie_info = new Movie_info();
    $movie_info->setMovieInfo($item, $con);
} elseif (isset($_GET["mv_num"])) {

    $movie_info = Movie_info::getMovieInfo_ByCode($_GET['mv_num'], $con);
}
$mv_code = $movie_info->movie_code;                 // 영화 코드
$title = $movie_info->title;                        // 영화 제목
$subtitle = $movie_info->subTitle;                  // 부제
$poster_img = $movie_info->poster_img;              // 포스터
$naver_star = $movie_info->naver_star;              // 네이버 평점
$naver_star = sprintf('%0.1f', $naver_star);        // 형식 수정
$naverLink = $movie_info->naver_link;               // 네이버 영화 링크

$genre = $movie_info->genre;                        // 장르
$nation = $movie_info->nation;                      // 국가
$running_time = $movie_info->running_time;          // 러닝타임
$release_date = $movie_info->release_date;          // 개봉일
$actor = $movie_info->actor;                        // 배우
$synopsis = $movie_info->synopsis;                  // 시놉시스
$stillcut = $movie_info->stillcut;                  // 스틸컷

?>

<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/movie_introduce_page/js/movie_introduce_contents.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>



<table id="movie_introduce_container">

    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/movie_introduce_page/stillcut_slide.php"; ?>

    <section>
        <div id="movie_introduce">
            <div class="css-p3jnjc-Pane e1svyhwg12">
                <div class="css-16l0ojz-MaxWidthGrid e445inc0">
                    <div class="css-rr3jd3-MaxWidthRow ecjn50m0">
                        <div class="css-lqm6jo-MaxWidthCol e1pdhzq90">
                            <div class="css-13h49w0-PaneInner e1svyhwg13">
                                <div class="css-ds7f62-PosterWithRankingInfoBlock e1svyhwg10">
                                    <div class=" e1pon7hn0 css-m21fst-Self-LazyLoadingImg ewlo9840"><img src="<?= $poster_img ?>" class=" e1pon7hn0 css-1onlrbk-Img-LazyLoadingImg ewlo9841" onclick=window.open(img src='<?=$poster_img?>, width=600, height=600')></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="css-bwni1m-Title e1ei9ot91">
                        <h2>
                            <?php
                            echo $title . "<h4>" . $subtitle . "</h4>";
                            ?>
                        </h2>

                        <button type='button' id='kakao-link-btn' class='button_next' value='movie_share' href='javascript:;'><i class='fas fa-share-alt'></i> &nbsp; Share
                        </button>

                        <!-- 공유하기를 위한 자바스크립트 추가 시작 -->
                        <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
                        <script type="text/javascript">
                            //<![CDATA[
                            // // 사용할 앱의 JavaScript 키를 설정해 주세요.
                            Kakao.init('2b6afa1b53bec9c5c3161feff6ce8026');

                            // // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
                            Kakao.Link.createDefaultButton({
                                container: '#kakao-link-btn',
                                objectType: 'feed',
                                content: {
                                    title: "<?= $mv_title ?>",
                                    description: "<?= $synopsis ?>",
                                    imageUrl: 'https://lh3.googleusercontent.com/proxy/ZL6IbPsJ1bP5FHc3fk_ZN9V-XNUFoPOnajGpso_jHq-lKlHIXJk42CF5j8xfHzBnT7_ejQJAd_O1C3PSxP5Z12StImRx1y8Fmp6-_eHXYTTY-acX',
                                    link: {
                                        mobileWebUrl: 'https://developers.kakao.com',
                                        webUrl: 'https:/localhost/wootcha/movie_introduce_page/movie_introduce_index.php'
                                    }
                                },
                                buttons: [{
                                        title: '웹으로 보기',
                                        link: {
                                            mobileWebUrl: 'https://developers.kakao.com',
                                            webUrl: 'https://developers.kakao.com'
                                        }
                                    },
                                    {
                                        title: '앱으로 보기',
                                        link: {
                                            mobileWebUrl: 'https://developers.kakao.com',
                                            webUrl: 'https://developers.kakao.com'
                                        }
                                    }
                                ]
                            });
                            //]]>
                        </script>


                        <div class="css-zv7ww6-Detail e1svyhwg15">
                            <br>
                            <h2>
                                <?php
                                echo $genre;
                                ?>
                                &nbsp;・&nbsp;
                                <?php
                                echo $nation;
                                ?>
                                &nbsp;・&nbsp;
                                <?php
                                echo $running_time;
                                ?>
                                &nbsp;・&nbsp;
                                <br>
                                <?php
                                echo $release_date;
                                ?>
                            </h2>
                        </div>

                        <div class="css-1xlr4il-ContentRatings e1svyhwg16">
                            <div class="naver_movie_star_wrap">
                                <div class="startRadio">
                                    <?php
                                    $find_rating = 0.5;

                                    while ($find_rating <= 5) {
                                        // 반복문으로 rating bar 생성 및 checked 설정
                                        if ($find_rating <= ($naver_star / 2)) {
                                            $rating_checked = "checked";
                                        } else {
                                            $rating_checked = "";
                                        }
                                        echo "<label class='startRadio__box'>
                                          <input type='radio' name='review_rating' value='$find_rating' $rating_checked disabled='disabled'>
                                          <span class='startRadio__img'><span class='blind'></span></span>
                                          </label>";
                                        $find_rating += 0.5;
                                    }
                                    ?>

                                </div>
                                <div class="follow_movie_star_num">네이버 평점&nbsp;&nbsp;|&nbsp;&nbsp;<?= $naver_star ?> / 10</div>
                            </div>

                            <div class="wootcha_movie_star_wrap">
                                <div class="startRadio">
                                    <?php
                                    $sql = "select mv_rating from movie where mv_num ='$mv_code'";
                                    $result = mysqli_query($con, $sql) or die("select error: " . mysqli_error($con));
                                    $movie_rating = mysqli_fetch_array($result);
                                    $wootcha_star = $movie_rating['mv_rating'];
                                    $find_rating = 0.5;

                                    while ($find_rating <= 5) {
                                        // 반복문으로 rating bar 생성 및 checked 설정
                                        if ($find_rating <= $wootcha_star) {
                                            $rating_checked = "checked";
                                        } else {
                                            $rating_checked = "";
                                        }
                                        echo "<label class='startRadio__box'>
                                          <input type='radio' name='review_rating2' value='$find_rating' $rating_checked disabled='disabled'>
                                          <span class='startRadio__img'><span class='blind'></span></span>
                                          </label>";
                                        $find_rating += 0.5;
                                    }
                                    ?>

                                </div>

                                <div class="wootcha_star"> Wootcha&nbsp;&nbsp;|&nbsp;&nbsp;<?= $wootcha_star ?> / 5.0 </div>
                            </div>
                        </div>


                        <span><button type=button id="review_write" onclick="location.href='../review/review_insert_form.php?mv_num=<?= $mv_code ?>&mv_title=<?= $title ?>'"><img src="./img/review_write.png"></span>


                        <?php
                        if ($user_num) {

                            // 해당 리뷰에 session의 user_num이 좋아요를 눌렀었는가
                            $sql = "select exists(select * from fav_movie where user_num = {$user_num} and mv_num = {$mv_code}) as exist;";
                            $res = mysqli_query($con, $sql);
                            $row = mysqli_fetch_array($res);

                            if ($row['exist']) {
                                echo "<a href='../search/unfollow.php?no={$mv_code}'><button type='button' id='favorite_movie_like_on'></button></a>";
                            } else {
                                echo "<a href='../search/follow.php?no={$mv_code}'><button type='button' id='favorite_movie_like_off'></button></a>";
                            }
                        } else {
                        ?>
                            <a href="javascript:alert('로그인 후 이용 가능합니다.')"></a>
                            <a>
                                <button type='button' id='favorite_movie_like_off'></button>
                            </a>

                        <?php
                        }
                        ?>

                    </div>

                </div>
            </div>

            <div id="movie_content">
                <h1>

                    <?php
                    // if (isset($movie_detail["movie_story"])) {
                    //     echo $movie_detail['movie_story'];
                    // } else {
                    //     $movie_detail="";
                    // }
                    echo $synopsis;
                    ?>

                </h1>
            </div>


            </span>


            <div id="movie_casting_container">
                <br>
                <h2>출연 / 제작</h2>

                <div id="movie_cast_1"><?php print_r($actor[0]); ?></div>
                <div id="movie_cast_2"><?php print_r($actor[1]); ?></div>
                <div id="movie_cast_3"><?php print_r($actor[2]); ?></div>
                <div id="movie_cast_4"><?php print_r($actor[3]); ?></div>
                <div id="movie_cast_5"><?php print_r($actor[4]); ?></div>
                <div id="movie_cast_6"><?php print_r($actor[5]); ?></div>
            
                <div id="movie_comment_container">

                    <div class="user_comment_title">
                        <span>유저 리뷰</span>
                        <p class="star_rating">
                            <a href="#" class="on">★</a>
                            <a href="#" class="on">★</a>
                            <a href="#" class="on">★</a>
                            <a href="#">★</a>
                            <a href="#">★</a>
                        </p>
                    </div>

                    <!-- 리뷰  -->
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
                        // review 테이블에 user 테이블을 조인시켜 모든 항목을 가져오되 (O)
                        // review 테이블의 user_num 항목의 값과 user 테이블의 user_num 항목의 값이 같은 것을 가져온다.(O)
                        // 그 조건으로 movie 테이블에서 mv_num을 가져오는데 movie 테이블에서 mv_num을 가져오는데 mv_title 항목의 값이 $mv_title 값인것만 가져온다.


                        $sql = "select * from review 
                            inner join user 
                            on user.user_num = review.user_num
                            where mv_num = $mv_code";

                        $result = mysqli_query($con, $sql) or die("review select error: " . mysqli_error($con));
                        $total_record = mysqli_num_rows($result); // 전체 글 수 // 레코드셋 개수체크함수
                        $scale = 5;

                        if (empty($total_record)) {
                            echo "<img src=./img/not_found.png id='not_review'><br><h1>리뷰가 없습니다.</h1>";
                        } else {
                        }
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
                            $user_img = $row["user_img"];
                            $user_nickname = $row["user_nickname"];
                            $review_short = $row["review_short"];
                            $review_long = $row["review_long"];
                            $review_rating = $row["review_rating"];
                            $review_like = $row["review_like"];
                            $review_num = $row['review_num'];
                            $review_regtime = $row['review_regtime'];

                            $sql = "select RR.review_reply_num, RR.review_reply_contents, RR.review_reply_regtime, U.user_nickname, U.user_img, U.user_num  
                                from review_reply RR
                                inner join user U
                                on RR.user_num = U.user_num
                                where RR.review_num = $review_num 
                                order by RR.review_reply_regtime DESC;";

                            $res = mysqli_query($con, $sql);
                            $result_review_and_reply_num = mysqli_num_rows($res);

                            // 리뷰 pk
                            $review_pk_num = $review_num;
                            // 리뷰 작성자 pk
                            $review_writer_num = $row['user_num'];
                            // 리뷰 작성자의 이미지
                            $review_writer_img = $user_img;
                            // 리뷰 작성자의 닉네임
                            $review_writer_nickname = $user_nickname;
                            // 리뷰 작성자가 평가한 평점
                            $review_writer_rating = $review_rating;
                            // 리뷰 좋아요 수
                            $review_like_count = $review_like;
                            // 리뷰 등록 일자
                            $review_register_date = $review_regtime;
                            // 반복문의 넘버 : 1부터 시작하는데 js에서 필요한 건 0부터 시작
                            $while_num = $i;
                            // 영화의 제목
                            $movie_subject = $title;
                            // 한줄평
                            $short_review_content = $review_short;
                            // 장문평
                            $long_review_content = $review_long;
                            // 세션 유저의 넘버
                            if (isset($_SESSION['user_num'])) {
                                $session_user_num = $_SESSION['user_num'];
                            }
                            include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/review/review_modal.php";
                            // review_dialog_trigger 클래스가 버튼 역할을 함
                        ?>

                            <!-- 리뷰 -->
                            <div class="user_comment_content">

                                <div class="comment_profile_img_container">
                                    <div class="comment_profile_img">
                                        <img src="../user/img/<?= $user_img ?>">

                                    </div>
                                </div>
                                <!-- 닉네임, 한줄평, 별점 들어가는 box -->
                                <div class="profile_shortreview_rating">
                                    <!-- get 방식으로 이름, 등록날짜를 보낸다. -->
                                    <div class="comment_profile_name">
                                        <a href="#"><span><strong><?= $user_nickname ?></strong></span></a>
                                    </div>
                                    <div class="review_reply_star">
                                        <div class="startRadio">
                                            <?php
                                            $find_rating = 0.5;

                                            while ($find_rating <= 5) {
                                                // 반복문으로 rating bar 생성 및 checked 설정
                                                if ($find_rating <= $review_rating) {
                                                    $rating_checked = "checked";
                                                } else {
                                                    $rating_checked = "";
                                                }
                                                echo "<label class='startRadio__box'>
                                                      <input type='radio' name='review_rating_a$i' value='$find_rating' $rating_checked disabled='disabled'>
                                                      <span class='startRadio__img'><span class='blind'></span></span>
                                                      </label>";
                                                $find_rating += 0.5;
                                            }
                                            ?>
                                        </div>
                                    </div>


                                    <div class="comment_line review_dialog_trigger">
                                        <span><?= $review_short ?></span>
                                    </div>
                                </div>


                                <div class="div_chu_box">
                                    <div class="div_chu">
                                        <div id="like_count" class="like_count<?php echo $num; ?>" onclick="update_like('up','<?= $num ?>')">
                                            <img src="./img/like.png"> &nbsp;<?= $review_like ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- *************** -->
                            <!-- 모달 팝업 -->
                            <!-- *************** -->

                        <?php
                            $number--;
                        }
                        mysqli_close($con);
                        ?>
                    </div>

                    <div class="page_line">

                        <ul class="page_num">

                            <?php

                            if ($total_page >= 9 && $page >= 2) {
                                $new_page = $page - 1;
                                echo "<li><a href='/wootcha/movie_introduce_page/movie_introduce_index.php?item=" . urlencode(json_encode($item)) . "&page=$new_page'>◀&nbsp</a> </li>";
                            } else
                                echo "<li>&nbsp;</li>";

                            // 게시판 목록 하단에 페이지 링크 번호 출력
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($page == $i)     // 현재 페이지 번호 링크 안함
                                {
                                    echo "<li><b>&nbsp$i&nbsp</b></li>";
                                } else {
                                    echo "<li><a href='/wootcha/movie_introduce_page/movie_introduce_index.php?item=" . urlencode(json_encode($item)) . "&page=$i'> $i </a><li>";
                                }
                            }
                            if ($total_page >= 9 && $page != $total_page) {
                                $new_page = $page + 1;
                                echo "<li> <a href='/wootcha/movie_introduce_page/movie_introduce_index.php?item=" . urlencode(json_encode($item)) . "&page=$new_page'>&nbsp▶</a> </li>";
                            } else
                                echo "<li>&nbsp;</li>";

                            ?>
                        </ul> <!-- page num -->

                    </div> <!-- end of user_comment -->


                 </div> <!-- end of movie_comment_container -->

            </div>  <!-- end of movie_casting_container -->

        </div> <!-- end of movie_introduce -->
    </section>
</table>

<div id="movetopbt">TOP</div>

