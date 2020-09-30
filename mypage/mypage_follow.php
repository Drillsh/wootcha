<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wootcha</title>
        <link rel="stylesheet" type="text/css" href="./css/mypage.css">
        <link rel="stylesheet" type="text/css" href="./css/mypage_follow_item.css">
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
                <span class="title_sub">마이 페이지 &nbsp&nbsp > &nbsp&nbsp 팔로우</span><br><br>
                <span class="title_main">팔로우</span>
            </header>
            <div class="section_container">
                <ul>
                <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='#'>
                            <div class='img_box'><img src='./img/movie_poster2.jpg' alt=""></div>
                            <h3>이시형</h3>
                        </a>
                    </li>
                    
                    <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='#'>
                            <div class='img_box'><img src='./img/movie_poster2.jpg' alt=""></div>
                            <h3>홍용천</h3>
                        </a>
                    </li>

                    <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='#'>
                            <div class='img_box'><img src='./img/movie_poster2.jpg' alt=""></div>
                            <h3>오선환</h3>
                        </a>
                    </li>

                    <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='#'>
                            <div class='img_box'><img src='./img/movie_poster2.jpg' alt=""></div>
                            <h3>박다니엘</h3>
                        </a>
                    </li>

                    <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='#'>
                            <div class='img_box'><img src='./img/movie_poster2.jpg' alt=""></div>
                            <h3>임훈사</h3>
                        </a>
                    </li>
                
                </ul>
            </div><!-- section_container -->
        </section><!-- section -->
        
        <!-- 푸터 -->
        <footer>푸터</footer>
    </body>
</html>