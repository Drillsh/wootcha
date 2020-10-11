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
                <span class="title_sub"><?=$title_sub?> 페이지 &nbsp&nbsp > &nbsp&nbsp 좋아요 누른 영화</span><br><br>
                <span class="title_main">좋아요 누른 영화</span>
            </header>
            <div class="section_container">
                <ul>
                <?php
                    // // mypage_db_helper 에 정의된 함수
                    // $result = select_data($con, "select_user", "myohoon95@gmail.com");

                    // // 사용자의 pk를 확인
                    // $row = mysqli_fetch_array($result);
                    // $user_num = $row['user_num'];

                    // 좋아하는 영화 리스트
                    $result = select_data($con, "select_my_favorite_movie", $userpage_user_num);
                    if($result->num_rows >= 1){
                        while($row_review = mysqli_fetch_array($result)){
                            $fav_num = $row_review['fav_num'];
                            $mv_num = $row_review['mv_num'];
                            $mv_title = $row_review['mv_title'];
                            $mv_img_path = $row_review['mv_img_path'];
                    ?>
                        <li class='list_item'>
                            <a href='#'>
                                <img src='<?=$mv_img_path?>' alt="">
                                <h3><?=$mv_title?></h3>
                            </a>
                        </li>
                    <?php
                        // while문 끝
                        }
                    }else{ echo "<div>좋아요 표시한 영화가 없습니다.</div>"; }
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