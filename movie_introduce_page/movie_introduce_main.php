<?php
if (isset($_GET["item"])) {
    $item = $_GET['item'];
    $item = json_decode($item, true);

    $movie_info = new Movie_info();
    $movie_info->setMovieInfo($item, $con);

}elseif (isset($_GET["mv_num"])){

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

    <ul class="slides">
        <!-- <input type="radio" name="radio-btn" id="img-1" checked />
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
    </li> -->
        <div class="css-m4wuz0-PosterContainer e1svyhwg1">
            <div class="css-oqg1df-BlurPosterBlock e1svyhwg2">
                <div color="#211C38" class="css-tyue43-LeftBackground e1svyhwg6"></div>
                <div class="css-1qkjnu8-BlurPoster e1svyhwg4">
                    <div color="#211C38" class="css-1rtfe1i-LeftGradient e1svyhwg8"></div>
                    <div color="#303539" class="css-ml7z2y-RightGradient e1svyhwg9"></div>
                </div>
                <div color="#303539" class="css-1ctk406-RightBackground e1svyhwg7"></div>
                <div class="css-1rpwc4r-DimmedLayer e1svyhwg3"></div>
            </div>


            <!-- <li class="nav-dots">
      <label for="img-1" class="nav-dot" id="img-dot-1"></label>
      <label for="img-2" class="nav-dot" id="img-dot-2"></label>
      <label for="img-3" class="nav-dot" id="img-dot-3"></label>
      <label for="img-4" class="nav-dot" id="img-dot-4"></label>
      <label for="img-5" class="nav-dot" id="img-dot-5"></label>
      <label for="img-6" class="nav-dot" id="img-dot-6"></label>
    </li> -->
    </ul>
    <div id="movie_introduce">
        <div class="css-p3jnjc-Pane e1svyhwg12">
            <div class="css-16l0ojz-MaxWidthGrid e445inc0">
                <div class="css-rr3jd3-MaxWidthRow ecjn50m0">
                    <div class="css-lqm6jo-MaxWidthCol e1pdhzq90">
                        <div class="css-13h49w0-PaneInner e1svyhwg13">
                            <div class="css-ds7f62-PosterWithRankingInfoBlock e1svyhwg10">
                                <div class=" e1pon7hn0 css-m21fst-Self-LazyLoadingImg ewlo9840"><img src="<?= $poster_img ?>" class=" e1pon7hn0 css-1onlrbk-Img-LazyLoadingImg ewlo9841"></div>
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

                    <button type='button' id='kakao-link-btn' class='button_next' value='movie_share' href='javascript:;'><i class='fas fa-share-alt'></i> &nbsp; Share </button>

                    <!-- 공유하기를 위한 자바스크립트 추가 시작 -->
                    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
                    <script type="text/javascript">
                        //<![CDATA[
                        // // 사용할 앱의 JavaScript 키를 설정해 주세요.
                        Kakao.init('b1d92a5562ec8ac7f9466fce0bef38a7');

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
                            <?php
                            echo $release_date;
                            ?>
                        </h2>
                    </div>
                    <div class="css-1xlr4il-ContentRatings e1svyhwg16">
                        <div class="follow_movie_star_wrap">
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
                                    echo "
                                                <label class='startRadio__box'>
                                                    <input type='radio' name='review_rating' value='$find_rating' $rating_checked disabled='disabled'>
                                                    <span class='startRadio__img'><span class='blind'></span></span>
                                                </label>";
                                    $find_rating += 0.5;
                                }
                                ?>
                            </div>
                            <div class="follow_movie_star_num"><?= $naver_star ?></div>
                        </div>
                    </div>
                    <span><button type=button id="review_write" onclick="location.href='../review/review_insert_form.php?mv_num=<?= $mv_code ?>&mv_title=<?=$title?>'"><img src="./img/review_write.png"></span>


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
                        <a><button type='button' id='favorite_movie_like_off'></button></a>

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
            <h2>영화 출연진 목록</h2>

            <div id="movie_cast_1"><?php print_r($actor[0]); ?></div>
            <div id="movie_cast_2"><?php print_r($actor[1]); ?></div>
            <div id="movie_cast_3"><?php print_r($actor[2]); ?></div>
            <div id="movie_cast_4"><?php print_r($actor[3]); ?></div>
            <div id="movie_cast_5"><?php print_r($actor[4]); ?></div>
            <div id="movie_cast_6"><?php print_r($actor[5]); ?></div>
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
            left join user 
            on user.user_num = review.user_num
            where mv_num = $mv_code";

                $result = mysqli_query($con, $sql) or die("review select error: " . mysqli_error($con));
                $total_record = mysqli_num_rows($result); // 전체 글 수 // 레코드셋 개수체크함수
                $scale = 5;
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
                ?>

                    <!-- 리뷰 -->
                    <div class="user_comment_content review_dialog_trigger">
                        <div class="comment_profile_img">
                            <img src="../user/img/<?= $user_img ?>">

                        </div>

                        <!-- get 방식으로 이름, 등록날짜를 보낸다. -->
                        <div class="comment_profile_name">
                            <a href="#"><span><strong><?= $user_nickname ?></strong></span></a>
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
                            <!-- *************** -->
                            <!-- 모달 팝업 -->
                            <!-- *************** -->
                            <div class="modal_container_review" name="modal_container_review">
                                <div class="modal_content_review">
                                    <div class="content_left_review">
                                        <!-- 상단 프로필 및 평점 -->
                                        <div class="modal_content_review_header">
                                            <!-- profile img : get으로 받은 user의 img 그리고 nickname이 들어가야 함-->

                                            <div class="small_img_box">
                                                <img src="../user/img/<?= $user_img ?>" alt="프로필 이미지">
                                            </div>

                                            <!-- 닉네임 : 세션에서 값 옴 -->
                                            <div>
                                                <?= $user_nickname ?>
                                            </div>

                                            <!-- 평점 -->
                                            <div>
                                                <div class="startRadio">
                                                    <?php
                                                    $find_rating = 0.5;
                                                    while ($find_rating <= 5) {
                                                        // 반복문으로 rating bar 생성 및 checked 설정
                                                        if ($find_rating == $review_rating) {
                                                            $rating_checked = "checked";
                                                        } else {
                                                            $rating_checked = "";
                                                        }
                                                        echo "
                                                        <label class='startRadio__box'>
                                                            <input type='radio' name='review_rating_detail_$i' value='$find_rating' $rating_checked disabled='disabled'>
                                                            <span class='startRadio__img'><span class='blind'></span></span>
                                                        </label>";
                                                        $find_rating += 0.5;
                                                    }
                                                    ?>
                                                </div>
                                                <?= $review_rating ?>점
                                            </div>
                                        </div>
                                        <hr width="99%" color="#e2e2e2" noshade="noshade" />
                                        <h3 class="title"><?= $title ?></h3>
                                        <h3>한 줄 평</h3>
                                        <p class="line_review"><?= $review_short ?></p>
                                        <h3>장 문 평</h3>
                                        <p class="long_review"><?= $review_long ?></p>
                                        <hr width="99%" color="#e2e2e2" noshade="noshade" />

                                        <!-- 좋아요 및 댓글 icon -->
                                        <div class="modal_content_review_bottom">
                                            <!-- 좋아요 -->
                                            <?php
                                            // 각 리뷰별 session의 user가 좋아요를 눌렀었는지 조회한 데이터를 기준으로 icon 변경
                                            if (mysqli_fetch_array($result_like)['like_state'] == 1) {
                                                $like_img = "like_color";
                                                $ckeckbox_checked = "checked";
                                            } else {
                                                $like_img = "like";
                                                $ckeckbox_checked = "";
                                            }
                                            ?>
                                            <span>
                                                <form action="#" method="post" class="review_like_form">
                                                    <input type="hidden" name="review_num" id="review_num<?= $i ?>" value="<?= $review_num ?>">
                                                    <input type="checkbox" id="like_checkbox<?= $i ?>" <?= $ckeckbox_checked ?>>
                                                    <label for="like_checkbox<?= $i ?>">
                                                        <img src="../mypage/img/<?= $like_img ?>.png" alt="" class="like_ckeckbox_class">
                                                        <span id="like_checkbox_label<?= $i ?>">
                                                            <p><?= $review_like ?></p>
                                                        </span>
                                                    </label>
                                                </form>

                                            </span>
                                            <!-- 댓글 -->
                                            <span>
                                                <input type="checkbox" id="checkbox<?= $i ?>">
                                                <label for="checkbox<?= $i ?>">
                                                    <img src="./img/comments.png" alt="">&nbsp;
                                                    <span id="reply_count<?= $i ?>">
                                                        <p><?= $result_review_and_reply_num ?></p>
                                                    </span>
                                                </label>
                                            </span>
                                            <!-- 등록일자 -->
                                            <p class="review_regist_day"><?= $review_regtime ?></p>
                                        </div>
                                    </div>

                                    <!-- ************* -->
                                    <!-- 리뷰의 댓글 -->
                                    <!-- ************* -->
                                    <div class="comments_container">
                                        <div class="comments_list">
                                            <?php
                                            while ($row_reply = mysqli_fetch_array($res)) {
                                                $review_reply_num = $row_reply['review_reply_num'];
                                                $review_reply_contents = $row_reply['review_reply_contents'];
                                                $review_reply_regtime = $row_reply['review_reply_regtime'];
                                                $reply_user_num = $row_reply['user_num'];
                                                $reply_user_nickname = $row_reply['user_nickname'];
                                                $reply_user_img = $row_reply['user_img'];
                                            ?>
                                                <div class="comments_item">
                                                    <!-- profile image -->
                                                    <div class="profile_box">
                                                        <!-- 댓글 을 쓴 사람의 num을 받아서 a로 넘겨야함 -->
                                                        <!-- mypage주소에 get방식으로 user_num을 보내야함 -->
                                                        <a href="mypage_index.php?userpage_user_num=<?= $reply_user_num ?>">
                                                            <div class="small_img_box">
                                                                <img src="../user/img/<?= $reply_user_img ?>" alt="프로필 이미지 수정">
                                                            </div>
                                                            <!-- 닉네임 -->
                                                            <p><?= $reply_user_nickname ?></p>
                                                        </a>
                                                    </div>
                                                    <div class="comment_content">
                                                        <!-- 댓글 내용 -->
                                                        <p><?= $review_reply_contents ?></p>
                                                    </div>
                                                </div>
                                            <?php
                                                // review의 댓글 반복문 종료 
                                            }
                                            ?>
                                        </div>
                                        <hr width="99%" color="#e2e2e2" noshade="noshade" />
                                        <form action="#" method="post">
                                            <div class="comments_register">
                                                <input type="hidden" name="mode" id="mode<?= $i ?>" value="insert_reply">
                                                <input type="hidden" name="userpage_user_num" id="userpage_user_num<?= $i ?>" value="<?= $reply_user_num ?>">
                                                <textarea name="review_reply_contents" id="review_reply_contents<?= $i ?>" cols="30" rows="10" placeholder="댓글을 입력하세요 ^.^"></textarea>
                                                <div class="submit_btn_box">
                                                    <input type="button" value="보내기" id="reply_input_button<?= $i ?>">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- 닫기 버튼 -->
                                    <span class="modal_close_btn_review" onclick="console.log(1)">&times;</span>
                                </div><!-- modal_content_review -->
                            </div><!-- modal_containder -->
                        </div>

                        <div class="div_chu_box">
                            <div class="div_chu">
                                <div id="like_count" class="like_count<?php echo $num; ?>" onclick="update_like('up','<?= $num ?>')">
                                    <img src="./img/like.png"> &nbsp;<?= $review_like ?>
                                </div>
                            </div>
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

                    if ($total_page >= 2 && $page >= 2) {
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
                    if ($total_page >= 2 && $page != $total_page) {
                        $new_page = $page + 1;
                        echo "<li> <a href='/wootcha/movie_introduce_page/movie_introduce_index.php?item=" . urlencode(json_encode($item)) . "&page=$new_page'>&nbsp▶</a> </li>";
                    } else
                        echo "<li>&nbsp;</li>";

                    ?>
                </ul> <!-- page num -->

            </div> <!-- end of user_comment -->


        </div>

    </div>

</table>