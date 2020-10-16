<div class="css-3igsdh-StyledSelf e6fbvza0">
    <!-- 상단 슬라이드 -->
    <div class="css-1l88qpn-StyledSelf eayv25j0">
        <!-- 왼쪽버튼 -->
        <div class="css-jxbkzh-StyledJumbotronArrowButton-StyledJumbotronArrowPrevButton eayv25j4">
      <span class="SVGInline css-1jewpj1-StyledJumbotronArrowButtonIcon eayv25j2">
        <!--?xml version="1.0" encoding="UTF-8"?-->
        <svg class="SVGInline-svg css-1jewpj1-StyledJumbotronArrowButtonIcon-svg eayv25j2-svg" width="12px"
             height="22px" viewBox="0 0 12 22" version="1.1" xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink">
              <!-- Generator: Sketch 57.1 (83088) - https://sketch.com -->
              <title>arrow</title>
              <desc>Created with Sketch.</desc>
              <g id="UI" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="홈" transform="translate(-13.000000, -281.000000)" fill="#CCCCCC">
                    <g id="Group" transform="translate(13.000000, 281.000000)">
                        <polygon id="arrow"
                                 transform="translate(6.000000, 10.560000) scale(-1, 1) translate(-6.000000, -10.560000) "
                                 points="9.12 10.56 -2.83182089e-13 19.68 1.44 21.12 11.28 11.28 12 10.56 1.44 -5.5067062e-14 -2.81976258e-13 1.44"></polygon>
                    </g>
                </g>
              </g>
        </svg>
      </span>
        </div>
        <!-- 오른쪽버튼 -->
        <div class="css-1kvaztz-StyledJumbotronArrowButton-StyledJumbotronArrowNextButton eayv25j3">
      <span class="SVGInline css-1jewpj1-StyledJumbotronArrowButtonIcon eayv25j2">
        <!--?xml version="1.0" encoding="UTF-8"?-->
        <svg class="SVGInline-svg css-1jewpj1-StyledJumbotronArrowButtonIcon-svg eayv25j2-svg" width="12px"
             height="22px" viewBox="0 0 12 22" version="1.1" xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink">
          <!-- Generator: Sketch 57.1 (83088) - https://sketch.com -->
          <title>arrow</title>
          <desc>Created with Sketch.</desc>
          <g id="UI" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <g id="홈" transform="translate(-1255.000000, -281.000000)" fill="#CCCCCC">
                  <g id="Group" transform="translate(13.000000, 281.000000)">
                      <polygon id="arrow"
                               points="1251.12 10.56 1242 19.68 1243.44 21.12 1253.28 11.28 1254 10.56 1243.44 -5.5067062e-14 1242 1.44"></polygon>
                  </g>
              </g>
          </g>
        </svg>
      </span>
        </div>
        <div class="home-jumbotron">
            <div content="[object Object]" class="css-4bfx6u-Self e9r9i620 enter-done">
                <div class="css-1fqeujt-StillcutContainer e9r9i621">
                    <div class="e7hewbz0 css-1sxaihu-StyledSelf-DefaultStillCut e1q5rx9q0">
                        <span class="css-1te5psz-StyledBackground e1q5rx9q1"
                              style="background-image: url(&quot;https://dhgywazgeek0d.cloudfront.net/watcha/image/upload/v1602045273/kc4mrbpdfymvihkqespp.webp&quot;);"></span>
                    </div>
                    <div class="css-1qzrlid-Shadow-ShadowLeft e9r9i625"></div>
                </div>
                <div class="css-5g3syw-Shadow-ShadowTop e9r9i626"></div>
                <div class="css-up7oer-Shadow-ShadowBottom e9r9i624"></div>
                <div class="css-1rbg53a-Information e9r9i622">
                    <div class="e15s157p1 css-q4juhy-Self-Logo ewlo9840">
                        <img src="https://dhgywazgeek0d.cloudfront.net/watcha/image/upload/c_fill,h_260,q_80/v1601356336/dbjgb5besajfh1oebtxp.png"
                             class="e15s157p1 css-1q8u4mv-Img-Logo ewlo9841" style="width: 25.82%;">
                    </div>
                    <h3 class="css-15hvbu0-Subtitle e7hewbz1">Part2로 돌아온 최강 스포츠 애니매주 일요일, 왓챠에서 가장 빠르게!</h3>
                </div>
            </div>
        </div>
    </div><!-- END 상단 슬라이드 -->
</div>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";

$sql = "select R.mv_num, count(R.mv_num) as count, M.mv_title, M.mv_release_date, M.mv_img_path, M.mv_rating 
  from review R inner join movie M on R.mv_num = M.mv_num group by R.mv_num order by count desc limit 5;";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
?>
<!-- 최다 리뷰 영화 리스트 -->
<div class="css-MainDiv ebeya3l11">
    <!-- 타이틀과 영화항목 최다리뷰 -->
    <div class="css-MainListContainer ebeya3l2">
        <!-- 타이틀 -->
        <div class="css-MainListTitleRow-MainListTitleRow ebeya3l3">
            <!-- 타이틀 설정 -->
            <p class="css-StyledMainListTitle ebeya3l6">WOOTCHA Best Movie</p>
        </div>
        <!-- 영화항목 -->
        <div class="css-StyledMainScrollOuterContainer ebeya3l4">
            <!-- 영화 로비 -->
            <div class="css-ScrollBarContainer e1f5xhlb0">
                <!-- 영화 1층 -->
                <div class="css-ScrollBar e1f5xhlb1">
                    <!-- 영화 2층 -->
                    <div class="css-ScrollingTaim best_movie">
                        <!-- 영화 3층 -->
                        <div class="css-StyledMainScrollingTaimContainer ebeya3l5">
                            <!-- 영화 4층 ul -->
                            <ul class="css-StyledMainUl-StyledMainUlContentPosterList-RowList eykn4p10">
                                <!-- 영화 5층 li -->
                                <?php
                                $main_list2 = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    $mv_rating = $row['mv_rating'];
                                    $mv_release_date = $row['mv_release_date'];
                                    $mv_title = $row['mv_title'];
                                    $mv_img_path = $row['mv_img_path'];
                                    $mv_num = $row['mv_num'];
                                    $count = $row['count'];
                                    ?>
                                    <li class="css-MainList-li e3fgkal0">
                                        <!-- 영화 6층 a -->
                                        <a title="<?= $mv_title ?>"
                                           href="/wootcha/movie_introduce_page/movie_introduce_index.php?mv_num=<?= $mv_num ?>">
                                            <!-- 6층 포스터 -->
                                            <div class="css-MainContentPosterBlock e3fgkal1">
                                                <!-- 포스터 설정 -->
                                                <div class="css-MainPosterBlock-MainPosterBlock ewlo9840">
                                                    <img src="<?= $mv_img_path ?>"
                                                         class="css-StyledMainPosterBlock ewlo9841">
                                                </div>
                                                <!-- 포스터 랭크 -->
                                                <div class="css-RankBadge e3fgkal7"><?= $main_list2 ?></div>
                                            </div>
                                            <!-- 6층 설명 -->
                                            <div class="css-MainContentBlock e3fgkal2">
                                                <!-- 영화설명_제목 -->
                                                <div class="css-ContentTitle e3fgkal3"><?= $mv_title ?></div>
                                                <!-- 영화설명_출시년도 -->
                                                <div class="css-StyledContentYear ebeya3l12"><?= $mv_release_date ?></div>
                                                <!-- 영화설명_평점 -->
                                                <div class="average css-MainContentRating-StyledContentRating ebeya3l14">
                                                    <span>평점</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                         viewBox="0 0 12 12" fill="#555765"
                                                         class="css-IcRatingStarSvg erjycaa0">
                                                        <path class="fillTarget" fill="#6A6B76" fill-rule="evenodd"
                                                              d="M5.637 8.02L2.779 9.911c-.138.092-.324.054-.415-.084-.048-.073-.063-.162-.04-.246l.916-3.302L.56 4.145c-.13-.103-.152-.292-.048-.421.054-.068.134-.11.221-.113l3.424-.15 1.2-3.21c.058-.155.23-.233.386-.175.081.03.146.094.176.175l1.2 3.21 3.424.15c.165.007.294.147.286.313-.003.086-.045.167-.112.221L8.034 6.28l.915 3.302c.045.16-.049.325-.209.37-.083.022-.173.008-.245-.04L5.637 8.02z"></path>
                                                    </svg>
                                                    <span><?= $mv_rating ?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;조회수 : <?= $count ?></span>


                                                </div>
                                            </div>
                                        </a>
                                    </li><!-- END 영화 5층 li -->
                                    <?php
                                    $main_list2++;
                                } // END while
                                ?>
                            </ul> <!-- END 영화 4층 ul -->
                        </div>
                    </div> <!-- END 영화 2층 -->
                </div> <!-- END 영화 1층 -->
                <!-- 영화로비_왼쪽버튼 -->
                <div class="arrow_button css-ArrowButtonBlock-left e1f5xhlb3" direction="left">
                    <div class="css-BackwardButton-left e1f5xhlb6"></div>
                </div>
                <!-- 영화로비_오른쪽버튼 -->
                <div class="arrow_button css-ArrowButtonBlock-right e1f5xhlb3" direction="right">
                    <div class="css-ForwardButton-right e1f5xhlb5">
                        <!-- 영화로비_오른쪽버튼 img -->
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDEyIDE2Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZD0iTTAgMEgxMlYxNkgweiIvPgogICAgICAgIDxwYXRoIGZpbGw9IiMyOTJBMzIiIHN0cm9rZT0iIzI5MkEzMiIgc3Ryb2tlLXdpZHRoPSIuMzUiIGQ9Ik0zLjQyOSAxMy40MDlMNC4zNTQgMTQuMjU4IDEwLjY4IDguNDYgMTEuMTQzIDguMDM2IDQuMzU0IDEuODEzIDMuNDI5IDIuNjYyIDkuMjkxIDguMDM2eiIvPgogICAgPC9nPgo8L3N2Zz4K"
                             alt="forward">
                    </div>
                </div>
            </div> <!-- END 영화로비 -->
        </div>
    </div> <!-- END 타이틀과 영화항목 최다리뷰 -->
</div><!-- END 최다 리뷰 영화 리스트 -->

<?php
$sql = "select * from review R inner join movie M on R.mv_num = M.mv_num order by review_like desc limit 10";
$result = mysqli_query($con, $sql);
?>
<!-- 베스트 리뷰 리스트 -->
<div class="css-MainDiv ebeya3l11">
    <!-- 타이틀과 영화항목 베스트리뷰 -->
    <div class="css-MainListContainer ebeya3l2">
        <!-- 타이틀 -->
        <div class="css-MainListTitleRow-MainListTitleRow ebeya3l3">
            <!-- 타이틀 설정 -->
            <p class="css-StyledMainListTitle ebeya3l6">Best Review</p>
        </div>
        <!-- 영화항목 -->
        <div class="css-StyledMainScrollOuterContainer ebeya3l4">
            <!-- 영화 로비 -->
            <div class="css-ScrollBarContainer e1f5xhlb0">
                <!-- 영화 1층 -->
                <div class="css-ScrollBar e1f5xhlb1">
                    <!-- 영화 2층 -->
                    <div class="css-ScrollingTaim best_review">
                        <!-- 영화 3층 -->
                        <div class="css-StyledMainScrollingTaimContainer ebeya3l5">
                            <!-- 영화 4층 ul -->
                            <ul class="css-StyledMainUl-StyledMainUlContentPosterList-RowList eykn4p10">
                                <!-- 영화 5층 li -->
                                <?php
                                $main_list = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    $mv_num = $row['mv_num'];
                                    $review_rating = $row['review_rating'];
                                    $review_like = $row['review_like'];
                                    $review_number = $row['review_num'];
                                    $mv_release_date = $row['mv_release_date'];
                                    $mv_title = $row['mv_title'];
                                    $mv_img_path = $row['mv_img_path'];
                                    // *****************************
                                    // 리뷰 모달에서 사용하는 변수, 여기에 매치하면 됨
                                    // *****************************
                                    $query = "select user_img, user_nickname, review_like, review_regtime, review_short, review_long  
                                              from review R
                                              inner join user U
                                              on R.user_num = U.user_num
                                              where review_num = $review_number;";
                                    $result_query = mysqli_query($con, $query) or die(mysqli_error($con));
                                    $row = mysqli_fetch_array($result_query);
                                    // 리뷰 pk
                                    $review_pk_num = $review_number;
                                    // 리뷰 작성자의 이미지
                                    $review_writer_img = $row['user_img'];
                                    // 리뷰 작성자의 닉네임
                                    $review_writer_nickname = $row['user_nickname'];
                                    // 리뷰 작성자가 평가한 평점
                                    $review_writer_rating = $review_rating;
                                    // 리뷰 좋아요 수
                                    $review_like_count = $row['review_like'];
                                    // 리뷰 등록 일자
                                    $review_register_date = $row['review_regtime'];
                                    // 반복문의 넘버
                                    $while_num = $main_list - 1;
                                    // 영화의 제목
                                    $movie_subject = $mv_title;
                                    // 한줄평
                                    $short_review_content = $row['review_short'];
                                    // 장문평
                                    $long_review_content = $row['review_long'];
                                    // 세션 유저의 넘버
                                    if (isset($_SESSION['user_num'])) {
                                        $session_user_num = $_SESSION['user_num'];
                                    } else {
                                        $session_user_num = "";
                                    }

                                    include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/review/review_modal.php";
                                    // review_dialog_trigger 클래스가 버튼 역할을 함
                                    ?>
                                    <li class="css-MainList-li e3fgkal0">
                                        <!-- 영화 6층 a -->
                                        <a title="<?= $mv_title ?>" href="#" class="review_dialog_trigger"
                                           onclick="return false;">
                                            <!-- 6층 포스터 -->
                                            <div class="css-MainContentPosterBlock e3fgkal1">
                                                <!-- 포스터 설정 -->
                                                <div class=" css-MainPosterBlock-MainPosterBlock ewlo9840">
                                                    <img src="<?= $mv_img_path ?>"
                                                         class="css-StyledMainPosterBlock ewlo9841">
                                                </div>
                                                <!-- 포스터 랭크 -->
                                                <div class="css-RankBadge e3fgkal7"><?= $main_list ?></div>
                                            </div>
                                            <!-- 6층 설명 -->
                                            <div class="css-MainContentBlock e3fgkal2">
                                                <!-- 영화설명_제목 -->
                                                <div class="css-ContentTitle e3fgkal3"><?= $mv_title ?></div>
                                                <!-- 영화설명_출시년도 -->
                                                <div class="css-StyledContentYear ebeya3l12"><?= $mv_release_date ?></div>
                                                <!-- 영화설명_평점 -->
                                                <div class="average css-MainContentRating-StyledContentRating ebeya3l14">
                                                    <span>평점</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                         viewBox="0 0 12 12" fill="#555765"
                                                         class="css-IcRatingStarSvg erjycaa0">
                                                        <path class="fillTarget" fill="#6A6B76" fill-rule="evenodd"
                                                              d="M5.637 8.02L2.779 9.911c-.138.092-.324.054-.415-.084-.048-.073-.063-.162-.04-.246l.916-3.302L.56 4.145c-.13-.103-.152-.292-.048-.421.054-.068.134-.11.221-.113l3.424-.15 1.2-3.21c.058-.155.23-.233.386-.175.081.03.146.094.176.175l1.2 3.21 3.424.15c.165.007.294.147.286.313-.003.086-.045.167-.112.221L8.034 6.28l.915 3.302c.045.16-.049.325-.209.37-.083.022-.173.008-.245-.04L5.637 8.02z"></path>
                                                    </svg>
                                                    <span><?= $review_rating ?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;좋아요 : <?= $review_like ?></span>

                                                </div>
                                            </div>
                                        </a>
                                    </li><!-- END 영화 5층 li -->
                                    <?php
                                    $main_list++;
                                } // END while
                                ?>
                            </ul> <!-- END 영화 4층 ul -->
                        </div> <!-- END 영화 3층 -->
                    </div> <!-- END 영화 2층 -->
                </div> <!-- END 영화 1층 -->
                <!-- 영화로비_왼쪽버튼 -->
                <div class="arrow_button css-ArrowButtonBlock-left e1f5xhlb3"
                     direction="left">
                    <div class="css-BackwardButton-left e1f5xhlb6"></div>
                </div>
                <!-- 영화로비_오른쪽버튼 -->
                <div class="arrow_button css-ArrowButtonBlock-right e1f5xhlb3"
                     direction="right">
                    <div class="css-ForwardButton-right e1f5xhlb5">
                        <!-- 영화로비_오른쪽버튼 img -->
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDEyIDE2Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZD0iTTAgMEgxMlYxNkgweiIvPgogICAgICAgIDxwYXRoIGZpbGw9IiMyOTJBMzIiIHN0cm9rZT0iIzI5MkEzMiIgc3Ryb2tlLXdpZHRoPSIuMzUiIGQ9Ik0zLjQyOSAxMy40MDlMNC4zNTQgMTQuMjU4IDEwLjY4IDguNDYgMTEuMTQzIDguMDM2IDQuMzU0IDEuODEzIDMuNDI5IDIuNjYyIDkuMjkxIDguMDM2eiIvPgogICAgPC9nPgo8L3N2Zz4K"
                             alt="forward">


                        >>>>>>> leesi


                    </div>
                </div>
            </div> <!-- END 영화로비 -->
        </div>
    </div> <!-- END 타이틀과 영화항목 베스트리뷰 -->
</div><!-- END 베스트 리뷰 리스트 -->

<?php
$sql = "select * from review R inner join movie M on R.mv_num = M.mv_num order by review_regtime desc";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
?>
<!-- 리뷰 전체 리스트 -->
<div class="css-MainDiv ebeya3l11">
    <!-- 타이틀과 영화항목 최근리뷰 -->
    <div class="css-MainListContainer ebeya3l2">
        <!-- 타이틀 -->
        <div class="css-MainListTitleRow-MainListTitleRow ebeya3l3">
            <!-- 타이틀 설정 -->
            <p class="css-StyledMainListTitle ebeya3l6">Recent Reivew</p>
        </div>
        <!-- 영화항목 -->
        <div class="css-StyledMainScrollOuterContainer ebeya3l4">
            <!-- 영화 로비 -->
            <div class="css-ScrollBarContainer e1f5xhlb0">
                <!-- 영화 1층 -->
                <div class="css-ScrollBar e1f5xhlb1">
                    <!-- 영화 2층 -->
                    <div class="css-ScrollingTaim recent_review">
                        <!-- 영화 3층 -->
                        <div class="css-StyledMainScrollingTaimContainer ebeya3l5">
                            <!-- 영화 4층 ul -->
                            <ul class="css-StyledMainUl-StyledMainUlContentPosterList-RowList eykn4p10">
                                <!-- 영화 5층 li -->
                                <?php
                                $main_list3 = 1;
                                $result_count = mysqli_num_rows($result);
                                while ($row = mysqli_fetch_array($result)) {
                                    $mv_num = $row['mv_num'];
                                    $review_rating = $row['review_rating'];
                                    $review_number = $row['review_num'];
                                    $mv_release_date = $row['mv_release_date'];
                                    $mv_title = $row['mv_title'];
                                    $mv_img_path = $row['mv_img_path'];

                                    // *****************************
                                    // 리뷰 모달에서 사용하는 변수, 여기에 매치하면 됨
                                    // *****************************
                                    $query = "select user_img, user_nickname, review_like, review_regtime, review_short, review_long  
                                              from review R
                                              inner join user U
                                              on R.user_num = U.user_num
                                              where review_num = $review_number;";
                                    $result_query = mysqli_query($con, $query) or die(mysqli_error($con));
                                    $row = mysqli_fetch_array($result_query);
                                    // 리뷰 pk
                                    $review_pk_num = $review_number;
                                    // 리뷰 작성자의 이미지
                                    $review_writer_img = $row['user_img'];
                                    // 리뷰 작성자의 닉네임
                                    $review_writer_nickname = $row['user_nickname'];
                                    // 리뷰 작성자가 평가한 평점
                                    $review_writer_rating = $review_rating;
                                    // 리뷰 좋아요 수
                                    $review_like_count = $row['review_like'];
                                    // 리뷰 등록 일자
                                    $review_register_date = $row['review_regtime'];
                                    // 반복문의 넘버 : 1부터 시작하는데 js에서 필요한 건 0부터 시작
                                    $while_num = $main_list3 + $main_list - 2;
                                    // 영화의 제목
                                    $movie_subject = $mv_title;
                                    // 한줄평
                                    $short_review_content = $row['review_short'];
                                    // 장문평
                                    $long_review_content = $row['review_long'];
                                    // 세션 유저의 넘버
                                    if (isset($_SESSION['user_num'])) {
                                        $session_user_num = $_SESSION['user_num'];
                                    }

                                    include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/review/review_modal.php";
                                    // review_dialog_trigger 클래스가 버튼 역할을 함
                                    ?>
                                    <!--DB 결과 수    -->
                                    <input type="hidden" name="result_count"
                                           id="result_count"
                                           value="<?= $result_count ?>">
                                    <li class="css-MainList-li e3fgkal0">
                                        <!-- 영화 6층 a -->
                                        <a title="<?= $mv_title ?>" href="#"
                                           class="review_dialog_trigger"
                                           onclick="return false;">
                                            <!-- 6층 포스터 -->
                                            <div class="css-MainContentPosterBlock e3fgkal1">
                                                <!-- 포스터 설정 -->
                                                <div class=" css-MainPosterBlock-MainPosterBlock ewlo9840">
                                                    <img src="<?= $mv_img_path ?>"
                                                         class="css-StyledMainPosterBlock ewlo9841">
                                                </div>
                                                <!-- 포스터 랭크 -->
                                                <div class="css-RankBadge e3fgkal7"><?= $main_list3 ?></div>
                                            </div>
                                            <!-- 6층 설명 -->
                                            <div class="css-MainContentBlock e3fgkal2">
                                                <!-- 영화설명_제목 -->
                                                <div class="css-ContentTitle e3fgkal3"><?= $mv_title ?></div>
                                                <!-- 영화설명_출시년도 -->
                                                <div class="css-StyledContentYear ebeya3l12"><?= $mv_release_date ?></div>
                                                <!-- 영화설명_평점 -->
                                                <div class="average css-MainContentRating-StyledContentRating ebeya3l14">
                                                    <span>평점</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         width="13" height="13"
                                                         viewBox="0 0 12 12"
                                                         fill="#555765"
                                                         class="css-IcRatingStarSvg erjycaa0">
                                                        <path class="fillTarget"
                                                              fill="#6A6B76"
                                                              fill-rule="evenodd"
                                                              d="M5.637 8.02L2.779 9.911c-.138.092-.324.054-.415-.084-.048-.073-.063-.162-.04-.246l.916-3.302L.56 4.145c-.13-.103-.152-.292-.048-.421.054-.068.134-.11.221-.113l3.424-.15 1.2-3.21c.058-.155.23-.233.386-.175.081.03.146.094.176.175l1.2 3.21 3.424.15c.165.007.294.147.286.313-.003.086-.045.167-.112.221L8.034 6.28l.915 3.302c.045.16-.049.325-.209.37-.083.022-.173.008-.245-.04L5.637 8.02z"></path>
                                                    </svg>
                                                    <span><?= $review_rating ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li><!-- END 영화 5층 li -->
                                    <?php
                                    $main_list3++;
                                } // END while
                                ?>
                            </ul>
                        </div>
                    </div>
                </div> <!-- END 영화 1층 -->
                <!-- 영화로비_양쪽 틈 -->
                <div direction="left" class="css-CheatBlock-left"></div>
                <div direction="right" class="css-CheatBlock-right"></div>

                <!-- 영화로비_왼쪽버튼 -->
                <div class="arrow_button css-ArrowButtonBlock-left e1f5xhlb3"
                     direction="left">
                    <div class="css-BackwardButton-left e1f5xhlb6"></div>
                </div>
                <!-- 영화로비_오른쪽버튼 -->
                <div class="arrow_button css-ArrowButtonBlock-right e1f5xhlb3"
                     direction="right">
                    <div class="css-ForwardButton-right e1f5xhlb5"
                         id="total_review_right">
                        <!-- 영화로비_오른쪽버튼 img -->
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDEyIDE2Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZD0iTTAgMEgxMlYxNkgweiIvPgogICAgICAgIDxwYXRoIGZpbGw9IiMyOTJBMzIiIHN0cm9rZT0iIzI5MkEzMiIgc3Ryb2tlLXdpZHRoPSIuMzUiIGQ9Ik0zLjQyOSAxMy40MDlMNC4zNTQgMTQuMjU4IDEwLjY4IDguNDYgMTEuMTQzIDguMDM2IDQuMzU0IDEuODEzIDMuNDI5IDIuNjYyIDkuMjkxIDguMDM2eiIvPgogICAgPC9nPgo8L3N2Zz4K"
                             alt="forward">
                    </div>
                </div>
            </div> <!-- END 영화로비 -->
        </div>
    </div> <!-- END 타이틀과 영화항목 최근리뷰 -->
</div><!-- END 리뷰 전체 리스트 -->

<?php
$sql = "select R.review_rating, R.review_short, M.mv_title, M.mv_img_path, U.user_nickname from review R 
            inner join movie M on R.mv_num = M.mv_num
            inner join user U on R.user_num = U.user_num
            order by R.review_regtime desc;";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
?>
<!-- 서브 총 리스트 -->
<div class="css-MainDiv ebeya3l11">
    <!-- 타이틀과 영화항목 서브리뷰 -->
    <div class="css-MainListContainer ebeya3l2">
        <!-- 타이틀 -->
        <div class="css-MainListTitleRow-MainListTitleRow ebeya3l3">
            <!-- 타이틀 설정 -->
            <p class="css-StyledMainListTitle ebeya3l6">서브 리뷰</p>
        </div>
        <!-- 영화항목 -->
        <div class="css-StyledMainScrollOuterContainer ebeya3l4">
            <!-- 영화 로비 -->
            <div class="css-ScrollBarContainer e1f5xhlb0">
                <!-- 영화 1층 -->
                <div class="css-ScrollBar e1f5xhlb1">
                    <!-- 영화 2층 -->
                    <div class="css-Sub1-ScrollingTaim e1f5xhlb2">
                        <!-- 영화 3층 -->
                        <div class="css-StyledMainScrollingTaimContainer ebeya3l5">
                            <!-- 영화 4층 ul -->
                            <ul class="css-StyledMainUl-StyledMainUlContentPosterList-RowList eykn4p10">
                                <!-- 영화 5층 li -->
                                <?php
                                $main_list4 = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    $mv_title = $row['mv_title'];
                                    $review_rating = $row['review_rating'];
                                    $review_short = $row['review_short'];
                                    $mv_img_path = $row['mv_img_path'];
                                    $user_nickname = $row['user_nickname'];

                                    // *****************************
                                    // 리뷰 모달에서 사용하는 변수, 여기에 매치하면 됨
                                    // *****************************
                                    $query = "select user_img, user_nickname, review_like, review_regtime, review_short, review_long  
                    from review R
                    inner join user U
                    on R.user_num = U.user_num
                    where review_num = $review_number;";
                                    $result_query = mysqli_query($con, $query) or die(mysqli_error($con));
                                    $row = mysqli_fetch_array($result_query);
                                    // 리뷰 pk
                                    $review_pk_num = $review_number;
                                    // 리뷰 작성자의 이미지
                                    $review_writer_img = $row['user_img'];
                                    // 리뷰 작성자의 닉네임
                                    $review_writer_nickname = $row['user_nickname'];
                                    // 리뷰 작성자가 평가한 평점
                                    $review_writer_rating = $review_rating;
                                    // 리뷰 좋아요 수
                                    $review_like_count = $row['review_like'];
                                    // 리뷰 등록 일자
                                    $review_register_date = $row['review_regtime'];
                                    // 반복문의 넘버 : 1부터 시작하는데 js에서 필요한 건 0부터 시작
                                    $while_num = $main_list4 + $main_list3 + $main_list - 3;
                                    // 영화의 제목
                                    $movie_subject = $mv_title;
                                    // 한줄평
                                    $short_review_content = $row['review_short'];
                                    // 장문평
                                    $long_review_content = $row['review_long'];
                                    // 세션 유저의 넘버
                                    if (isset($_SESSION['user_num'])) {
                                        $session_user_num = $_SESSION['user_num'];
                                    }
                                    include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/review/review_modal.php";
                                    // review_dialog_trigger 클래스가 버튼 역할을 함
                                    ?>
                                    <li class="css-MainList-li e3fgkal0">
                                        <!-- 영화 6층 a -->
                                        <a title="<?= $mv_title ?>" href="#"
                                           class="review_dialog_trigger"
                                           onclick="return false;">
                                            <!-- 6층 포스터 -->
                                            <div class="css-MainContentPosterBlock e3fgkal1">
                                                <!-- 포스터 설정 -->
                                                <div class=" css-MainPosterBlock-MainPosterBlock ewlo9840">
                                                    <img src="<?= $mv_img_path ?>"
                                                         class="css-StyledMainPosterBlock ewlo9841">
                                                </div>
                                            </div>
                                            <!-- 서브리스트 div 영화설명 -->
                                            <div class="css-dmreg0-ContentInfo e3fgkal2">
                                                <!-- 서브리스트 div 영화제목 -->
                                                <div class="css-1teivyt-ContentTitle e3fgkal3"><?= $mv_title ?></div>
                                                <!-- 서브리스트 div 영화평점 -->
                                                <div class="average css-MainContentRating-StyledContentRating ebeya3l14">
                                                    <span>평점</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         width="13" height="13"
                                                         viewBox="0 0 12 12"
                                                         fill="#555765"
                                                         class="css-IcRatingStarSvg erjycaa0">
                                                        <path class="fillTarget"
                                                              fill="#6A6B76"
                                                              fill-rule="evenodd"
                                                              d="M5.637 8.02L2.779 9.911c-.138.092-.324.054-.415-.084-.048-.073-.063-.162-.04-.246l.916-3.302L.56 4.145c-.13-.103-.152-.292-.048-.421.054-.068.134-.11.221-.113l3.424-.15 1.2-3.21c.058-.155.23-.233.386-.175.081.03.146.094.176.175l1.2 3.21 3.424.15c.165.007.294.147.286.313-.003.086-.045.167-.112.221L8.034 6.28l.915 3.302c.045.16-.049.325-.209.37-.083.022-.173.008-.245-.04L5.637 8.02z"></path>
                                                    </svg>
                                                    <span><?= $review_rating ?></span>
                                                </div>
                                                <!-- 서브리스트 div 리뷰작성자 -->
                                                <div class="css-1teivyt-ContentShortMemberNick">
                                                    작성자
                                                    : <?= $user_nickname ?></div>
                                                <!-- 서브리스트 div 영화리뷰 -->
                                                <div class="css-1teivyt-ContentShort"><?= $review_short ?></div>
                                            </div>
                                        </a>
                                    </li><!-- END 영화 5층 li -->
                                    <?php
                                    $main_list4++;
                                } // END while
                                ?>
                            </ul>
                        </div>
                    </div>
                </div> <!-- END 영화 1층 -->
                <!-- 영화로비_양쪽 틈 -->
                <div direction="left" class="css-CheatBlock-left"></div>
                <div direction="right" class="css-CheatBlock-right"></div>
                <!-- 영화로비_왼쪽버튼 -->
                <div class="arrow_button css-ArrowButtonBlock-left e1f5xhlb3"
                     direction="left">
                    <div class="css-Sub1-BackwardButton-left e1f5xhlb6"></div>
                </div>
                <!-- 영화로비_오른쪽버튼 -->
                <div class="arrow_button css-ArrowButtonBlock-right e1f5xhlb3"
                     direction="right">
                    <div class="css-Sub1-ForwardButton-right e1f5xhlb5">
                        <!-- 영화로비_오른쪽버튼 img -->
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDEyIDE2Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZD0iTTAgMEgxMlYxNkgweiIvPgogICAgICAgIDxwYXRoIGZpbGw9IiMyOTJBMzIiIHN0cm9rZT0iIzI5MkEzMiIgc3Ryb2tlLXdpZHRoPSIuMzUiIGQ9Ik0zLjQyOSAxMy40MDlMNC4zNTQgMTQuMjU4IDEwLjY4IDguNDYgMTEuMTQzIDguMDM2IDQuMzU0IDEuODEzIDMuNDI5IDIuNjYyIDkuMjkxIDguMDM2eiIvPgogICAgPC9nPgo8L3N2Zz4K"
                             alt="forward">
                    </div>
                </div>
            </div> <!-- END 영화로비 -->
        </div>
    </div> <!-- END 타이틀과 영화항목 서브리뷰 -->
</div><!-- END 서브 총 리스트 -->

<?php
$sql = "select R.review_rating, R.review_short, M.mv_title, M.mv_img_path, U.user_nickname from review R 
            inner join movie M on R.mv_num = M.mv_num
            inner join user U on R.user_num = U.user_num
            order by R.review_regtime desc;";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
?>
<!-- 한줄리뷰 총 리스트 -->
<div class="css-gxko42-StyledHomeListContainer ebeya3l2">
    <!-- 타이틀과 영화항목 장르리스트 -->
    <div class="css-1ewd6nb-StyledHomeListTitleRow-StyledHomeListTitleRow ebeya3l3">
        <!-- 타이틀 -->
        <p class="css-1e8eq80-StyledHomeListTitle ebeya3l6">한줄평 리뷰</p>
    </div>
    <!-- 장르별리스트 div 로비 -->
    <div class="css-1pik52h-StyledHorizontalScrollOuterContainer ebeya3l4">
        <!-- 장르별리스트 div 1층 -->
        <div class="css-1yw8v4t-ScrollBarContainer e1f5xhlb0">
            <!-- 장르별리스트 div 2층 -->
            <div class="css-chidac-ScrollBar e1f5xhlb1">
                <!-- 장르별리스트 div 3층 -->
                <div class="css-150y45-ScrollingInner e1f5xhlb2">
                    <!-- 장르별리스트 ul -->
                    <ul class="ebeya3l0 css-oudgax-VisualUl-StyledHorizontalUl-StyledHorizontalUlWithContentPosterList-RowList eykn4p10">
                        <?php
                        $main_list5 = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $mv_title = $row['mv_title'];
                            $review_rating = $row['review_rating'];
                            $review_short = $row['review_short'];
                            $mv_img_path = $row['mv_img_path'];
                            $user_nickname = $row['user_nickname'];
                            ?>
                            <!-- 장르별리스트 li -->
                            <li class="css-106b4k6-Self e3fgkal0">
                                <!-- 장르별리스트 a -->
                                <a title="<?= $mv_title ?>" href="#"
                                   onclick="return false;">
                                    <!-- 장르별리스트 div 영화포스터 -->
                                    <div class="css-wg9zzb-ContentPosterBlock e3fgkal1">
                                        <!-- 장르별리스트 img -->
                                        <div class=" e1pon7hn0 css-1hdc5d8-Self-LazyLoadingImg ewlo9840">
                                            <!-- 장르별리스트 img 설정 -->
                                            <img src="<?= $mv_img_path ?>"
                                                 class=" e1pon7hn0 css-1onlrbk-Img-LazyLoadingImg ewlo9841"
                                                 alt="">
                                            <!-- 장르별리스트 img 스템프 -->
                                            <div class="ottBadge css-cq1n1p-OttBadge e3fgkal8"
                                                 src="" alt="왓챠!">dd
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 장르별리스트 div 영화설명 -->
                                    <div class="css-dmreg0-ContentInfo e3fgkal2">
                                        <!-- 장르별리스트 div 영화제목 -->
                                        <div class="css-1teivyt-ContentTitle e3fgkal3"><?= $mv_title ?></div>
                                        <!-- 장르별리스트 div 영화평점 -->
                                        <div class="average css-MainContentRating-StyledContentRating ebeya3l14">
                                            <span>평점</span>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="13" height="13"
                                                 viewBox="0 0 12 12"
                                                 fill="#555765"
                                                 class="css-IcRatingStarSvg erjycaa0">
                                                <path class="fillTarget"
                                                      fill="#6A6B76"
                                                      fill-rule="evenodd"
                                                      d="M5.637 8.02L2.779 9.911c-.138.092-.324.054-.415-.084-.048-.073-.063-.162-.04-.246l.916-3.302L.56 4.145c-.13-.103-.152-.292-.048-.421.054-.068.134-.11.221-.113l3.424-.15 1.2-3.21c.058-.155.23-.233.386-.175.081.03.146.094.176.175l1.2 3.21 3.424.15c.165.007.294.147.286.313-.003.086-.045.167-.112.221L8.034 6.28l.915 3.302c.045.16-.049.325-.209.37-.083.022-.173.008-.245-.04L5.637 8.02z"></path>
                                            </svg>
                                            <span><?= $review_rating ?></span>
                                        </div>
                                        <!-- 장르별리스트 div 리뷰작성자 -->
                                        <div class="css-1teivyt-ContentShortMemberNick">
                                            작성자
                                            : <?= $user_nickname ?></div>
                                        <!-- 장르별리스트 div 영화리뷰 -->
                                        <div class="css-1teivyt-ContentShort"><?= $review_short ?></div>
                                    </div>
                                </a>
                            </li>
                            <?php
                            $main_list5++;
                        } // END while
                        ?>
                    </ul>
                </div>
            </div>
            <!-- 장르별리스트 div 로비 양쪽 틈 -->
            <div direction="left"
                 class="css-1piyrvy-CheatBlock e1f5xhlb4"></div>
            <div direction="right"
                 class="css-1avws16-CheatBlock e1f5xhlb4"></div>
            <!-- 장르별리스트 div 로비 왼쪽버튼 -->
            <div class="arrow_button css-1d4tu36-ArrowButtonBlock e1f5xhlb3"
                 direction="left">
                <div class="css-1o4i6uc-BackwardButton e1f5xhlb6"></div>
            </div>
            <!-- 장르별리스트 div 로비 오른쪽버튼 -->
            <div class="arrow_button css-cj0kkg-ArrowButtonBlock e1f5xhlb3"
                 direction="right">
                <div class="css-kb0601-ForwardButton e1f5xhlb5">
                    <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDEyIDE2Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZD0iTTAgMEgxMlYxNkgweiIvPgogICAgICAgIDxwYXRoIGZpbGw9IiMyOTJBMzIiIHN0cm9rZT0iIzI5MkEzMiIgc3Ryb2tlLXdpZHRoPSIuMzUiIGQ9Ik0zLjQyOSAxMy40MDlMNC4zNTQgMTQuMjU4IDEwLjY4IDguNDYgMTEuMTQzIDguMDM2IDQuMzU0IDEuODEzIDMuNDI5IDIuNjYyIDkuMjkxIDguMDM2eiIvPgogICAgPC9nPgo8L3N2Zz4K"
                         alt="forward">
                </div>
            </div>
        </div><!-- END 장르별리스트 div 1층 -->
    </div><!-- END 장르별리스트 div 로비 -->
</div><!-- END 한줄리뷰 총 리스트 -->
