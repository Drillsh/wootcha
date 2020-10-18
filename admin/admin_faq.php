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
    <script src="./js/board_function.js"></script>
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
    <?php
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $col = isset($_GET["col"]) ? $_GET["col"] : '';
    $search = isset($_GET["search"]) ? $_GET["search"] : '';
    ?>
        <div class="my_info_content">
            <div class="left_menu">
                <!-- 순서대로쭉쭉 -->
                <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/admin/admin_side_left_menu.php"; ?>
            </div>
            <div class="right_content">
                <main>
                    <?php
                    include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";
                    ?>
                        <!-- 총 리뷰수 가져오기 -->
                        <div class="sec_content">
                            <div id="g_members_list_wrap">
                                <div id="g_members_list">
                                    <h4>
                                        <i class="fas fa-chart-line"></i>&nbsp;&nbsp;&nbsp;FAQ Management
                                        <div class="selectbox">
                                            <select id="search_select">
                                                <option>제목</option>
                                                <option>글쓴이</option>
                                                <option>내용</option>
                                                <option>댓글 위치</option>
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
                                    <ul id="board_list">
                                        <li>
                                            <span class="col1">No</span>
                                            <span class="col2">공지 제목</span>
                                            <span class="col3">글쓴이</span>
                                            <span class="col4">내용</span>
                                            <!-- <span class="col5">댓글 위치</span> -->
                                            <span class="col6">등록일</span>
                                            <span class="col7"></span>
                                        </li>
                                        <?php
                                        if ($col != '') {
                                            $sql = "SELECT 
                                                     faq_num,
                                                     faq_title,
                                                     faq_contents,
                                                     faq_hit,
                                                     faq_regtime
                                                    --  review_reply_regtime    
                                                 FROM
                                                     faq_board
                                                 WHERE
                                                    --  $col LIKE '%$search%'
                                                    ORDER BY faq_regtime DESC";
                                        } else {
                                            $sql = "SELECT
                                                    faq_num,
                                                     faq_title,
                                                     faq_contents,
                                                     faq_hit,
                                                     faq_regtime
                                                  FROM
                                                  faq_board
                                                  ORDER BY faq_regtime DESC";
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
                                            $truncated_num = ($total_page - 1) * $scale;
                                            $start_num = $total_record - $truncated_num;
                                           
                                            
                                            //게시판 맨 상단 번호
                                            $number = $total_record - $truncated_num; 
                                              
                                            for ($i = $truncated_num; $i < $truncated_num + $scale && $i < $total_record; $i++) {
                                                // 가져올 레코드로 위치(포인터) 이동
                                                mysqli_data_seek($result, $i);
                                                $row = mysqli_fetch_array($result);
                                                $num = $row["faq_num"];
                                                $title = $row["faq_title"];
                                                $id = $row["faq_contents"];
                                                $reply_content = $row["faq_hit"];
                                                $regist_day = $row["faq_regtime"];
                                                ?>
                                                <li class="list_row">
                                                    <form method="post" action="#">
                                                        <input type="hidden" name="no[]" value="<?= $num ?>" readonly>
                                                        <span class="col1"><?= $number ?></span>
                                                        <a href="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/fnq/fnq_view.php?num=<?=$num?>&page=<?=$page?>"><span class="col2 left-align"><?= $title?></span></a>                               
                                                        <span class="col3">관리자</span>
                                                        <span class="col4 left-align"><?= $id ?></span>
                                                        <span class="col6"><?= $regist_day ?></span>
                                                        <span class="col7"><input type="checkbox" name="no[]" id="item<?=$i?>" value="<?=$num?>">

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

                                                $url = "/wootcha/admin/admin_faq.php?y=$y&m=$m";
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