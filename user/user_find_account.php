<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wootcha</title>
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css?after">
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/user/css/user_find_account.css?after">

        <!-- db -->
        <?php include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php"; ?>
    </head>
    <body>
        <!-- 헤더 -->
        <header>
            <?php include_once "../common/page_form/header.php"?>
        </header>

        <!-- 섹션 -->
        <section>
            <!-- 팝업 될 레이어 --> 
<div class="modal_container_find_account" name="modal_container_find_account"> 
    <div class="modal_content_find_account"> 
        <!-- 상단 로고 -->
        <div class="find_account_modal_content_header">
            <!-- 로고 -->
            <!-- <div class="small_img_box">
                <img src="./img/profile_image< ?=$i?>.png" alt="프로필 이미지">
            </div>  -->
        </div>
        <hr width="99%" color="#e2e2e2" noshade/>
        
        <!-- 로그인 폼 -->
        <form action="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/user/user_find_account.php" id="find_account_form" name="find_account_form" method="post">
        <table>
            <!-- 아이디(이메일) -->
            <tr>
                <td>
                    <input type="text" id="find_account_email" name="find_account_email" placeholder="아이디(이메일)" >
                </td>
            </tr>
            <!-- 비밀번호 -->
            <tr>
                <td>
                    <input type="password" id="find_account_password" name="find_account_password" placeholder="비밀번호">
                </td>
            </tr>
            <!-- 비밀번호 -->
            <tr>
                <td>
                    <input type="password" id="find_account_password" name="find_account_password" placeholder="비밀번호">
                </td>
            </tr>
            <!-- 비밀번호 -->
            <tr>
                <td>
                    <input type="password" id="find_account_password" name="find_account_password" placeholder="비밀번호">
                </td>
            </tr>
        </table>
        <hr width="99%" color="#e2e2e2" noshade/><!-- 구분선 -->
        <input type="button" value="계정찾기" onclick="check_input_find_account()">
        </form>
        
        
    
    </div>
</div>
















        </section><!-- section -->
        <!-- 푸터 -->
        <footer>
            <?php include_once "../common/page_form/footer.php"?>
        </footer>
    </body>
    </html>