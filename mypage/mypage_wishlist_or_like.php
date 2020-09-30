<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wootcha</title>
        <link rel="stylesheet" type="text/css" href="./css/mypage.css">
        <link rel="stylesheet" type="text/css" href="./css/mypage_wishlist_item.css">
    </head>
    <body>
        <!-- 헤더 -->
        <header>헤더</header>

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
                ?>    
                    <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='#'>
                            <img src='./img/movie_poster2.jpg' alt="">
                            <h3>영화제목</h3>
                        </a>
                    </li> 

                    <li class='list_item'>
                        <a href='#'>
                            <img src='./img/movie_poster2.jpg' alt="">
                            <h3>영화제목</h3>
                        </a>
                    </li> 

                    <li class='list_item'>
                        <a href='#'>
                            <img src='./img/movie_poster2.jpg' alt="">
                            <h3>영화제목</h3>
                        </a>
                    </li> 

                    <li class='list_item'>
                        <a href='#'>
                            <img src='./img/movie_poster2.jpg' alt="">
                            <h3>영화제목</h3>
                        </a>
                    </li> 

                    





                <?php
                }
                ?>






                </ul>
            </div><!-- section_container -->
        </section><!-- section -->
        
        <!-- 푸터 -->
        <footer>푸터</footer>
    </body>
</html>