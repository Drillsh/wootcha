<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wootcha</title>
        <link rel="stylesheet" type="text/css" href="./css/mypage.css">
        <link rel="stylesheet" type="text/css" href="./css/mypage_comment_list_item.css?ver=3">
    </head>
    <body>
        <!-- 헤더 -->
        <header>헤더</header>

        <!-- 네비게이션 : 왼쪽 -->
        <nav class="nav_left">
            <?php include "./mypage_nav_left.php"?>
        </nav>

        <!-- 섹션 -->
        <section>
            <header class="section_header">
                <span class="title_sub">마이 페이지 &nbsp&nbsp > &nbsp&nbsp 내가 작성한 코멘트</span><br><br>
                <span class="title_main">내가 작성한 코멘트</span>
            </header>
            <div class="section_container">



                <!-- db에서 가져온 값이 들어갈 것 -->
                <div class="list_item">
                    <div class="left">
                        <li><img src="./img/movie_poster.jpg" alt=""></li>
                    </div>
                    <div class="center">
                        <img src="" alt="">
                        <ul>
                            <li>어벤져스</li>
                            <li>참 재미가 있었다.</li>
                            <li>2020-09-30</li>
                        </ul>
                    </div>
                    <div class="right">
                        <button>수정 및 삭제</button>
                        <span>
                            <span>별점</span>
                        </span>
                    </div>
                </div><!-- list_item -->

                <!-- db에서 가져온 값이 들어갈 것 -->
                <div class="list_item">
                    <div class="left">
                        <li><img src="./img/movie_poster.jpg" alt=""></li>
                    </div>
                    <div class="center">
                        <img src="" alt="">
                        <ul>
                            <li>영화제목</li>
                            <li>한줄평</li>
                            <li>등록일</li>
                        </ul>
                    </div>
                    <div class="right">
                        <button>수정 및 삭제</button>
                        <span>
                            <span>별점</span>
                        </span>
                    </div>
                </div><!-- list_item -->

                <!-- db에서 가져온 값이 들어갈 것 -->
                <div class="list_item">
                    <div class="left">
                        <li><img src="./img/movie_poster.jpg" alt=""></li>
                    </div>
                    <div class="center">
                        <img src="" alt="">
                        <ul>
                            <li>영화제목</li>
                            <li>한줄평</li>
                            <li>등록일</li>
                        </ul>
                    </div>
                    <div class="right">
                        <button>수정 및 삭제</button>
                        <span>
                            <span>별점</span>
                        </span>
                    </div>
                </div><!-- list_item -->

                <!-- db에서 가져온 값이 들어갈 것 -->
                <div class="list_item">
                    <div class="left">
                        <li><img src="./img/movie_poster.jpg" alt=""></li>
                    </div>
                    <div class="center">
                        <img src="" alt="">
                        <ul>
                            <li>영화제목</li>
                            <li>한줄평</li>
                            <li>등록일</li>
                        </ul>
                    </div>
                    <div class="right">
                        <button>수정 및 삭제</button>
                        <span>
                            <span>별점</span>
                        </span>
                    </div>
                </div><!-- list_item -->


            </div><!-- section_container -->
        </section><!-- section -->
        
        <!-- 푸터 -->
        <footer>푸터</footer>
    </body>
</html>