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
                    $user_num = $_SESSION['user_num'];
                    $mv_title = $_GET['mv_title'];
                    $mv_num = $_GET['mv_num'];

                    // 이미 작성한 review 재 작성 방지
                    $query = "select review_num from review where user_num= $user_num and mv_num= $mv_num";
                    $result = mysqli_query($con, $query);
                    if($result->num_rows >= 1){
                        echo "<script>alert('이미 작성된 리뷰가 존재 합니다.');history.go(-1);</script>";
                        exit;
                    }

            ?>

        <!-- 섹션 -->
        <section>
            <header class="section_header">
                <span class="title_sub"> 영화 상세 페이지 &nbsp&nbsp > &nbsp&nbsp 리뷰 작성하기 </span><br><br>
                <span class="title_main"><?=$mv_title?></span>
            </header>
            <div class="container_review" name="container_review">
                <div class="content_review">
                    <!-- 상단 프로필 및 평점 -->
                    <!-- <div class="content_header_review"> -->
                        <!-- profile img : 세션에서 값 옴-->
                        <!-- < ?php
                            if (strlen($user_img) > 22) {
                                echo "<div class='small_img_box'><img src='$user_img' alt=''></div>";
                            }else{ 
                                echo "<div class='small_img_box'><img src='../user/img/$user_img' alt='프로필 이미지 수정'></div>";
                            }
                        ?> -->
                        <!-- 닉네임 : 세션에서 값 옴 -->
                        <!-- <div>< ?=$user_nickname?></div> -->
                        
                    <!-- </div> -->
                    <!-- <hr width="99%" color="#e2e2e2" noshade="noshade"/> -->
                    <!-- 영화 제목 : post로 받아온 영화 제목-->
                    <!-- <h3 class="title">< ?=$mv_title?></h3> -->
                    <form action="./review_d_m_i.php" method="post" id="review_insert_form">
                        <input type="hidden" name="mode" value="insert">
                        <input type="hidden" name="mv_num" value="<?=$mv_num?>">
                        <h2>평점 매기기</h2>
                        <!-- 평점 -->
                        <div class="startRadio_box">
                            <div class="startRadio">
                            <?php
                            $find_rating=0.5;
                            while ($find_rating <= 5) {
                                // 반복문으로 rating bar 생성
                                echo "
                                    <label class='startRadio__box'>
                                        <input type='radio' name='review_rating' value='$find_rating'>
                                        <span class='startRadio__img'><span class='blind'></span></span>
                                    </label>";
                                $find_rating += 0.5;
                            }
                            ?>
                            </div>
                        </div>
                        <hr width="99%" color="#e2e2e2" noshade="noshade"/>
                        <h2>한 줄 평</h2>
                            <input type="text" class="review_short" name="review_short" placeholder="이 작품에 대한 생각을 한줄로 작성해본다면?">
                            <hr width="99%" color="#e2e2e2" noshade="noshade"/>
                        <div id="long_view_box">
                            <h2>장 문 평</h2>
                            <textarea name="review_long" id="review_long" cols="30" rows="10" class="review_long" wrap="physical" placeholder="장문평을 자유롭게 기재해 주세요"></textarea>
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