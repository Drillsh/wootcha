<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/common_class_value.php"; ?>
    <title> WOOTCHA </title>

    <!-- CSS, JS 파일 링크 시, -->
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/common/css/common.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/css/admin_page.css">
    <link rel="stylesheet" href="./css/gm_members.css">
    <link rel="stylesheet" href="./css/nav.css">
    <!-- jquery -->
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="./js/admin.js"></script>
    <script src="js/members.js"></script>
    <!-- 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Jua|Montserrat&display=swap" rel="stylesheet">
    <!-- 아이콘 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <!-- 차트 -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <title>WOOTCHA</title>
    <!-- Date 라이브러리 -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
    </header>
    <section>
        <div class="my_info_content">
            <div class="left_menu">
                <!-- 순서대로쭉쭉 -->
                <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/admin/admin_side_left_menu.php"; ?>
            </div>
            <div class="right_content">
                <main>
                    <?php
                    include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";

                    $y = isset($_GET["y"]) ? $_GET["y"] : date("Y");
                    $m = isset($_GET["m"]) ? $_GET["m"] : date("n");
                    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
                    $col = isset($_GET["col"]) ? $_GET["col"] : '';
                    $search = isset($_GET["search"]) ? $_GET["search"] : '';

                    ?>
                    <!-- php 변수를 자바스크립트로 넘겨줌 -->
                    <script>
                        var y = <?=$y?>;
                        var m = <?=$m?>;
                        var page = "<?=$page?>";
                        var col = "<?=$col?>";
                        var search = "<?=$search?>";
                    </script>

                    <section>
                        <div class="sec_top">
                            <span onclick="prevDateChange('review_mng')"><i class="fas fa-angle-left"></i></span>
                            <select id="top_select_year" dir="rtl" onchange="topSelect_init_Setting('review_mng')">
                                <?php
                                for ($i = 2018; $i <= date("Y"); $i++) {
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>
                            <span>년 </span>
                            <select id="top_select_month" dir="rtl" onchange="hrefDateChange('review_mng')">
                                <?php
                                $last_m = $y == date("Y") ? date("n") : 12;
                                for ($i = 1; $i <= $last_m; $i++) {
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>
                            <span>월 </span>
                            <span onclick="nextDateChange('review_mng')"><i class="fas fa-angle-right"></i></span>
                        </div>
                        <!--end of 년 월 선택바 -->

                        <?php
                        $m2 = $m < 10 ? "0" . $m : $m;
                        $sql = "SELECT 
                                COUNT(*) AS count 
                                FROM
                                review
                                WHERE
                                review_regtime BETWEEN '19-01-01' AND LAST_DAY('$y-$m2-01');";

                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($result);
                        $total_review = mysqli_num_rows($result);

                        //이달의 리뷰평점
                        $sql = "SELECT 
                                AVG(total_star) `ts`,
                                AVG(facility) `fc`,
                                AVG(acsbl) `asc`,
                                AVG(teacher)  `tc`,
                                AVG(cost_efct) `ce`,
                                AVG(achievement) `acm`
                                FROM
                                review
                                WHERE 
                                DATE_FORMAT(review_regtime, '%Y%m%d') 
                                BETWEEN 
                                DATE_FORMAT('$y-$m2-01', '%Y%m%d') 
                                AND 
                                DATE_FORMAT(LAST_DAY('$y-$m2-01'), '%Y%m%d')";

                        $result = mysqli_query($con, $sql);

                        $review_avg = 0;
                        if ($result) {
                            $row = mysqli_fetch_array($result);
                            $ts = $row['ts'];
                            $fc = $row['fc'];
                            $asc = $row['asc'];
                            $tc = $row['tc'];
                            $ce = $row['ce'];
                            $acm = $row['acm'];
                            $review_avg = ($ts + $fc + $asc + $tc + $ce + $acm) / 6;
                        }

                        ?>
                        <!-- 총 리뷰수 가져오기 -->
                        <div class="sec_content">
                            <div id="dash_topline">
                                <div>
                                    <span>전체 리뷰</span><br>
                                    <span class="dash_topline_i"><i
                                                class="fas fa-box-open"></i>&nbsp;<span><?= $total_review ?></span></span>
                                    <span class="caret up"> </i></span>
                                </div>
                                <div>
                                    <span>신규 리뷰</span><br>
                                    <span class="dash_topline_i"><i class="fas fa-edit"></i>&nbsp;<span
                                                id="new_review_cnt"></span></span>
                                    <span class="caret up"> </i></span>
                                </div>
                                <div>
                                    <span>이달의 리뷰평점</span><br>
                                    <span class="dash_topline_i"><i
                                                class="fas fa-star"></i>&nbsp;<span><?= sprintf('%0.1f', round($review_avg, 1)) ?></span></span>
                                    <span class="caret down"> </i></span>
                                </div>
                            </div>
                            <!--end of 상단 이달의 리뷰정보-->

                            <div id="g_members_totalGraph_wrap">
                                <div id="g_members_totalGraph_cell1">
                                    <h4><i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;Review
                                        Graph<span>단위: 건</span></h4>
                                    <canvas id="review_totalGraph"></canvas>

                                </div>
                            </div>
                            <!-- end of 회원수 변화 그래프 -->

                            <div style="display:flex; width:960px; margin-bottom: 50px;">
                                <div id="dash_good_key_wrap">
                                    <h4><i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;Good keyword</h4>
                                    <div id="good_key"></div>
                                    <div id="not_found_keyword1"></div>
                                </div>
                                <div id="dash_bad_key_wrap">
                                    <h4><i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;Bad keyword</h4>
                                    <div id="bad_key"></div>
                                    <div id="not_found_keyword2"></div>
                                </div>
                            </div>
                            <!-- end of 그래프 3개 -->

                            <div id="g_members_list_wrap">
                                <div id="g_members_list">
                                    <h4>
                                        <i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;Review Management
                                        <div class="selectbox">
                                            <select id="search_select">
                                                <option>영화 제목</option>
                                                <option>글쓴이</option>
                                                <option>한줄평</option>
                                                <option>별점</option>
                                                <option>등록일</option>
                                            </select>
                                        </div>
                                        <div class='search-box'>
                                            <div class='search-form'>
                                                <input class='form-control' placeholder='검색어를 입력하세요' type='text'>
                                                <button class='btn btn-link search-btn' onclick="onclickSearch()">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </h4>
                                    <!-- end of 검색창 -->

                                    <div class="list_edit_delete_wrap">
                                        <button onclick="submitDelete()">삭제</button>
                                    </div>
                                    <ul id="member_list">
                                        <li>
                                            <span class="col1">No</span>
                                            <span class="col2">영화 제목</span>
                                            <span class="col3">글쓴이</span>
                                            <span class="col4">한줄평</span>
                                            <span class="col5">별점</span>
                                            <span class="col6">등록일</span>
                                        </li>
                                        <?php
                                        if ($col != '' && $search != '') {
                                            $sql = "SELECT 
                                                     review_num,
                                                     mv_num,
                                                     user_num,
                                                     review_short,
                                                     review_rating,
                                                     review_regtime
                                                 FROM
                                                     review
                                                 WHERE
                                                     $col LIKE '%$search%'
                                                    ORDER BY regist_day DESC";
                                        } else {
                                            $sql = "SELECT
                                                     review_num,
                                                     mv_num,
                                                     user_num,
                                                     review_short,
                                                     review_rating,
                                                     review_regtime
                                                  FROM
                                                      review
                                                  ORDER BY review_regtime DESC";
                                        }

                                        $result = mysqli_query($con, $sql);

                                        if (mysqli_num_rows($result)) {
                                            $total_record = mysqli_num_rows($result);

                                            $scale = 10; // 가져올 글 수

                                            // 전체 페이지 수($total_page) 계산
                                            if ($total_record % $scale == 0)
                                                $total_page = floor($total_record / $scale);
                                            else
                                                $total_page = floor($total_record / $scale) + 1;

                                            // 표시할 페이지($page)에 따라 $truncated_num(한페이지에서 10개 리스트 보여지고 그 뒤 짤리는 넘버) 계산
                                            $truncated_num = ($page - 1) * $scale;
                                            $start_num = $total_record - $truncated_num;

                                            //게시판 맨 상단 번호
                                            $number = $total_record - $truncated_num;

                                            for ($i = $truncated_num; $i < $truncated_num + $scale && $i < $total_record; $i++) {
                                                // 가져올 레코드로 위치(포인터) 이동
                                                mysqli_data_seek($result, $i);
                                                $row = mysqli_fetch_array($result);
                                                $no = $row["review_num"];
                                                $mv_name = $row["mv_num"];
                                                $id = $row["user_num"];
                                                $one_line = $row["review_short"];
                                                $rating = $row["review_rating"];
                                                $regist_day = $row["review_regtime"];
                                                ?>
                                                <li class="list_row">
                                                    <form method="post" action="#">
                                                        <input type="hidden" name="no[]" value="<?= $no ?>" readonly>
                                                        <span class="col1"><?= $number ?></span>
                                                        <span class="col2 left-align"><?= $mv_name ?></span>
                                                        <span class="col3"><?= $id ?></span>
                                                        <span class="col4 left-align"><?= $one_line ?></span>
                                                        <span class="col5"><?= sprintf('%0.1f', round($rating, 1)) ?></span>
                                                        <span class="col6"><?= $regist_day ?></span>
                                                    </form>
                                                </li>

                                                <?php
                                                $number--;
                                            }
                                            mysqli_close($con);
                                        } else {
                                            echo "검색결과가 없습니다";
                                            $total_page = 0;
                                        }

                                        ?>
                                    </ul>
                                    <!-- end of ul 회원리스트 -->

                                    <div class="page_num_wrap">
                                        <div class="page_num">
                                            <ul class="page_num_ul">
                                                <?php
                                                $page_scale = 5; // 페이지 쪽수 표시 량 (5 페이지씩 표기)
                                                $pageGroup = ceil($page / $page_scale); // 페이지 그룹번호(페이지 5개가 1그룹)

                                                $last_page = $pageGroup * $page_scale; //그룹번호 안에서의 마지막 페이지 숫자
                                                //그룹번호의 마지막 페이지는 전체 페이지보다 클 수 없음
                                                if ($total_page < $page_scale) {
                                                    $last_page = $total_page;
                                                } else if ($last_page > $total_page) {
                                                    $last_page = $total_page;
                                                }

                                                //그룹번호의 첫번째 페이지 숫자
                                                $first_page = $last_page - ($page_scale - 1);
                                                //그룹번호의 첫번째 페이지는 1페이지보다 작을 수 없음
                                                if ($first_page < 1) {
                                                    $first_page = 1;
                                                } else if ($last_page == $total_page) { //마지막 그룹번호일때 첫번째 페이지값 결정
                                                    if ($total_page % $page_scale == 0) {
                                                        $first_page = $total_page - $page_scale + 1;
                                                    } else {
                                                        $first_page = $total_page - ($total_page % $page_scale) + 1;
                                                    }
                                                }
                                                echo "<script>console.log($first_page, $last_page)</script>";

                                                $next = $last_page + 1;// > 버튼 누를때 나올 페이지
                                                $prev = $first_page - 1;// < 버튼 누를때 나올 페이지

                                                $url = "/wootcha/admin/admin_review.php?y=$y&m=$m";
                                                if ($search != '') {
                                                    $url .= "&col=$col&search=$search";
                                                }
                                                // 첫번째 페이지일 때 앵커 비활성화
                                                if ($first_page == 1) {
                                                    if ($page != 1)
                                                        echo "<li><a href='$url&page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                                    else
                                                        echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";

                                                    echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                                                } else {
                                                    echo "<li><a href='$url&page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                                                    echo "<li><a href='$url&page=$prev'><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                                                }


                                                //페이지 번호 매기기
                                                for ($i = $first_page; $i <= $last_page; $i++) {
                                                    if ($page == $i) {
                                                        echo "<li><span class='page_num_set'><b style='color:#2E89FF'> $i </b></span></li>";
                                                    } else {
                                                        echo "<li><a href='$url&page=$i'><span class='page_num_set'> &nbsp$i&nbsp </span></a></li>";
                                                    }
                                                }

                                                // 마지막 페이지일 때 앵커 비활성화
                                                if ($last_page == $total_page) {
                                                    echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";

                                                    if ($page != $total_page)
                                                        echo "<li><a href='$url&page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                                                    else
                                                        echo "<li><a><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";

                                                } else {
                                                    echo "<li><a href='$url&page=$next'><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";
                                                    echo "<li><a href='$url&page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            </div><!-- end of right_content -->

    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
    </footer>
</body>

</html>