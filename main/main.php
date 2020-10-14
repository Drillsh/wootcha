<!-- 상단 슬라이드 -->
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


<?php
  include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/crawling/movie_cgv_crawling.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/search/movie_naver_api_func.php";

  $sql = "select * from review R inner join movie M on R.mv_num = M.mv_num order by review_like desc limit 5";
  $result = mysqli_query($con, $sql);
?>
<!-- 베스트 총 리스트 -->
<div class="css-89vjyi-MainSection ebeya3l11">
  <!-- 타이틀과 영화항목 베스트리뷰 -->
  <div class="css-gxko42-StyledHomeListContainer ebeya3l2">
    <!-- 타이틀 -->
    <div class="css-1ewd6nb-StyledHomeListTitleRow-StyledHomeListTitleRow ebeya3l3">
      <!-- 타이틀 설정 -->
      <p class="css-1e8eq80-StyledHomeListTitle ebeya3l6">베스트 리뷰</p>
    </div>
    <!-- 영화항목 -->
    <div class="css-gc1vu8-StyledHorizontalScrollOuterContainer ebeya3l4">
      <!-- 영화 로비 -->
      <div class="css-cjxm4v-ScrollBarContainer e1f5xhlb0">
        <!-- 영화 1층 -->
        <div class="css-chidac-ScrollBar e1f5xhlb1">
          <!-- 영화 2층 -->
          <div class="css-150y45-ScrollingInner e1f5xhlb2">
            <!-- 영화 3층 -->
            <div class="css-6kwoq4-StyledHorizontalScrollInnerContainer ebeya3l5">
              <!-- 영화 4층 ul -->
              <ul class="ebeya3l0 css-wvdjot-VisualUl-StyledHorizontalUl-StyledHorizontalUlWithContentPosterList-RowList eykn4p10">
                <!-- 영화 5층 li -->
                <?php
                  $main_list=1;
                  while($row = mysqli_fetch_array($result)){
                   $mv_num = $row['mv_num'];
                   $review_rating = $row['review_rating'];
                   $mv_release_date = $row['mv_release_date'];
                   $mv_title = $row['mv_title'];
                   $mv_img_path = $row['mv_img_path'];
                ?>
                <li class="css-106b4k6-Self e3fgkal0">
                  <!-- 영화 6층 a -->
                  <a title="<?=$mv_title?>" href="#">
                    <!-- 6층 포스터 -->
                    <div class="css-wg9zzb-ContentPosterBlock e3fgkal1">
                      <!-- 포스터 설정 -->
                      <div class=" e1pon7hn0 css-1hdc5d8-Self-LazyLoadingImg ewlo9840">
                        <img src="<?=$mv_img_path?>" class="e1pon7hn0 css-1onlrbk-Img-LazyLoadingImg ewlo9841">
                      </div>
                      <!-- 포스터 랭크 -->
                      <div class="css-13ot87v-RankBadge e3fgkal7"><?=$main_list?></div>
                    </div>
                    <!-- 6층 설명 -->
                    <div class="css-dmreg0-ContentInfo e3fgkal2">
                      <!-- 영화설명_제목 -->
                      <div class="css-1teivyt-ContentTitle e3fgkal3"><?=$mv_title?></div>
                      <!-- 영화설명_출시년도 -->
                      <div class="css-6t186m-StyledContentYearAndNation ebeya3l12"><?=$mv_release_date?></div>
                      <!-- 영화설명_평점 -->
                      <div class="average css-uaqea0-ContentRating-StyledContentRating ebeya3l14">
                        <span>평점</span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 12 12" fill="#555765" class="css-a4gmui-IcRatingStarSvg erjycaa0">
                            <path class="fillTarget" fill="#6A6B76" fill-rule="evenodd" d="M5.637 8.02L2.779 9.911c-.138.092-.324.054-.415-.084-.048-.073-.063-.162-.04-.246l.916-3.302L.56 4.145c-.13-.103-.152-.292-.048-.421.054-.068.134-.11.221-.113l3.424-.15 1.2-3.21c.058-.155.23-.233.386-.175.081.03.146.094.176.175l1.2 3.21 3.424.15c.165.007.294.147.286.313-.003.086-.045.167-.112.221L8.034 6.28l.915 3.302c.045.16-.049.325-.209.37-.083.022-.173.008-.245-.04L5.637 8.02z"></path>
                          </svg>
                        <span><?=$review_rating?></span>
                      </div>
                    </div>
                  </a>
                </li><!-- END 영화 5층 li -->
                <?php
                  $main_list++;
                  } // END while
                ?>
              </ul>
            </div>
          </div>
        </div> <!-- END 영화 1층 -->
      </div> <!-- END 영화로비 -->
    </div>
  </div> <!-- END 타이틀과 영화항목 베스트리뷰 -->
</div><!-- END 베스트 총 리스트 -->

<?php
  $sql = "select R.mv_num, count(R.mv_num) as count, M.mv_title, M.mv_release_date, M.mv_img_path, R.review_rating, R.review_num 
  from review R left join movie M on R.mv_num = M.mv_num group by R.mv_num order by count desc;";
  $result = mysqli_query($con, $sql) or die(mysqli_error($con));
?>
<!-- 최다 코멘트 총 리스트 -->
<div class="css-89vjyi-MainSection ebeya3l11">
  <!-- 타이틀과 영화항목 최다리뷰 -->
  <div class="css-gxko42-StyledHomeListContainer ebeya3l2">
    <!-- 타이틀 -->
    <div class="css-1ewd6nb-StyledHomeListTitleRow-StyledHomeListTitleRow ebeya3l3">
      <!-- 타이틀 설정 -->
      <p class="css-1e8eq80-StyledHomeListTitle ebeya3l6">베스트 코멘트</p>
    </div>
    <!-- 영화항목 -->
    <div class="css-gc1vu8-StyledHorizontalScrollOuterContainer ebeya3l4">
      <!-- 영화 로비 -->
      <div class="css-cjxm4v-ScrollBarContainer e1f5xhlb0">
        <!-- 영화 1층 -->
        <div class="css-chidac-ScrollBar e1f5xhlb1">
          <!-- 영화 2층 -->
          <div class="css-150y45-ScrollingInner e1f5xhlb2">
            <!-- 영화 3층 -->
            <div class="css-6kwoq4-StyledHorizontalScrollInnerContainer ebeya3l5">
              <!-- 영화 4층 ul -->
              <ul class="ebeya3l0 css-wvdjot-VisualUl-StyledHorizontalUl-StyledHorizontalUlWithContentPosterList-RowList eykn4p10">
                <!-- 영화 5층 li -->
                <?php
                  $main_list2=1;
                  while($row = mysqli_fetch_array($result)){
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
                    // 반복문의 넘버 
                    $while_num = $main_list + $main_list2-1; 
                    // 영화의 제목
                    $movie_subject = $mv_title;
                    // 한줄평
                    $short_review_content = $row['review_short'];
                    // 장문평
                    $long_review_content = $row['review_long'];
                    // 세션 유저의 넘버
                    $session_user_num = $_SESSION['user_num'];

                    include $_SERVER['DOCUMENT_ROOT']."/wootcha/review/review_modal.php";
                    // review_dialog_trigger 클래스가 버튼 역할을 함
                ?>
                <li class="css-106b4k6-Self e3fgkal0">
                  <!-- 영화 6층 a -->
                  <a title="<?=$mv_title?>" href="#" class="review_dialog_trigger">
                    <!-- 6층 포스터 -->
                    <div class="css-wg9zzb-ContentPosterBlock e3fgkal1">
                      <!-- 포스터 설정 -->
                      <div class=" e1pon7hn0 css-1hdc5d8-Self-LazyLoadingImg ewlo9840">
                        <img src="<?=$mv_img_path?>" class="e1pon7hn0 css-1onlrbk-Img-LazyLoadingImg ewlo9841">
                      </div>
                      <!-- 포스터 랭크 -->
                      <div class="css-13ot87v-RankBadge e3fgkal7"><?=$main_list2?></div>
                    </div>
                    <!-- 6층 설명 -->
                    <div class="css-dmreg0-ContentInfo e3fgkal2">
                      <!-- 영화설명_제목 -->
                      <div class="css-1teivyt-ContentTitle e3fgkal3"><?=$mv_title?></div>
                      <!-- 영화설명_출시년도 -->
                      <div class="css-6t186m-StyledContentYearAndNation ebeya3l12"><?=$mv_release_date?></div>
                      <!-- 영화설명_평점 -->
                      <div class="average css-uaqea0-ContentRating-StyledContentRating ebeya3l14">
                        <span>평점</span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 12 12" fill="#555765" class="css-a4gmui-IcRatingStarSvg erjycaa0">
                            <path class="fillTarget" fill="#6A6B76" fill-rule="evenodd" d="M5.637 8.02L2.779 9.911c-.138.092-.324.054-.415-.084-.048-.073-.063-.162-.04-.246l.916-3.302L.56 4.145c-.13-.103-.152-.292-.048-.421.054-.068.134-.11.221-.113l3.424-.15 1.2-3.21c.058-.155.23-.233.386-.175.081.03.146.094.176.175l1.2 3.21 3.424.15c.165.007.294.147.286.313-.003.086-.045.167-.112.221L8.034 6.28l.915 3.302c.045.16-.049.325-.209.37-.083.022-.173.008-.245-.04L5.637 8.02z"></path>
                          </svg>
                        <span><?=$review_rating?></span>
                      </div>
                    </div>
                  </a>
                </li><!-- END 영화 5층 li -->
                <?php
                  $main_list2++;
                  } // END while
                ?>
              </ul>
            </div>
          </div>
        </div> <!-- END 영화 1층 -->
        <!-- 영화로비_양쪽 틈 -->
        <div direction="left" class="css-7lqh27-CheatBlock e1f5xhlb4"></div>
        <div direction="right" class="css-xypm4l-CheatBlock e1f5xhlb4"></div>
      </div> <!-- END 영화로비 -->
    </div>
  </div> <!-- END 타이틀과 영화항목 최다리뷰 -->
</div><!-- END 최다 코멘트 총 리스트 -->

<?php
  $sql = "select * from review R inner join movie M on R.mv_num = M.mv_num order by review_regtime desc";
  $result = mysqli_query($con, $sql) or die(mysqli_error($con));
?>
<!-- 최근 총 리스트 -->
<div class="css-89vjyi-MainSection ebeya3l11">
  <!-- 타이틀과 영화항목 최근리뷰 -->
  <div class="css-gxko42-StyledHomeListContainer ebeya3l2">
    <!-- 타이틀 -->
    <div class="css-1ewd6nb-StyledHomeListTitleRow-StyledHomeListTitleRow ebeya3l3">
      <!-- 타이틀 설정 -->
      <p class="css-1e8eq80-StyledHomeListTitle ebeya3l6">최근 리뷰</p>
    </div>
    <!-- 영화항목 -->
    <div class="css-gc1vu8-StyledHorizontalScrollOuterContainer ebeya3l4">
      <!-- 영화 로비 -->
      <div class="css-cjxm4v-ScrollBarContainer e1f5xhlb0">
        <!-- 영화 1층 -->
        <div class="css-chidac-ScrollBar e1f5xhlb1">
          <!-- 영화 2층 -->
          <div class="css-150y45-ScrollingInner e1f5xhlb2">
            <!-- 영화 3층 -->
            <div class="css-6kwoq4-StyledHorizontalScrollInnerContainer ebeya3l5">
              <!-- 영화 4층 ul -->
              <ul class="ebeya3l0 css-wvdjot-VisualUl-StyledHorizontalUl-StyledHorizontalUlWithContentPosterList-RowList eykn4p10">
                <!-- 영화 5층 li -->
                <?php
                  $main_list3 = 1;
                  while($row = mysqli_fetch_array($result)){
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
                    $while_num = $main_list3-1; 
                    // 영화의 제목
                    $movie_subject = $mv_title;
                    // 한줄평
                    $short_review_content = $row['review_short'];
                    // 장문평
                    $long_review_content = $row['review_long'];
                    // 세션 유저의 넘버
                    $session_user_num = $_SESSION['user_num'];

                    include $_SERVER['DOCUMENT_ROOT']."/wootcha/review/review_modal.php";
                    // review_dialog_trigger 클래스가 버튼 역할을 함
                ?>
                <li class="css-106b4k6-Self e3fgkal0">
                  <!-- 영화 6층 a -->
                  <a title="<?=$mv_title?>" href="#" class="review_dialog_trigger">
                    <!-- 6층 포스터 -->
                    <div class="css-wg9zzb-ContentPosterBlock e3fgkal1">
                      <!-- 포스터 설정 -->
                      <div class=" e1pon7hn0 css-1hdc5d8-Self-LazyLoadingImg ewlo9840">
                        <img src="<?=$mv_img_path?>" class="e1pon7hn0 css-1onlrbk-Img-LazyLoadingImg ewlo9841">
                      </div>
                      <!-- 포스터 랭크 -->
                      <div class="css-13ot87v-RankBadge e3fgkal7"><?=$main_list3?></div>
                    </div>
                    <!-- 6층 설명 -->
                    <div class="css-dmreg0-ContentInfo e3fgkal2">
                      <!-- 영화설명_제목 -->
                      <div class="css-1teivyt-ContentTitle e3fgkal3"><?=$mv_title?></div>
                      <!-- 영화설명_출시년도 -->
                      <div class="css-6t186m-StyledContentYearAndNation ebeya3l12"><?=$mv_release_date?></div>
                      <!-- 영화설명_평점 -->
                      <div class="average css-uaqea0-ContentRating-StyledContentRating ebeya3l14">
                        <span>평점</span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 12 12" fill="#555765" class="css-a4gmui-IcRatingStarSvg erjycaa0">
                            <path class="fillTarget" fill="#6A6B76" fill-rule="evenodd" d="M5.637 8.02L2.779 9.911c-.138.092-.324.054-.415-.084-.048-.073-.063-.162-.04-.246l.916-3.302L.56 4.145c-.13-.103-.152-.292-.048-.421.054-.068.134-.11.221-.113l3.424-.15 1.2-3.21c.058-.155.23-.233.386-.175.081.03.146.094.176.175l1.2 3.21 3.424.15c.165.007.294.147.286.313-.003.086-.045.167-.112.221L8.034 6.28l.915 3.302c.045.16-.049.325-.209.37-.083.022-.173.008-.245-.04L5.637 8.02z"></path>
                          </svg>
                        <span><?=$review_rating?></span>
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
        <div direction="left" class="css-7lqh27-CheatBlock e1f5xhlb4"></div>
        <div direction="right" class="css-xypm4l-CheatBlock e1f5xhlb4"></div>
        <!-- 영화로비_왼쪽버튼 -->
        <div class="arrow_button css-19lj8ig-ArrowButtonBlock e1f5xhlb3" direction="left">
          <div class="css-1o4i6uc-BackwardButton e1f5xhlb6"></div>
        </div>
        <!-- 영화로비_오른쪽버튼 -->
        <div class="arrow_button css-1leja6c-ArrowButtonBlock e1f5xhlb3" direction="right">
          <div class="css-kb0601-ForwardButton e1f5xhlb5">
            <!-- 영화로비_오른쪽버튼 img -->
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDEyIDE2Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZD0iTTAgMEgxMlYxNkgweiIvPgogICAgICAgIDxwYXRoIGZpbGw9IiMyOTJBMzIiIHN0cm9rZT0iIzI5MkEzMiIgc3Ryb2tlLXdpZHRoPSIuMzUiIGQ9Ik0zLjQyOSAxMy40MDlMNC4zNTQgMTQuMjU4IDEwLjY4IDguNDYgMTEuMTQzIDguMDM2IDQuMzU0IDEuODEzIDMuNDI5IDIuNjYyIDkuMjkxIDguMDM2eiIvPgogICAgPC9nPgo8L3N2Zz4K" alt="forward">
          </div>
        </div> 
      </div> <!-- END 영화로비 -->
    </div>
  </div> <!-- END 타이틀과 영화항목 최근리뷰 -->
</div><!-- END 최근 총 리스트 -->

<!-- 장르별 총 리스트 -->
<div class="css-gxko42-StyledHomeListContainer ebeya3l2">
  <!-- 타이틀과 영화항목 장르리스트 -->
  <div class="css-1ewd6nb-StyledHomeListTitleRow-StyledHomeListTitleRow ebeya3l3">
    <!-- 타이틀 -->
    <p class="css-1e8eq80-StyledHomeListTitle ebeya3l6">장르별 영화</p>
  </div>
  <!-- 장르별리스트 div 로비 css여기까지만 작업했음 지금 만드는 틀 전부 만들고 작업 ㄱㄱ -->
  <div class="css-1pik52h-StyledHorizontalScrollOuterContainer ebeya3l4">
    <!-- 장르별리스트 div 1층 -->
    <div class="css-1yw8v4t-ScrollBarContainer e1f5xhlb0">
      <!-- 장르별리스트 div 로비 양쪽 틈 -->
      <div direction="left" class="css-1piyrvy-CheatBlock e1f5xhlb4"></div>
      <div direction="right" class="css-1avws16-CheatBlock e1f5xhlb4"></div>
      <!-- 장르별리스트 div 로비 왼쪽버튼 -->
      <div class="arrow_button css-1d4tu36-ArrowButtonBlock e1f5xhlb3" direction="left">
        <div class="css-1o4i6uc-BackwardButton e1f5xhlb6"></div>
      </div>
      <!-- 장르별리스트 div 로비 오른쪽버튼 -->
      <div class="arrow_button css-cj0kkg-ArrowButtonBlock e1f5xhlb3" direction="right">
        <div class="css-kb0601-ForwardButton e1f5xhlb5">
          <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDEyIDE2Ij4KICAgIDxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+CiAgICAgICAgPHBhdGggZD0iTTAgMEgxMlYxNkgweiIvPgogICAgICAgIDxwYXRoIGZpbGw9IiMyOTJBMzIiIHN0cm9rZT0iIzI5MkEzMiIgc3Ryb2tlLXdpZHRoPSIuMzUiIGQ9Ik0zLjQyOSAxMy40MDlMNC4zNTQgMTQuMjU4IDEwLjY4IDguNDYgMTEuMTQzIDguMDM2IDQuMzU0IDEuODEzIDMuNDI5IDIuNjYyIDkuMjkxIDguMDM2eiIvPgogICAgPC9nPgo8L3N2Zz4K" alt="forward">
        </div>
      </div>
    </div><!-- END 장르별리스트 div 1층 -->
  </div><!-- END 장르별리스트 div 로비 -->
</div><!-- END 장르별 총 리스트 -->










<!-- 기존 영화리스트 -->
<div class="main_center">
<div class="main_all">

    <span class="main_title" class="sub_title">테스트 &nbsp;:::&nbsp; BEST REVIEW LIST</span>

    <?php
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
          mysqli_close($con);
      ?>

    </div>
  </div> <!-- end 배스트리스트 -->

<div class="main_all_reviewlist">

    <span class="main_title_reviewlist" class="sub_title">테스트 &nbsp;:::&nbsp; 최근 리뷰</span>

    <?php
      // $sql = "select * from review R inner join movie M on R.mv_num = M.mv_num order by review_date desc";
      // $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    ?>

      <div class="search_member_reviewlist">

    <?php
      // while($row = mysqli_fetch_array($result)){
      //   $user_num = $row['user_num'];
      //   $mv_num = $row['mv_num'];
      //   $review_rating = $row['review_rating'];
      //   $review_short = $row['review_short'];
      //   $review_long = $row['review_long'];
      //   $mv_title = $row['mv_title'];
      //   $img_link = get_cgv_movie_middle_poster_url($mv_title);
      ?>

            <a class="main_a_contentbox" href="#">
              <p class="summary_first_reviewlist">
                <img src="">
                  <span class="summary_span_title_reviewlist"></span>
                  <span class="summary_span_rating_reviewlist"></span>
                  <span class="summary_span_user_num_reviewlist"></span>
                  <span class="summary_span_short_reviewlist"></span>
                  <span class="summary_span_long_reviewlist"></span>
              </p>
            </a>

      <?php
        // }
        //   mysqli_close($con);
      ?>

    </div>
</div> <!-- end 무비리스트 -->
</div>



