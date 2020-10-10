<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wootcha</title>
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css?after">
        <link rel="stylesheet" type="text/css" href="./css/mypage.css?after">
        <link rel="stylesheet" type="text/css" href="./css/mypage_comment_list_item.css?after">
        
        <!-- 모달  -->
        <link rel="stylesheet" type="text/css" href="./css/mypage_review_modal.css?after">
        <script src="./js/mypage_review_modal.js"></script>
    </head>
    <body>
        <!-- 헤더 -->
        <header>
            <?php include_once "../common/page_form/header.php"?>
        </header>
            <?php   include_once "../common/database/db_connector.php";
                    include_once "./mypage_db_helper.php";
                    include_once "../common/crawling/movie_cgv_crawling.php";
                    if(!isset($_SESSION['user_mail'])){
                        echo "<script>alert('잘못된 접근입니다. 로그인 후 이용하세요.');
                        history.go(-1);</script>";
                        exit;
                    }
            ?>
        <!-- 네비게이션 : 왼쪽 -->
        <nav class="nav_left">
            <?php include_once "./mypage_nav_left.php"?>
        </nav>

        <!-- 섹션 -->
        <section>
            <header class="section_header">
                <span class="title_sub">마이 페이지 &nbsp&nbsp > &nbsp&nbsp 내가 작성한 리뷰</span><br><br>
                <span class="title_main">내가 작성한 리뷰</span>
            </header>
            <div class="section_container">
                
                <?php
                    // pk로 review 리스트 검색함
                    $result = select_data($con, "select_my_review", $user_num);
                    $row_num = $result->num_rows;
                    if($row_num){
                        // list 뿌리기
                        for($i = 0; $i < $row_num; $i++){
                            mysqli_data_seek($result,$i);
                            $row_review = mysqli_fetch_array($result);

                            $review_num = $row_review['review_num'];
                            $mv_num = $row_review['mv_num'];
                            $review_rating = $row_review['review_rating'];
                            $review_short = $row_review['review_short'];
                            $review_long = $row_review['review_long'];
                            $review_like = $row_review['review_like'];
                            $review_hit = $row_review['review_hit'];
                            $review_regtime = $row_review['review_regtime'];
                            $mv_title = $row_review['mv_title'];
                            $mv_img_path = $row_review['mv_img_path'];

                            // $sql = "select like_state from review_like where review_num = $review_num and user_num = $user_num;";
                            // $result_like = mysqli_query($con, $sql);
                            
                            // $result_review_and_reply = select_data($con, "select_my_review_reply", $review_num);
                            // $result_review_and_reply_num = mysqli_num_rows($result_review_and_reply);
                            ?>

                <!-- db에서 가져온 값이 들어갈 것 -->
                <div class="list_item">
                    <div class="left">
                        <li><img src="<?=$mv_img_path?>" alt=""></li>
                    </div>
                    <div class="center review_dialog_trigger">
                        <img src="" alt="">
                        <ul>
                            <!-- 영화 제목 -->
                            <li><?=$mv_title?></li>
                            <!-- 한줄평 -->
                            <li><?=$review_short?></li>
                            <!-- 별점 -->
                            <li>
                                <div class="startRadio">
                                    <?php
                                        $find_rating=0.5;
                                        while ($find_rating <= 5) {
                                            // 반복문으로 rating bar 생성 및 checked 설정
                                            if ($find_rating == $review_rating) {
                                                $rating_checked = "checked";
                                            }else{
                                                $rating_checked = "";
                                            }
                                            echo "
                                                <label class='startRadio__box'>
                                                    <input type='radio' name='review_rating_$i' value='$find_rating' $rating_checked disabled='disabled'>
                                                    <span class='startRadio__img'><span class='blind'></span></span>
                                                </label>";
                                            $find_rating += 0.5;
                                        }
                                    ?>
                                </div>
                                <span><?=$review_rating?>점</span>
                            </li>
                        </ul>
                    </div>
                    <div class="right">
                        <form action="../review/review_modify_form.php" method="post">
                            <?php
                            // 리스트를 만들 때 얻었던 데이터를 그대로 보냄
                            foreach($row_review as $key => $value){
                                echo "<input type='hidden' name='$key' value='$value'>";
                            }
                            ?>
                            <input type="image" src="../review/img/edit_pencil.png" alt="제출버튼">
                            <!-- <input type="submit" value="수정 및 삭제"> -->
                        </form>
                        <!-- 등록 일자 -->
                        <span class='regtime'><?=$review_regtime?></span>
                    </div>
                </div><!-- list_item -->
                
                <!-- *************** -->
                <!-- 모달 팝업 -->
                <!-- *************** -->
                <div class="modal_container_review" name="modal_container_review">
                    <div class="modal_content_review">
                        <div class="content_left_review">
                            <!-- 상단 프로필 및 평점 -->
                            <div class="modal_content_review_header">
                                <!-- profile img : 세션에서 값 옴-->
                                <div class="small_img_box">
                                    <img src="../user/img/<?=$user_img?>" alt="프로필 이미지">
                                </div>

                                <!-- 닉네임 : 세션에서 값 옴 -->
                                <div>
                                    <?=$user_nickname?>
                                </div>

                                <!-- 평점 -->
                                <div>
                                    <div class="startRadio">
                                            <?php
                                                $find_rating=0.5;
                                                while ($find_rating <= 5) {
                                                    // 반복문으로 rating bar 생성 및 checked 설정
                                                    if ($find_rating == $review_rating) {
                                                        $rating_checked = "checked";
                                                    }else{
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
                                    <?=$review_rating?>점
                                </div>
                            </div>
                            <hr width="99%" color="#e2e2e2" noshade="noshade"/>
                            <h3 class="title"><?=$mv_title?></h3>
                            <h3>한 줄 평</h3>
                            <p class="line_review"><?=$review_short?></p>
                            <h3>장 문 평</h3>
                            <p class="long_review"><?=$review_long?></p>
                            <hr width="99%" color="#e2e2e2" noshade="noshade"/>
                                            
                            <!-- 좋아요 및 댓글 icon -->
                            <div class="modal_content_review_bottom">
                                <!-- 좋아요 -->
                                <?php
                                    // 각 리뷰별 내가 좋아요를 눌렀었는지 조회한 데이터를 기준으로 icon 변경
                                    
                                    if (mysqli_fetch_array($result_like)['like_state'] == 1) {
                                        $like_img = "like_color";
                                    }else{
                                        $like_img = "like";
                                    }
                                ?>
                                <span>
                                    <form action="../review/review_like_i_m.php" method="post" class="review_like_form">
                                        <input type="hidden" name="review_num" value="<?=$review_num?>">
                                        <input type="checkbox" id="like_checkbox<?=$i?>">
                                        <label for="like_checkbox<?=$i?>"><img src="./img/<?=$like_img?>.png" alt="" class="like_ckeckbox_class"><p><?=$review_like?></p>
                                    </form>
                                </label>    
                                </span>
                                <!-- 댓글 -->
                                <span>
                                    <input type="checkbox" id="checkbox<?=$i?>">
                                    <label for="checkbox<?=$i?>"><img src="./img/comments.png" alt="">&nbsp;<p><?=$result_review_and_reply_num?></p>
                                    </label> 
                                </span>
                                <!-- 등록일자 -->
                                <p class="review_regist_day"><?=$review_regtime?></p>
                            </div>
                        </div>

                        <!-- ************* -->
                        <!-- 리뷰의 댓글 -->
                        <!-- ************* -->
                        <div class="comments_container">
                            <div class="comments_list">
                            <?php
                                while($row_reply = mysqli_fetch_array($result_review_and_reply)){
                                    $review_reply_num = $row_reply['review_reply_num'];
                                    $review_reply_contents = $row_reply['review_reply_contents'];
                                    $review_reply_regtime = $row_reply['review_reply_regtime'];
                                    $user_nickname = $row_reply['user_nickname'];
                                    $user_img = $row_reply['user_img'];
                                    ?>
                                <div class="comments_item">
                                    <!-- profile image -->
                                    <div class="profile_box">
                                        <a href="#">
                                            <div class="small_img_box">
                                                <img src="../user/img/<?=$user_img?>" alt="프로필 이미지 수정">
                                            </div>
                                            <!-- 닉네임 -->
                                            <p><?=$user_nickname?></p>
                                        </a>
                                    </div>
                                    <div class="comment_content">
                                        <!-- 댓글 내용 -->
                                        <p><?=$review_reply_contents?></p>
                                    </div>
                                </div>
                                <?php  
                                // review의 댓글 반복문 종료 
                            }                
                            ?>
                            </div>     
                            <hr width="99%" color="#e2e2e2" noshade="noshade"/>
                            <form action="#">
                                <div class="comments_register">
                                    <textarea name="" cols="30" rows="10"></textarea>
                                    <div class="submit_btn_box">
                                        <input type="submit" value="보내기">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- 닫기 버튼 -->
                        <span class="modal_close_btn_review">&times;</span>
                    </div><!-- modal_content_review -->
                </div><!-- modal_containder -->
            <?php
                mysqli_close($con);
                // for 문 끝
            }
            // if문 끝 
            } else{
                echo "<div>작성한 리뷰가 없습니다.</div>";
            }
            ?>
                
            </div><!-- section_container -->
        </section><!-- section -->
        <!-- 푸터 -->
        <footer>
            <?php include_once "../common/page_form/footer.php"?>
        </footer>
    </body>
    </html>