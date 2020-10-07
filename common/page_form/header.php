<?php 
session_start();
if (isset($_SESSION["user_mail"])) $user_mail = $_SESSION["user_mail"];
else $user_mail = "";
if (isset($_SESSION["user_nickname"])) $user_nickname = $_SESSION["user_nickname"];
else $user_nickname = "";
if (isset($_SESSION["user_num"])) $user_num = $_SESSION["user_num"];
else $user_num = "";
if (isset($_SESSION["user_img"])) $user_img = $_SESSION["user_img"];
else $user_img = "";
?>

<div id="top">
    <h3><a href="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/index.php"> WOOTCHA </a></h3>
    <div id="top_menu">
        <form class="search_form" method="post" action="http://<?= $_SERVER['HTTP_HOST']; ?>/wootcha/search/search_index.php">
            <input class="search_input" type="text" placeholder="키워드로 검색해보세요:)" name="search_keyword">
            <button class="search_result_btn" id="search">검색</button>
            <button class="search_result_btn" type="button" name="search_filter" id="keyword_btn">&nbsp필터 ▼</button>
        </form>
    <?php
        // 로그인이 됐을 때 프로필 이미지(mypage 페이지 버튼) 노출
        if($user_img != ""){
    ?>
        <div class="search_profile">
            <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/wootcha/mypage/mypage_index.php">          
            <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/wootcha/user/img/<?=$user_img?>"></a>
        </div>
    <?php
    }
    ?>
        <div class="search_profile">
    <?php
        //로그인 상태일 경우 로그인 로고 클릭 시 로그아웃됨 
        if($user_mail != ""){
            $logout = "http://".$_SERVER['HTTP_HOST']."/wootcha/user/user_logout.php";
            $modalTrigger = "";
        }else{
            $logout = "#";
            $modalTrigger = "class='trigger_user_login'";
        }
    ?>
        <a href="<?=$logout?>" <?= $modalTrigger?> id="trigger_user_login"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/common/img/login.png"></a>
        </div>

    <?php
        // 로그인 안했을 때 회원가입 버튼 노출
        if($user_mail === ""){
    ?>    
        <div class="search_profile">
            <a href="#" class="trigger_user_signup" id="trigger_user_signup"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/common/img/signup.png"></a>
        </div>
    <?php
    }
    ?>
        <?php include $_SERVER['DOCUMENT_ROOT']."/wootcha/user/user_signup_modal.php"?>
        <?php include $_SERVER['DOCUMENT_ROOT']."/wootcha/user/user_login_modal.php"?>
    </div>
</div>
