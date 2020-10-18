<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/common_class_value.php"; ?>
    <title> WOOTCHA </title>
    <!-- CSS, JS 파일 링크 시, -->
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/common/css/common.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/css/admin_page.css">
    <link rel="stylesheet" href="./css/gm_members.css">
    <link rel="stylesheet" href="./css/nav.css">
    <!-- jquery -->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
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

            <!--내비게이션-->
            <div class="left_menu">
                <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/admin/admin_side_left_menu.php"; ?>
            </div>

            <!--컨텐츠 화면-->
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

                    <div>
                        <!--날짜 선택바 -->
                        <div class="sec_top">
                            <span onclick="prevDateChange('admin_edit_user')"><i class="fas fa-angle-left"></i></span>
                            <select id="top_select_year" dir="rtl" onchange="topSelect_init_Setting('admin_edit_user')">
                                <?php
                                for ($i = 2018; $i <= date("Y"); $i++) {
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>
                            <span>년 </span>
                            <select id="top_select_month" dir="rtl" onchange="hrefDateChange('admin_edit_user')">
                                <?php
                                $last_m = $y == date("Y") ? date("n") : 12;
                                for ($i = 1; $i <= $last_m; $i++) {
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>
                            <span>월 </span>
                            <span onclick="nextDateChange('admin_edit_user')"><i class="fas fa-angle-right"></i></span>
                        </div>

                        <!-- 특정 기간 회원수 가져오기 -->
                        <?php
                        $m2 = $m;
                        if ($m2 < 10) {
                            $m2 = "0" . $m2;
                        }
                        $sql = "SELECT 
                                COUNT(*) AS count 
                                FROM
                                `user`
                                WHERE
                                user_signup_day BETWEEN '19-01-01' AND LAST_DAY('$y-$m2-01');";

                        $result = mysqli_query($con, $sql);
                        $total_m = mysqli_fetch_array($result);

                        ?>

                        <!--상단 회원수 변화-->
                        <div class="sec_content">
                            <div id="dash_topline">
                                <div>
                                    <span>전체 회원</span><br>
                                    <span class="dash_topline_i"><i class="fas fa-user-friends"></i>&nbsp;<span
                                                id="total_m"><?= $total_m[0] ?></span></span>
                                    <span class="caret up">   </i></span>
                                </div>
                                <div>
                                    <span>신규 회원</span><br>
                                    <span class="dash_topline_i"><i class="fas fa-user-plus"></i>&nbsp;<span
                                                id="join_m">0</span></span>
                                    <span class="caret up">   </i></span>
                                </div>
                                <div>
                                    <span>탈퇴회원</span><br>
                                    <span class="dash_topline_i"><i class="fas fa-user-minus"></i>&nbsp;<span
                                                id="wthdr_m">0</span></span>
                                    <span class="caret down">   </i></span>
                                </div>
                            </div>

                            <!--그래프-->
                            <div id="g_members_totalGraph_wrap">
                                <div id="g_members_totalGraph_cell1">
                                    <h4><i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;Member Graph<span>단위: 명</span>
                                    </h4>
                                    <canvas id="g_members_totalGraph"></canvas>

                                </div>
                            </div>

                            <!-- 정보 그래프 파트 -->
                            <div style="display:flex; width:960px; margin-bottom: 50px;">
                                <!-- 회원 연령 그래프-->
                                <div id="dash_age_range_wrap">
                                    <h4><i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;Age range</h4>
                                    <canvas id="dash_age_range"></canvas>
                                </div>

                                <!-- 남녀 비율로 변경 -->
                                <div id="dash_pm_ratio_wrap">
                                    <h4><i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;Gender Ratio</h4>
                                    <canvas id="dash_gender_ratio"></canvas>
                                </div>

                                <!-- 관심사 단어 순위 -->
                                <div id="dash_postGraph_wrap">
                                    <h4><i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;Review Rank</h4>

                                    <div id="dash_review_rank_wrap">
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            ?>
                                            <div class="dash_review_rank_detail">
                                                <span class="dash_review_rank_label">0</span>
                                                <span class="dash_review_rank_data"></span>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- end of 그래프 3개 -->

                            <!-- 회원 리스트 -->
                            <div id="g_members_list_wrap">
                                <div id="g_members_list">
                                    <!-- 리스트 상단 -->
                                    <h4>
                                        <i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;Member Management
                                        <div class="selectbox">
                                            <select id="search_select">
                                                <option>회원번호</option>
                                                <option>이름</option>
                                                <option>닉네임</option>
                                                <option>이메일</option>
                                                <option>연락처</option>
                                                <option>생년월일</option>
                                                <option>가입일</option>
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
                                    <!-- end of 리스트 상단 -->

                                    <!-- 수정, 삭제 -->
                                    <div class="list_edit_delete_wrap">
                                        <button onclick="submitUpdate()">수정</button>
                                        <button onclick="submitDelete()">삭제</button>
                                    </div>

                                    <!-- 리스트 -->
                                    <ul id="member_list">
                                        <li>
                                            <span class="col1">No</span>
                                            <span class="col2">회원 번호</span>
                                            <span class="col3">이름</span>
                                            <span class="col4">닉네임</span>
                                            <span class="col5">메일</span>
                                            <span class="col6">연락처</span>
                                            <span class="col7">성별</span>
                                            <span class="col8">생년월일</span>
                                            <span class="col9">가입일</span>
                                        </li>
                                        <?php
                                        $sql = '';

                                        //검색 조건 셀렉트 박스
                                        if ($col != '' && $search != '') {
                                            $sql = "SELECT * FROM user WHERE $col LIKE '%$search%' ORDER BY user_signup_day DESC";
                                        } else {
                                            $sql = "SELECT * FROM `user` ORDER BY user_signup_day DESC";
                                        }

                                        $result = mysqli_query($con, $sql);
                                        if ($result) {
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
                                                $no = $row["user_num"];
                                                $name = $row['user_name'];
                                                $nickName = $row['user_nickname'];
                                                $mail = $row["user_mail"];
                                                $phone = $row["user_phone"];
                                                $gender = $row["user_gender"];
                                                $age = $row["user_age"];
                                                $regist_day = $row["user_signup_day"];
                                                ?>
                                                <li class="list_row">
                                                    <form method="post" action="#">
                                                        <span class="col1"><?= $number ?></span>
                                                        <span class="col2"><input type="text" name="no[]"
                                                                                  value="<?= $no ?>"
                                                                                  readonly></span>
                                                        <span class="col3"><?= $name ?></span>
                                                        <span class="col4"><input type="text" name="nick[]"
                                                                                  value="<?= $nickName ?>"
                                                                                  maxlength="12"
                                                                                  oninput="limitMaxLength(this)"></span>
                                                        <span class="col5"><?= $mail ?></span>
                                                        <span class="col6"><?= $phone ?></span>
                                                        <span class="col7"><?= $gender ?></span>
                                                        <span class="col8"><?= $age ?></span>
                                                        <span class="col9"><?= $regist_day ?></span>
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

                                                $next = $last_page + 1;// > 버튼 누를때 나올 페이지
                                                $prev = $first_page - 1;// < 버튼 누를때 나올 페이지

                                                $url = "/wootcha/admin/admin_edit_user.php?y=$y&m=$m";
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
                    </div>
                </main>
            </div><!-- end of right_content -->

    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
    </footer>
</body>

</html>