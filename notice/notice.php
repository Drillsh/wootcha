<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>공지사항</title>
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/notice/css/board.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/notice/css/greet.css">

    <link rel="stylesheet" href="./css/gm_members.css">
    <link rel="stylesheet" href="./css/nav.css">
    
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/common_class_value.php"; ?>
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php"; ?>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>

    </header>
    <section id="notice_section">
        <div id="board_box">
            <div>
                <h3>
                    공지사항 > 목록보기
                </h3>
            </div> <!--공지사항  -->
            <div>
                <?php
                //isset으로 겟 모드로 들어왔는지 확인하고 겟방식으로 들어온 모드가 search인지 확인
                if (isset($_GET["mode"]) && $_GET["mode"] == "search") {
                    //제목, 내용, 아이디

                    //입력받은 find search값의 데이터에 불필요한 것이 없도록 test input으로 검사
                    $find = test_input($_POST["find"]);
                    $search = test_input($_POST["search"]);
                    //우리가 string을 입력할때 Tom's cat 이란 입력을 하면  '는 sql문에 앞서 있던 ' 와 중첩이 될 수 있다.
                    //이러한 문제를 막기위해 \n, \r \" 처럼 구별해주는 형태로 만들어주는 것을 Escape string 이라고 한다.
                    $q_search = mysqli_real_escape_string($con, $search);
                    $sql = "SELECT * from `notice_board` where $find like '%$q_search%' order by notice_num desc;";
                } else {
                    $sql = "select * from notice_board order by notice_num desc";
                }

                if (isset($_GET["page"]))
                    $page = $_GET["page"];
                else
                    $page = 1;

                $result = mysqli_query($con, $sql);
                $total_record = mysqli_num_rows($result); // 전체 글 수

                $scale = 10;// 가져올 글 수

                // 전체 페이지 수($total_page) 계산
                if ($total_record % $scale == 0)
                    $total_page = floor($total_record / $scale);
                else
                    $total_page = floor($total_record / $scale) + 1;

                // 표시할 페이지($page)에 따라 $start 계산
                $start = ($page - 1) * $scale;
                //게시판 맨 상단 번호
                $number = $total_record - $start;
                ?>
                <form name="board_form" action="notice.php?mode=search" method="post">
                    <div id="list_search">
                        <div id="list_search1">총 <?= $total_record ?>개의 게시물이 있습니다.</div>
                        <div id="list_search2"><img src="./img/select_search.gif"></div>
                        <div id="list_search3">
                            <select name="find">
                                <option value="notice_title">제목</option>
                                <option value="notice_contents">내용</option>
                                <!-- <option value="nick">별명</option>
                                <option value="name">이름</option>
                                <option value="id">아이디</option> -->
                            </select>
                        </div><!--end of list_search3  -->
                        <!-- 검색기능 -->
                        <div id="list_search4"><input type="text" name="search"></div>
                        <div id="list_search5"><input type="image" src="./img/list_search_button.gif"></div>
                    </div><!--end of list_search  -->
                </form>
            </div>

            <div>
                <ul id="board_list">
                    <li>
                        <span class="col1">번호</span>
                        <span class="col2">제목</span>
                        <span class="col3">글쓴이</span>
                        <span class="col5">등록일</span>
                        <span class="col6">조회</span>
                    </li>

                    <?php
                    for ($i = $start; $i < $start + $scale && $i < $total_record; $i++) {
                        mysqli_data_seek($result, $i);
                        // 가져올 레코드로 위치(포인터) 이동
                        $row = mysqli_fetch_array($result);
                        // 하나의 레코드 가져오기
                        $num = $row["notice_num"];
                        echo "<script>console.log($i, $num)</script>";
                        $title = $row["notice_title"];
                        $content = $row["notice_contents"];
                        //   $subject     = $row["notice_hit"];
                        $regist_day = $row["notice_regtime"];
                        $hit = $row["notice_hit"];
                        ?>
                        <li id="member_list">
                            <span class="col1"><?= $number ?></span>
                            <span class="col2"><a id="noticetitle"
                                                  href="notice_view.php?num=<?= $num ?>&page=<?= $page ?>&hit=<?= $hit + 1 ?>"><?= $title ?></a></span>
                            <span class="col3">관리자</span>
                            <span class="col5"><?= $regist_day ?></span>
                            <span class="col6"><?= $hit ?></span>
                        </li>
                        <?php
                        $number--;
                    }//end of for
                    mysqli_close($con);

                    ?>
                </ul>
            </div>

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

                        $url = "/wootcha/notice/notice.php?";
                        if (isset($search)) {
                            $url .= "&search=$search";
                        }
                        // 첫번째 페이지일 때 앵커 비활성화
                        if ($first_page == 1) {
                            if ($page != 1)
                                echo "<li><a href='{$url}page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                            else
                                echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                            echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                        } else {
                            echo "<li><a href='{$url}page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                            echo "<li><a href='{$url}page=$prev'><span class='page_num_direction'><i class='fas fa-angle-left'></i></span></a></li>";
                        }
                        //페이지 번호 매기기
                        for ($i = $first_page; $i <= $last_page; $i++) {
                            if ($page == $i) {
                                echo "<li><span class='page_num_set'><b style='color:#2E89FF'> $i </b></span></li>";
                            } else {
                                echo "<li><a href='{$url}page=$i'><span class='page_num_set'> &nbsp$i&nbsp </span></a></li>";
                            }
                        }

                        // 마지막 페이지일 때 앵커 비활성화
                        if ($last_page == $total_page) {
                            echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";

                            if ($page != $total_page)
                                echo "<li><a href='{$url}page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                            else
                                echo "<li><a><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";

                        } else {
                            echo "<li><a href='{$url}page=$next'><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";
                            echo "<li><a href='{$url}page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <div id="listwrite">
                    <input class="listwrite" type="image" src="./img/list.png" onclick="location.href='notice.php'">
                    <?php
                    if (isset($_SESSION['user_nickname'])) {
                        if ($_SESSION['user_nickname'] == "admin") { ?>

                            <input class="listwrite" type="image" src="./img/write.png"
                                   onclick="location.href='notice_form.php?page=<?$page?>'">

                            <?php
                        }
                    }
                    ?>
                </div>
            </div><!--end of list content -->

        </div><!--end of col2  -->
        </div><!--end of content -->
        </div><!-- end of box -->
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
    </footer>
</body>
</html>
