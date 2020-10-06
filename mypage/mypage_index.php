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
        
        <?php include "../common/database/db_connector.php"?>
        <?php include "./mypage_db_helper.php"?>
        <?php include "../common/crawling/movie_cgv_crawling.php"?>
    </head>
    <body>
        
        <!-- 헤더 -->
        <header>
            <?php include "../common/page_form/header.php"?>
        </header>

        <!-- 네비게이션 : 왼쪽 -->
        <nav class="nav_left">
            <?php include "./mypage_nav_left.php"?>
        </nav>

        <!-- 섹션 -->
        <section>
            <header class="section_header">
                <span class="title_sub">마이 페이지 &nbsp&nbsp > &nbsp&nbsp 내가 작성한 리뷰</span><br><br>
                <span class="title_main">내가 작성한 리뷰</span>
            </header>
            <div class="section_container">
                <?php
                    // mypage_db_helper 에 정의된 함수
                    $result = select_data($con, "select_user", "myohoon95@gmail.com");

                    // 사용자의 pk를 확인
                    $row = mysqli_fetch_array($result);
                    $user_num = $row['user_num'];
                    $user_img = $row['user_img'];
                    $user_nickname = $row['user_nickname'];

                    // pk로 review 리스트 검색함
                    $result = select_data($con, "select_my_reivew", $user_num);
                    mysqli_data_seek($result,0);
                    $row_review = mysqli_fetch_array($result);
                    // 댓글 modal 창 만들 때 사용함
                    $row_num = mysqli_num_rows($result);
                    
                    // list 뿌리기
                    while($row_review = mysqli_fetch_array($result)){
                        $i = 0;
                        $review_num = $row_review['review_num'];
                        $user_num = $row_review['user_num'];
                        $mv_num = $row_review['mv_num'];
                        $review_date = $row_review['review_date'];
                        $review_site = $row_review['review_site'];
                        $review_rating = $row_review['review_rating'];
                        $review_short = $row_review['review_short'];
                        $review_long = $row_review['review_long'];
                        $review_like = $row_review['review_like'];
                        $review_hit = $row_review['review_hit'];
                        $review_regtime = $row_review['review_regtime'];
                        $mv_title = $row_review['mv_title'];

                        $img_link = get_cgv_movie_big_poster_url($mv_title);
                        $result_review_and_reply = select_data($con, "select_my_reivew_reply", $review_num);
                        $result_review_and_reply_num = mysqli_num_rows($result_review_and_reply);
                ?>

                <!-- db에서 가져온 값이 들어갈 것 -->
                <div class="list_item review_dialog_trigger">
                    <div class="left">
                        <li><img src="<?=$img_link?>" alt=""></li>
                    </div>
                    <div class="center">
                        <img src="" alt="">
                        <ul>
                            <li><?=$mv_title?></li>
                            <li><?=$review_short?></li>
                            <li><?=$review_regtime?></li>
                        </ul>
                    </div>
                    <div class="right">
                        <button>수정 및 삭제</button>
                        <span>
                            <span><?=$review_rating?>점</span>
                        </span>
                    </div>
                </div><!-- list_item -->

                <!-- *************** -->
                <!-- 모달 팝업 -->
                <!-- *************** -->
                <div class="modal_container" name="modal_container">
                    <div class="modal_content">
                        <span class="modal_close_btn">&times;</span>
                        <!-- 상단 프로필 및 평점 -->
                        <div class="modal_content_header">
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
                        <div class="modal_content_bottom">
                            <!-- 좋아요 -->
                            <span>
                                <img src="./img/like.png" alt="">
                                <p><?=$review_like?></p>
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
                                <textarea name="" id="" cols="30" rows="10"></textarea>
                                <div class="submit_btn_box">
                                    <input type="submit" value="보내기">
                                </div>
                            </div>
                        </form>
                    </div>

                    
                </div><!-- modal_containder -->
                <?php
                $i++;
                // while문 끝
                } 
                ?>

            </div><!-- section_container -->
                
                
                
                
                

        </section><!-- section -->
        
        <!-- 푸터 -->
        <footer>
            <?php include "../common/page_form/footer.php"?>
        </footer>
    </body>
</html>