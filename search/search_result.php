<body onload="setSelectSear();">
    <div class="body_wrap">
        <div class="follow_list_wrap">
            <div class="follow_list_background">
                <?php
                //페이지 수 체크한다.
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                }

                // 추후 따로 모아서 임포트
//                include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/search/movie_naver_api_func.php";

                //검색어 있을때
                if ($search != "") {
                    //네이버 검색 함수
                    $result = Movie_info::search_movie_title($search, $country, $genre);
                    $total_record = count($result);

                    //정렬 요청이 있을때
                    if (isset($selected_option)) {
                        switch ($selected_option) {
                            case 'naver_star':
                                foreach ($result as $key => $value) {
                                    $sort[$key] = $value['userRating'];
                                }
                                array_multisort($sort, SORT_DESC, $result);
                                break;
                            case 'wootcha_star':
                                echo "<script>alert('웃챠 사용자 별점');</script>";
                                break;
                            default:
                                break;
                        }
                    }

                    //검색어 없을때
                } else if ($search == "") {
                    $total_record = 0;
                }
                ?>

                <!-- select box -------------------------------------------------------------------------------------->
                <div class="follow_list_select">
                    <h2>
                        <span id="view_all_search"></span>
                        <span id="view_all_review">영화 리스트 (전체)</span>
                        <span id="view_all_title"></span>
                    </h2>

                    <span id="follow_total_span">총 <span id="follow_total_num"><?= $total_record ?></span> 개의 영화가 있습니다.</span>

                    <!--정렬 선택 박스-->
                    <div class="follow_select">
                        <select name="follow_list_select_mode" id="follow_list_select_mode" onchange="selectOption('<?=$search;?>', '<?=$country;?>', '<?=$genre;?>');">
                            <option value="default" selected>정렬/순서 선택</option>
                            <option value="naver_star">네이버 별점순</option>
                            <option value="wootcha_star">웃챠 별점순</option>
                        </select>
                    </div>
                </div>

                <!-- start of ul ------------------------------------------------------------------------------------->

                <ul class="follow_unorder_list">
                    <?php
                    $scale = 10;

                    if ($total_record % $scale == 0) {
                        $total_page = floor($total_record / $scale);
                    } else {
                        $total_page = floor($total_record / $scale) + 1;
                    }

                    $page_setting = ($page - 1) * $scale;

                    $page_start = $total_record - $page_setting;

                    for ($i = $page_setting;
                    $i < $page_setting + $scale && $i < $total_record;
                    $i++) {

                    // 영화 정보 가져오기
                    $item = $result[$i]; //인덱스
                    $title = $item['title']; // 영화 제목
                    $subTitle = $item["subtitle"]; // 부제
                    $small_poster_img = $item["image"]; // 포스터
                    $naver_star = $item["userRating"]; // 네이버 평점
                    $naver_star = sprintf('%0.1f', $naver_star);
                    $naverLink = $item["link"];   //네이버 영화 링크

                    $review_count = 0; // 리뷰 수
                    $story_count = 0; //스토리 수
                    ?>

                    <li>
                        <div class="follow_list_column">

                            <!--json으로 영화 데이터 보냄-->
                            <a href="/wootcha/movie_introduce_page/movie_introduce_index.php?item=<?=urlencode(json_encode($item))?>">
                                <div class="follow_list_column_img">
                                    <?php
                                    if ($small_poster_img == "") {
                                        ?>
                                        <!--엑박 방지 디폴트 이미지-->
                                        <img src=<?= $small_poster_img ?>>
                                        <?php
                                    } else {
                                        ?>
                                        <img src=<?= $small_poster_img ?> alt="">
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="follow_list_column_text">
                                    <h1 id="follow_text_academy"><?= $title ?>
                            </a>

                            </h1>
                            <p id="follow_text_district"><?= $subTitle ?></p>

                            <div class="follow_list_column_review">
                                <a href="/eduplanet/academy/review.php?no=<?= $item ?>"><span id="academy_review_span">학원리뷰 <span
                                                id="academy_review_num"><?= $review_count ?></span></span></a>
                                <a href="/eduplanet/academy/acd_story.php?no=<?= $item ?>"><span id="academy_review_span">스토리 <span
                                                id="academy_review_num"><?= $story_count ?></span></span></a>

                            </div>
                        </div>

                        <!-- 오른쪽 별점 & 삭제버튼 -->
                        <div class="follow_list_column_sub">

                            <div class="follow_academy_heart">
                                <span>학원 찜하기</span>
                                <?php
                                //                                if ($gm_no) {
                                //
                                //
                                //                                    $sql7 = "select * from follow where user_no = $gm_no and acd_no = $no ";
                                //                                    $result7 = mysqli_query($con, $sql7);
                                //                                    $row7 = mysqli_fetch_array($result7);
                                //
                                //
                                //                                    if ($row7) {
                                //                                        echo "
                                //
                                //                                              <a href='/eduplanet/acd_story/unfollow.php?no=$no'><button type='button' id='button_academy_heart_on'>like</button></a>
                                //                                            ";
                                //                                    } else {
                                //                                        echo "
                                //                                              <a href='/eduplanet/acd_story/follow.php?no=$no'><button type='button' id='button_academy_heart_off'>like</button></a>
                                //                                              ";
                                //                                    }
                                //
                                //                                    ?>

                                <!--                                    --><?php
                                //                                } else {
                                //                                    ?>
                                <!---->
                                <!---->
                                <a href="javascript:alert('일반회원만 이용 가능합니다.')">
                                    <button type="button" id="button_academy_heart_off">like</button>
                                </a>
                                <!---->
                                <!--                                    --><?php
                                //                                }
                                //                                ?>
                            </div>

                            <div class="follow_academy_star_wrap">

                                <div class="follow_academy_star">
                                    <?php
                                    // 총 만족도 평균에 따라 별 보여주기
                                    for ($j = 1; $j <= 5; $j++) {

                                        if ($j <= round($naver_star)) {
                                            echo "<img class='acd_star_class' src='/wootcha/common/img/yellow_star.png' alt='follow_academy_star'>";
                                        } else {
                                            echo "<img class='acd_star_class' src='/wootcha/common/img/yellow_star_empty.png' alt='follow_academy_star'>";
                                        }
                                    }
                                    ?>
                                </div>
                                <span class="follow_academy_star_num"><?= $naver_star ?></span>
                            </div>
                        </div>
            </div>
            </li>

            <?php
            $page_start--;
            }

            ?>

            </ul>
            <!-- end of ul ------------------------------------------------------------------>

            <div class="page_num_wrap">
                <div class="page_num">
                    <ul class="page_num_ul">

                        <?php

                        $url = '/eduplanet/acd_list/view_all.php?';

                        if (isset($_GET["sort"])) {
                            $url .= "&sort=$selectSort";
                        }
                        if (isset($_GET["district"])) {
                            $url .= "&district=$selectDis";
                        }
                        if (isset($_GET["search"])) {
                            $url .= "&search=$search";
                        }

                        // 페이지 쪽수 표시 량 (5 페이지씩 표기)
                        $page_scale = 5;

                        // 페이지 그룹번호(페이지 5개가 1그룹)
                        $pageGroup = ceil($page / $page_scale);

                        //그룹번호 안에서의 마지막 페이지 숫자
                        $last_page = $pageGroup * $page_scale;

                        // 그룹번호의 마지막 페이지는 전체 페이지보다 클 수 없음
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

                            //마지막 그룹번호일때 첫번째 페이지값 결정
                        } else if ($last_page == $total_page) {

                            if ($total_page % $page_scale == 0) {
                                $first_page = $total_page - $page_scale + 1;
                            } else {
                                $first_page = $total_page - ($total_page % $page_scale) + 1;
                            }
                        }

                        $next = $last_page + 1; // > 버튼 누를때 나올 페이지
                        $prev = $first_page - 1; // < 버튼 누를때 나올 페이지

                        // $url = "/eduplanet/acd_list/view_all.php?"; 바꾸기 귀찮으니까 써라 나중에
                        // 첫번째 페이지일 때 앵커 비활성화
                        if ($first_page == 1) {

                            if ($page != 1) {
                                echo "<li><a href='$url&page=1'><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                            } else {
                                echo "<li><a><span class='page_num_direction'><i class='fas fa-angle-double-left'></i></span></a></li>";
                            }

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

                            if ($page != $total_page) {
                                echo "<li><a href='$url&page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                            } else {
                                echo "<li><a><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                            }
                        } else {
                            echo "<li><a href='$url&?page=$next'><span class='page_num_direction'><i class='fas fa-angle-right'></i></span></a></li>";
                            echo "<li><a href='$url&page=$total_page'><span class='page_num_direction_last'><i class='fas fa-angle-double-right'></i></span></a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- end of page_num_wrap -------------------------------------------------------->
        </div>
    </div>
</body>