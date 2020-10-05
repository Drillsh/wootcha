<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wootcha</title>
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css?after">
        <link rel="stylesheet" type="text/css" href="./css/mypage.css?after">
        <link rel="stylesheet" type="text/css" href="./css/mypage_edit_myinfo.css?ver=10">
        <script src="./js/edit_myinfo.js"></script>
        <style> 
</style>
    </head>
    <body>
    <?php
        $image = "이미지";
        $id = "hoonsa123";
        $name = "임훈사";
        $birth_day = "1995-12-12";
        $regist_day = "2020-10-01";
        $nickname = "후";
        $phone = "010-1234-5678";
        $password = "1234";
    ?>
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
                <span class="title_sub">마이 페이지 &nbsp&nbsp > &nbsp&nbsp 내 정보 수정</span><br><br>
                <span class="title_main">내 정보 수정</span>
            </header>
            <div class="section_container">
                <!-- db에서 가져온 값이 들어갈 것 -->
                <form action="#" method="post">
                    <table>
                        <tr>
                            <td>프로필사진</td>
                            <td>사진을 설정합니다.</td>
                            <td>
                                <a href="#">
                                    <div class="small_img_box">
                                        <img src="./img/movie_poster.jpg" alt="프로필 이미지 수정">
                                        <img src="./img/black.png" alt="">
                                        <img src="./img/modify.png" alt="">
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>아이디</td>
                            <td><?=$id?></td>
                            <td>
                                <a href="#">
                                    <div class="small_img_box">
                                    <!-- <img src="./img/edit.png" alt="수정"> -->
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>이름</td>
                            <td><?=$name?></td>
                            <td>
                                <a href="#">
                                    <div class="small_img_box">
                                    <!-- <img src="./img/edit.png" alt="수정"> -->
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>생년월일</td>
                            <td><?=$birth_day?></td>
                            <td>
                                <a href="#">
                                    <div class="small_img_box">
                                    <!-- <img src="./img/edit.png" alt="수정"> -->
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>가입일자</td>
                            <td><?=$regist_day?></td>
                            <td>
                                <a href="#">
                                    <div class="small_img_box">
                                    <!-- <img src="./img/edit.png" alt="수정"> -->
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>닉네임</td>
                            <td><?=$nickname?></td>
                            <td>
                                <a href="#" class="trigger">
                                    <div class="small_img_box">
                                        <!-- checkbox 선택 시 popup -->
                                        <img src="./img/edit.png" alt="">
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>전화번호</td>
                            <td><?=$phone?></td>
                                <td>
                                <a href="#" class="trigger_phone">
                                    <div class="small_img_box">
                                        <img src="./img/edit.png" alt="">
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>비밀번호</td>
                            <td>정기적으로 변경해주시는 것이 보안에 좋습니다.</td>
                            <td>
                                <a href="#" class="trigger_password">
                                    <div class="small_img_box">
                                        <img src="./img/edit.png" alt="">
                                    </div>
                                </a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div><!-- section_container -->

            <!-- ************** -->
            <!-- 모달 수정 창 -->
            <!-- ************** -->
            
            <!-- modal 닉네임 수정 -->
            <div class="modal"> 
                <div class="modal-content"> 
                    <span class="close-button">&times;</span> 
                        <h1 class="title">닉네임 수정</h1> 
                        <form action="#" method="POST"> 
                            <table>
                                <tr>
                                    <td><input type="text" name="nickname" placeholder="<?=$nickname?>" required="required"></td>
                                    <td><input type="button" onclick="" class="button" value="중복확인"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="button" id="cancel" value="취소">
                                    <input type="submit" id="submit" value="보내기">
                                </td>
                                </tr>
                            </table>
                                                     
                             
                        </form>
                </div> 
            </div>

            <!-- modal 전화번호 수정 -->
            <div class="modal_phone"> 
                <div class="modal-content_phone"> 
                    <span class="close-button_phone">&times;</span> 
                        <h1 class="title">전화번호 수정</h1> 
                        <form action="#" method="POST"> 
                            <table>
                                <tr>
                                    <td><input type="tel" name="phone" placeholder="<?=$phone?>" required="required"></td>
                                    <td><input type="button" onclick="" class="button" value="인증하기"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="button" id="cancel" value="취소">
                                    <input type="submit" id="submit" value="보내기">
                                </td>
                                </tr>
                            </table>
                                                     
                             
                        </form>
                </div> 
            </div>

            <!-- modal 비밀번호 수정 -->
            <div class="modal_password"> 
                <div class="modal-content_password"> 
                    <span class="close-button_password">&times;</span> 
                        <h1 class="title">비밀번호 수정</h1> 
                        <form action="#" method="POST"> 
                            <table>
                                <tr>
                                    <td><input type="password" name="password" placeholder="<?=$password?>" required="required"></td>
                                    <td><input type="button" onclick="" class="button" value="인증하기"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="button" id="cancel" value="취소">
                                    <input type="submit" id="submit" value="보내기">
                                </td>
                                </tr>
                            </table>  
                        </form>
                </div> 
            </div>

            
           


        </section><!-- section -->
        
        <!-- 푸터 -->
        <footer>
            <?php include "../common/page_form/footer.php"?>
        </footer>
    </body>
</html>