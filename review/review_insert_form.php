<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wootcha</title>
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css?after">
        <link rel="stylesheet" type="text/css" href="./css/review.css?after">
        <!-- <script src="./js/mypage_modal.js"></script> -->
    </head>
    <body>
        <!-- 헤더 -->
        <header>
            <?php include_once "../common/page_form/header.php"?>
        </header>
            <?php   include_once "../common/database/db_connector.php";
                    if(!isset($_SESSION['user_mail'])){
                        echo "<script>alert('잘못된 접근입니다. 로그인 후 이용하세요.');
                        history.go(-1);</script>";
                        exit;
                    }
                    // $_POST['mv_title'];
                    $_mv_title = "post로 받아온 영화제목이 들어감";

            ?>

        <!-- 섹션 -->
        <section>
            <header class="section_header">
                <span class="title_sub">??? &nbsp&nbsp > &nbsp&nbsp 리뷰 작성하기 </span><br><br>
                <span class="title_main">리뷰 작성하기</span>
            </header>
            <div class="container_review" name="container_review">
                <div class="content_review">
                    <!-- 상단 프로필 및 평점 -->
                    <div class="content_header_review">
                        <!-- profile img : 세션에서 값 옴-->
                        <div class="small_img_box"><img src="../user/img/<?=$user_img?>" alt="프로필 이미지"></div>
                        <!-- 닉네임 : 세션에서 값 옴 -->
                        <div><?=$user_nickname?></div>
                        <!-- 평점 -->
                        <div>
                            <div class="startRadio">
                                <label class="startRadio__box">
                                    <input type="radio" name="star" id="">
                                    <span class="startRadio__img"><span class="blind">별 1개</span></span>
                                </label>
                                <label class="startRadio__box">
                                    <input type="radio" name="star" id="">
                                    <span class="startRadio__img"><span class="blind">별 1.5개</span></span>
                                </label>
                                <label class="startRadio__box">
                                    <input type="radio" name="star" id="">
                                    <span class="startRadio__img"><span class="blind">별 2개</span></span>
                                </label>
                                <label class="startRadio__box">
                                    <input type="radio" name="star" id="">
                                    <span class="startRadio__img"><span class="blind">별 2.5개</span></span>
                                </label>
                                <label class="startRadio__box">
                                    <input type="radio" name="star" id="">
                                    <span class="startRadio__img"><span class="blind">별 3개</span></span>
                                </label>
                                <label class="startRadio__box">
                                    <input type="radio" name="star" id="">
                                    <span class="startRadio__img"><span class="blind">별 3.5개</span></span>
                                </label>
                                <label class="startRadio__box">
                                    <input type="radio" name="star" id="">
                                    <span class="startRadio__img"><span class="blind">별 4개</span></span>
                                </label>
                                <label class="startRadio__box">
                                    <input type="radio" name="star" id="">
                                    <span class="startRadio__img"><span class="blind">별 4.5개</span></span>
                                </label>
                                <label class="startRadio__box">
                                    <input type="radio" name="star" id="">
                                    <span class="startRadio__img"><span class="blind">별 5개</span></span>
                                </label>
                                <label class="startRadio__box">
                                    <input type="radio" name="star" id="">
                                    <span class="startRadio__img"><span class="blind">별 5.5개</span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr width="99%" color="#e2e2e2" noshade="noshade"/>
                    <!-- 영화 제목 : post로 받아온 영화 제목-->
                    <h3 class="title"><?=$_mv_title?></h3>
                    <form action="#">
                        <h3>한 줄 평</h3>
                            <input type="text" class="line_review">
                        <div id="long_view_box">
                            <h3>장 문 평</h3>
                            <textarea name="" id="" cols="30" rows="10" class="long_review" wrap="physical"></textarea>
                        </div>
                        <hr width="99%" color="#e2e2e2" noshade="noshade"/>
                        <input type="submit" value="작성하기">
                    </form>
                </div>
            </div><!-- containder -->
                
        </section><!-- section -->
        <!-- 푸터 -->
        <footer>
            <?php include_once "../common/page_form/footer.php"?>
        </footer>
    </body>
    </html>