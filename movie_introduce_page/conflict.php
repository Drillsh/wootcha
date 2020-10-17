<<<<<<< HEAD
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
                                        <hr width="99%" color="#e2e2e2" noshade="noshade"/>
                                        <h3 class="title"><?= $title ?></h3>
                                        <h3>한 줄 평</h3>
                                        <p class="line_review"><?= $review_short ?></p>
                                        <h3>장 문 평</h3>
                                        <p class="long_review"><?= $review_long ?></p>
                                        <hr width="99%" color="#e2e2e2" noshade="noshade"/>

                                        <!-- 좋아요 및 댓글 icon -->
                                        <div class="modal_content_review_bottom">
                                            <!-- 좋아요 -->
                                            <?php
                                            // 해당 리뷰에 session의 user_num이 좋아요를 눌렀었는가
                                            $sql = "select like_state from review_like where review_num = $review_num and user_num = $user_num;";
                                            $result_like = mysqli_query($con, $sql);
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
                                                    <input type="hidden" name="review_num" id="review_num<?= $i ?>"
                                                           value="<?= $review_num ?>">
                                                    <input type="checkbox"
                                                           id="like_checkbox<?= $i ?>" <?= $ckeckbox_checked ?>>
                                                    <label for="like_checkbox<?= $i ?>">
                                                        <img src="../mypage/img/<?= $like_img ?>.png" alt=""
                                                             class="like_ckeckbox_class">
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
                                                                <img src="../user/img/<?= $reply_user_img ?>"
                                                                     alt="프로필 이미지 수정">
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
                                        <hr width="99%" color="#e2e2e2" noshade="noshade"/>
                                        <form action="#" method="post">
                                            <div class="comments_register">
                                                <input type="hidden" name="mode" id="mode<?= $i ?>"
                                                       value="insert_reply">
                                                <input type="hidden" name="userpage_user_num"
                                                       id="userpage_user_num<?= $i ?>" value="<?= $reply_user_num ?>">
                                                <textarea name="review_reply_contents"
                                                          id="review_reply_contents<?= $i ?>" cols="30" rows="10"
                                                          placeholder="댓글을 입력하세요 ^.^"></textarea>
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