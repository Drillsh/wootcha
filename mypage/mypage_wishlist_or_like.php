<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wootcha</title>
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css?after">
        <link rel="stylesheet" type="text/css" href="./css/mypage.css?after">
        <link rel="stylesheet" type="text/css" href="./css/mypage_wishlist_item.css?after">
        <?php include "../common/database/db_connector.php"?>
        <?php include "./mypage_db_helper.php"?>
        <?php include "../common/crawling/movie_cgv_crawling.php"?>
    </head>
    <body>
        <!-- 헤더 -->
        <header>
            <?php include "../common/page_form/header.php"?>
        </header>

        <!-- 네비게이션 : 왼쪽 -->
        <nav class="nav_left">
            <?php include "./mypage_nav_left.php"?>
        </nav>

        <!-- 섹션 -->
        <section id="section">
            <header class="section_header">
                <!-- mode에 따라 제목 변경 -->
                <?php
                if($_GET['mode'] == 'wish') $title = '내가 보고 싶은 영화';
                elseif($_GET['mode'] == 'like') $title = '좋아요';
                // ***************************************************
                // 나중에 url에 get방식으로 이상한 값 넘겨왔을 때 방지
                // ***************************************************
                ?>
                <span class="title_sub">마이 페이지 &nbsp&nbsp > &nbsp&nbsp <?=$title?></span><br><br>
                <span class="title_main"><?=$title?></span>
            </header>
            <div class="section_container">
                <ul>

                <?php
                // ******************
                // 내가 보고 싶은 영화
                // ******************
                if($_GET['mode'] == 'wish'){
                ?>
                    <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='#'>
                            <img src='./img/movie_poster.jpg' alt="">
                            <h3>영화제목</h3>
                        </a>
                    </li>

                    <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='#'>
                            <img src='./img/movie_poster.jpg' alt="">
                            <h3>영화제목</h3>
                        </a>
                    </li>

                    <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='#'>
                            <img src='./img/movie_poster.jpg' alt="">
                            <h3>영화제목</h3>
                        </a>
                    </li>

                    <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='#'>
                            <img src='./img/movie_poster.jpg' alt="">
                            <h3>영화제목</h3>
                        </a>
                    </li>

                    <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='#'>
                            <img src='./img/movie_poster.jpg' alt="">
                            <h3>영화제목</h3>
                        </a>
                    </li>

                    <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='#'>
                            <img src='./img/movie_poster.jpg' alt="">
                            <h3>영화제목</h3>
                        </a>
                    </li>

                    <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='#'>
                            <img src='./img/movie_poster.jpg' alt="">
                            <h3>영화제목</h3>
                        </a>
                    </li> 

                <?php
                // ******************
                // 좋아요
                // ******************
                }elseif ($_GET['mode'] == 'like') {
                    // // mypage_db_helper 에 정의된 함수
                    // $result = select_data($con, "select_user", "myohoon95@gmail.com");

                    // // 사용자의 pk를 확인
                    // $row = mysqli_fetch_array($result);
                    // $user_num = $row['user_num'];

                    // 좋아하는 영화 리스트
                    $result = select_data($con, "select_my_favorite_movie", $user_num);
                    
                    while($row_review = mysqli_fetch_array($result)){
                        $fav_num = $row_review['fav_num'];
                        $mv_num = $row_review['mv_num'];
                        $mv_title = $row_review['mv_title'];

                        $mv_big_img_link = get_cgv_movie_middle_poster_url($mv_title);
                ?>   
                    <li class='list_item'>
                        <a href='#'>
                            <img src='<?=$mv_big_img_link?>' alt="">
                            <h3><?=$mv_title?></h3>
                        </a>
                    </li> 
                <?php
                    // while문 끝
                    }
                ?>
                    

                    





                <?php
                // mode로 like 와 wish 분기용 if문
                }
                ?>






                </ul>
            </div><!-- section_container -->
        </section><!-- section -->
        
        <!-- 푸터 -->
        <footer>
            <?php include "../common/page_form/footer.php"?>
        </footer>
    </body>
</html>