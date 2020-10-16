<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wootcha</title>
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css?after">
        <link rel="stylesheet" type="text/css" href="./css/mypage.css?after">
        <link rel="stylesheet" type="text/css" href="./css/mypage_comment_list_item.css?after">
        
        <!-- 리스트 자동 추가 -->
        <script src="http://code.jquery.com/jquery-1.7.js"></script>
        <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/mypage/js/infi_scroll.js"></script>

        <!-- 모달  -->
        <link rel="stylesheet" type="text/css" href="./css/mypage_review_modal.css?after">
        <script src="./js/mypage_review_modal.js"></script>

        <!-- db -->
        <?php include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php"; ?>

          
    </head>
    <body>
        <!-- 헤더 -->
        <header>
            <?php include_once "../common/page_form/header.php"?>
        </header>
        
        <!-- 현재 페이지 확인용 -->
        <?php
            $now_page_name = "review";
        ?>

        <!-- 네비게이션 : 왼쪽 -->
        <nav class="nav_left">
            <?php include_once "./mypage_nav_left.php"?>
        </nav>

        <!-- 섹션 -->
        <section>
            <?php
                $sql = "select * from review where user_num = $write_review_user_num;";
                $result_total_review_count = mysqli_query($con, $sql);
            ?>
            <header class="section_header">
                <span class="title_sub"><?=$title_sub?> 페이지 &nbsp&nbsp > &nbsp&nbsp <?=$title_main?> 작성한 리뷰</span><br><br>
                <span class="title_main"><?=$title_main?> 작성한 리뷰 <h5 id="review_total_count"> <?=$result_total_review_count->num_rows?> 개</h5></span>
            </header>
            

            <div class="section_container">
            <input type="hidden" value="<?=$userpage_user_num?>" id="userpage_user_num">
            <input type="hidden" value="" id="review_total_count">
                <?php
                    // pk로 review 리스트 검색함
                    $result = select_data($con, "select_my_review", $write_review_user_num);
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

                            // 해당 리뷰에 session의 user_num이 좋아요를 눌렀었는가
                            $sql = "select like_state from review_like where review_num = $review_num and user_num = $user_num;";
                            $result_like = mysqli_query($con, $sql);
                            
                            // 해당 리뷰의 댓글 select
                            $result_review_and_reply = select_data($con, "select_my_review_reply", $review_num);
                            $result_review_and_reply_num = mysqli_num_rows($result_review_and_reply);
                            ?>

                <!-- db에서 가져온 값이 들어갈 것 -->
                <div class="list_item">
                    <div class="left">
                        <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/movie_introduce_page/movie_introduce_index.php?mv_num=<?=$mv_num?>"><img src="<?=$mv_img_path?>" alt=""></a></li>
                    </div>
                    <div class="center">
                        <img src="" alt="">
                        <ul>
                            <!-- 영화 제목 -->
                            <li><a href="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/movie_introduce_page/movie_introduce_index.php?mv_num=<?=$mv_num?>"><?=$mv_title?></a></li>
                            <!-- 한줄평 -->
                            <li class="review_dialog_trigger"><?=$review_short?></li>
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
                            <span class="review_like_and_comments_box">
                                <!-- 좋아요 -->
                                <input type="checkbox" id="like_checkbox_review_view<?=$i?>">
                                <label for="like_checkbox_review_view<?=$i?>">
                                    <img src="./img/like_color.png" alt="">
                                    <span>
                                        <p><?=$review_like?></p>
                                    </span>
                                </label>
                                <!-- 댓글 -->
                                <input type="checkbox" id="checkbox_review<?=$i?>">
                                <label for="checkbox_review<?=$i?>">
                                    <img src="./img/comments.png" alt="">&nbsp;
                                    <span>    
                                        <p><?=$result_review_and_reply_num?></p>
                                    </span>    
                                </label> 
                            </span>
                        </ul>
                    </div>
                    <div class="right">
                    
                    <?php
                    // 수정하기 버튼
                    // <!-- 세션의 user와 get으로 넘어온 user의 값이 같지 않으면 문장 실행 하지 않음 -->
                    if ($userpage_user_num == $user_num) {
                    ?>
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
                    <?php
                    }
                    ?>
                        
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
                                <!-- profile img : get으로 받은 user의 img 그리고 nickname이 들어가야 함-->

                                <div class="small_img_box">
                                <?php
                                    if (strlen($img) > 22) {
                                        echo "<a href='mypage_index.php?userpage_user_num=$userpage_user_num'><img src='$img' alt='프로필 이미지'></a>";
                                    }else{ 
                                        echo "<a href='mypage_index.php?userpage_user_num=$userpage_user_num'><img src='../user/img/$img' alt='프로필 이미지'></a>";
                                    }
                                ?>  
                                </div>

                                <!-- 닉네임-->
                                <div>
                                    <?=$nickname?>
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
                            <h2 class="title"><?=$mv_title?></h2>
                            <div class="review_content_box">
                                <div class="line_view_box">
                                    <h2>한 줄 평</h2>
                                    <p class="line_review"><?=$review_short?></p>
                                </div>
                                <div class="long_view_box">
                                    <h2>장 문 평</h2>
                                    <p class="long_review"><?=$review_long?></p>
                                </div>
                                
                                
                            </div>
                            <!-- 좋아요 및 댓글 icon -->
                            <hr class="fixed_bottom" width="500px" color="#e2e2e2" noshade="noshade"/>
                            <div class="modal_content_review_bottom">
                                <!-- 좋아요 -->
                                <?php
                                    // 각 리뷰별 session의 user가 좋아요를 눌렀었는지 조회한 데이터를 기준으로 icon 변경
                                    if (mysqli_fetch_array($result_like)['like_state'] == 1) {
                                        $like_img = "like_color";
                                        $ckeckbox_checked = "checked";
                                    }else{
                                        $like_img = "like";
                                        $ckeckbox_checked = "";
                                    }
                                ?>
                                <span>
                                    <form action="#" method="post" class="review_like_form">
                                        <input type="hidden" name="review_num" id="review_num<?=$i?>" value="<?=$review_num?>">
                                        <input type="checkbox" id="like_checkbox<?=$i?>" <?=$ckeckbox_checked?>>
                                        <label for="like_checkbox<?=$i?>">
                                            <img src="./img/<?=$like_img?>.png" alt="" class="like_ckeckbox_class">
                                            <span id="like_checkbox_label<?=$i?>">
                                                <p><?=$review_like?></p>
                                            </span>
                                        </label>
                                    </form>
                                    
                                </span>
                                <!-- 댓글 -->
                                <span>
                                    <input type="checkbox" id="checkbox<?=$i?>">
                                    <label for="checkbox<?=$i?>">
                                        <img src="./img/comments.png" alt="">&nbsp;
                                        <span id="reply_count<?=$i?>">    
                                            <p><?=$result_review_and_reply_num?></p>
                                        </span>    
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
                                        $reply_user_num = $row_reply['user_num'];
                                        $reply_user_nickname = $row_reply['user_nickname'];
                                        $reply_user_img = $row_reply['user_img'];
                                ?>
                                    <div class="comments_item">
                                        <!-- profile image -->
                                        <div class="profile_box">
                                            <!-- 댓글 을 쓴 사람의 num을 받아서 a로 넘겨야함 -->
                                            <!-- mypage주소에 get방식으로 user_num을 보내야함 -->
                                            <a href="mypage_index.php?userpage_user_num=<?=$reply_user_num?>">
                                                <div class="small_img_box">
                                                <?php
                                                    if (strlen($reply_user_img) > 22) {
                                                        echo "<img src='$reply_user_img' alt=''>";
                                                    }else{ 
                                                        echo "<img src='../user/img/$reply_user_img' alt='프로필 이미지 수정'>";
                                                    }
                                                ?>
                                                </div>
                                                <!-- 닉네임 -->
                                                <p><?=$reply_user_nickname?></p>
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
                            <form action="#" method="post">
                                <div class="comments_register">
                                    <input type="hidden" name="mode" id="mode<?=$i?>" value="insert_reply">
                                    <input type="hidden" name="userpage_user_num" id="userpage_user_num<?=$i?>" value="<?=$userpage_user_num?>">
                                    <textarea name="review_reply_contents" id="review_reply_contents<?=$i?>" cols="30" rows="10" placeholder="댓글을 입력하세요 ^.^"></textarea>
                                    <div class="submit_btn_box">
                                        <input type="button" value="보내기" id="reply_input_button<?=$i?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- 닫기 버튼 -->
                        <span class="modal_close_btn_review">&times;</span>
                    </div><!-- modal_content_review -->
                </div><!-- modal_containder -->
            <?php
                
                // for 문 끝
            }
            // if문 끝 
            } else{
                echo "<br><br><div>작성한 리뷰가 없습니다.</div>";
            }
            mysqli_close($con);
            ?>
                
            </div><!-- section_container -->
            <div id="loading_box"><img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt=""></div>
            <a href="#" id="btn_top"><img src="../common/img/page_up.png" alt=""></a>
        </section><!-- section -->
        <!-- 푸터 -->
        <footer>
            <?php include_once "../common/page_form/footer.php"?>
        </footer>
    </body>
    </html>