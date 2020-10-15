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
        <!-- 리스트 자동 추가 -->
        <script src="http://code.jquery.com/jquery-1.7.js"></script>
        <script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/mypage/js/auto_add_mv_like_list.js"></script>
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
        <?php
        // 좋아하는 영화 리스트
        $sql = "select * from fav_movie F 
        inner join movie M 
        on F.mv_num = M.mv_num 
        where F.user_num = $userpage_user_num order by F.fav_num DESC";
        $result = mysqli_query($con, $sql);
        
        ?>


        <!-- 섹션 -->
        <section id="section">
             <header class="section_header">
                <span class="title_sub"><?=$title_sub?> 페이지 &nbsp&nbsp > &nbsp&nbsp 좋아요 누른 영화</span><br><br>
                <span class="title_main">좋아요 누른 영화 <?=$result->num_rows?> 개</span>
            </header>
            <div class="section_container">
                <input type="hidden" id="userpage_user_num" value="<?=$userpage_user_num?>">
                <ul id="fav_movie_list_container">
                <?php

                if($result->num_rows >= 1){
                    
                    for($i = 0; $i < $result->num_rows && $i < 8 ; $i++){ 
                        mysqli_data_seek($result,$i);
                        $row_review = mysqli_fetch_array($result);

                        $fav_num = $row_review['fav_num'];
                        $mv_num = $row_review['mv_num'];
                        $mv_title = $row_review['mv_title'];
                        $mv_img_path = $row_review['mv_img_path'];
                ?>
                    <li class='list_item'>
                        <a
                            href='/wootcha/movie_introduce_page/movie_introduce_index.php?mv_num=<?=$mv_num?>'>
                            <img src='<?=$mv_img_path?>' alt="">
                            <h3><?=$mv_title?></h3>
                        </a>
                    </li>
                    <?php
                        // while문 끝
                        }
                    }else{ echo "<br><br><div>좋아요 표시한 영화가 없습니다.</div>"; }
                    ?>



                </ul>
                <div id="loading_box"><img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt=""></div>
            </div><!-- section_container -->
        </section><!-- section -->
        
        <!-- 푸터 -->
        <footer>
            <?php include "../common/page_form/footer.php"?>
        </footer>
    </body>
</html>