<?php
        // // *****************************
        // // 리뷰 모달에서 사용하는 변수, 여기에 매치하면 됨
        // // *****************************
        // // 리뷰 pk
        // $review_pk_num = 0;
        // // 리뷰 작성자의 이미지
        // $review_writer_img = "";
        // // 리뷰 작성자의 닉네임
        // $review_writer_nickname = "";
        // // 리뷰 작성자가 평가한 평점
        // $review_writer_rating = 0.0;
        // // 리뷰 좋아요 수
        // $review_like_count = 0;
        // // 리뷰 등록 일자
        // $review_register_date = 0;
        // // 반복문의 넘버
        // $while_num = 0; 
        // // 영화의 제목
        // $movie_subject = "";
        // // 한줄평
        // $short_review_content = "";
        // // 장문평
        // $long_review_content = "";
        // // 세션 유저의 넘버
        // $session_user_num = "";

        if(isset($_SESSION['user_num'])){
           // 해당 리뷰에 session의 user_num이 좋아요를 눌렀었는가
        $sql = "select like_state from review_like where review_num = $review_pk_num and user_num = $session_user_num;";
        $result_like = mysqli_query($con, $sql);
        }
        


        // 해당 리뷰의 댓글 select
        $sql = "select RR.review_reply_num, RR.review_reply_contents, RR.review_reply_regtime, U.user_nickname, U.user_img, U.user_num  
                from review_reply RR
                inner join user U
                on RR.user_num = U.user_num
                where RR.review_num = $review_pk_num  
                order by RR.review_reply_num DESC;";
        $result_review_and_reply = mysqli_query($con, $sql);
        $result_review_and_reply_num = mysqli_num_rows($result_review_and_reply);
?>      
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
                                    if (strlen($review_writer_img) > 22) {
                                        echo "<img src='$review_writer_img' alt='프로필 이미지'>";
                                    }else{ 
                                        echo "<img src='http://".$_SERVER['HTTP_HOST']."/wootcha/user/img/$review_writer_img' alt='프로필 이미지'>";
                                    }
                                ?>
                </div>

                <!-- 닉네임-->
                <div>
                    <?=$review_writer_nickname?>
                </div>

                <!-- 평점 -->
                <div>
                    <div class="startRadio">
                    <?php
                                                $find_rating=0.5;
                                                while ($find_rating <= 5) {
                                                    // 반복문으로 rating bar 생성 및 checked 설정
                                                    if ($find_rating == $review_writer_rating) {
                                                        $rating_checked = "checked";
                                                    }else{
                                                        $rating_checked = "";
                                                    }
                                                    echo "
                                                        <label class='startRadio__box'>
                                                            <input type='radio' name='review_rating_detail_$while_num' value='$find_rating' $rating_checked disabled='disabled'>
                                                            <span class='startRadio__img'><span class='blind'></span></span>
                                                        </label>";
                                                    $find_rating += 0.5;
                                                }
                                            ?>
                    </div>
                    <?=$review_writer_rating?>점
                </div>
            </div>
            <hr width="99%" color="#e2e2e2" noshade="noshade"/>
            <h3 class="title"><?=$movie_subject?></h3>
            <h3>한 줄 평</h3>
            <p class="line_review"><?=$short_review_content?></p>
            <h3>장 문 평</h3>
            <p class="long_review"><?=$long_review_content?></p>
            <hr width="99%" color="#e2e2e2" noshade="noshade"/>

            <!-- 좋아요 및 댓글 icon -->
            <div class="modal_content_review_bottom">
                <!-- 좋아요 -->
            <?php
                                if(isset($_SESSION['user_num'])){
                                    // 각 리뷰별 session의 user가 좋아요를 눌렀었는지 조회한 데이터를 기준으로 icon 변경
                                    if (mysqli_fetch_array($result_like)['like_state'] == 1) {
                                        $like_img = "like_color";
                                        $ckeckbox_checked = "checked";
                                    }else{
                                        $like_img = "like";
                                        $ckeckbox_checked = "";
                                    }
                                }else{
                                    $like_img = "like";
                                    $ckeckbox_checked = "";
                                }
                                ?>
                <span>
                    <form action="#" method="post" class="review_like_form">
                        <input
                            type="hidden"
                            name="review_num"
                            id="review_num<?=$while_num?>"
                            value="<?=$review_pk_num?>">
                        <input type="checkbox" id="like_checkbox<?=$while_num?>" <?=$ckeckbox_checked?>>
                        <label for="like_checkbox<?=$while_num?>">
                            <img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/mypage/img/<?=$like_img?>.png" alt="" class="like_ckeckbox_class">
                            <span id="like_checkbox_label<?=$while_num?>">
                                <p><?=$review_like_count?></p>
                            </span>
                        </label>
                    </form>

                </span>
                <!-- 댓글 -->
                <span>
                    <input type="checkbox" id="checkbox<?=$while_num?>">
                    <label for="checkbox<?=$while_num?>">
                        <img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/mypage/img/comments.png" alt="">&nbsp;
                        <span id="reply_count<?=$while_num?>">
                            <p><?=$result_review_and_reply_num?></p>
                        </span>
                    </label>
                </span>
                <!-- 등록일자 -->
                <p class="review_regist_day"><?=$review_register_date?></p>
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
                                                        echo "<img src='http://".$_SERVER['HTTP_HOST']."/wootcha/user/img/$reply_user_img' alt='프로필 이미지 수정'>";
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
                    <input type="hidden" name="mode" id="mode<?=$while_num?>" value="insert_reply">
                    <input
                        type="hidden"
                        name="userpage_user_num"
                        id="userpage_user_num<?=$while_num?>"
                        value="<?=$session_user_num?>">
                    <textarea
                        name="review_reply_contents"
                        id="review_reply_contents<?=$while_num?>"
                        cols="30"
                        rows="10"
                        placeholder="댓글을 입력하세요 ^.^"></textarea>
                    <div class="submit_btn_box">
                        <input type="button" value="보내기" id="reply_input_button<?=$while_num?>">
                    </div>
                </div>
            </form>
        </div>
        <!-- 닫기 버튼 -->
        <span class="modal_close_btn_review">&times;</span>
    </div>
    <!-- modal_content_review -->
</div>
<!-- modal_containder -->