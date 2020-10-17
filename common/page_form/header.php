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
<!-- 아이콘 폰트  https://fontawesome.com/  -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/v4-shims.css">
<div class="css-1gkas1x-Grid ejny11m0">
    <div class="css-1wd9lk5-StyledPaddedContainer e18137le0">
        <ul class="css-1wpau1v-VisualUl-NavUl e1cl8ith3">
            <li class="css-u82ra6-NavLogo e1cl8ith4">
                 <h3><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/wootcha">WOOTCHA</a></h3></li>
            <li class="css-67pwm-NavList e1cl8ith5">
                <div class="css-cn9qlz-SearchContainer e1cl8ith1">
                    <div class="css-v7y0ja-SearchFormBlock e1rma0lx0">
                    <form class="" method="get" action="http://<?= $_SERVER['HTTP_HOST']; ?>/wootcha/search/search_index.php">
                            <label class="css-19u9pmc-Self edr8n0h0">
                                <div class="css-cnt7i8-InputBlock edr8n0h1">
                                </div>
                                <input class="css-1rv7yfe-Input edr8n0h2" type="text" placeholder="영화 제목을 검색해보세요:)" name="search_keyword" label="검색">
                                <select class="search_result_btn" name="country">
                                    <option value="">국가</option>
                                    <option value="KR">한국</option>
                                    <option value="JP">일본</option>
                                    <option value="US">미국</option>
                                    <option value="HK),">홍콩</option>
                                    <option value="GB">영국</option>
                                    <option value="FR">프랑스</option>
                                    <option value="ETC">기타</option>
                                </select>
                                <select class="search_result_btn" name="genre">
                                    <option value="">장르</option>
                                    <option value="1">드라마</option>
                                    <option value="2">판타지</option>
                                    <option value="3">서부</option>
                                    <option value="4">공포</option>
                                    <option value="5">로맨스</option>
                                    <option value="6">모험</option>
                                    <option value="7">스릴러</option>
                                    <option value="8">느와르</option>
                                    <option value="9">컬트</option>
                                    <option value="10">다큐멘터리</option>
                                    <option value="11">코미디</option>
                                    <option value="12">가족</option>
                                    <option value="13">미스터리</option>
                                    <option value="14">전쟁</option>
                                    <option value="15">애니메이션</option>
                                    <option value="16">범죄</option>
                                    <option value="17">뮤지컬</option>
                                    <option value="18">SF</option>
                                    <option value="19">액션</option>
                                    <option value="20">무협</option>
                                    <option value="21">에로</option>
                                    <option value="22">서스펜스</option>
                                    <option value="23">서사</option>
                                    <option value="24">블랙코미디</option>
                                    <option value="25">실험</option>
                                    <option value="26">영화카툰</option>
                                    <option value="27">영화음악</option>
                                    <option value="28">영화패러디포스터</option>
                                </select>
                            </label>
                    </form>
                    </div>
                </div>
            </li>
            <li class="css-1jqsj0d-NavList e1cl8ith5">
                <?php
                    // 로그인 안했을 때 회원가입 버튼 노출
                    if($user_mail === ""){
                ?>    
                    <a href="#" class="css-1f9w5rx-StyledRateLink e1cl8ith13 trigger_user_signup" id="trigger_user_signup"><h4>회원가입</h4></a>
                <?php
                    }
                ?>
            </li>
            <li class="css-1jqsj0d-NavList e1cl8ith5">
                <?php
                    // 로그인이 됐을 때 프로필 이미지(mypage 페이지 버튼) 노출
                    if($user_img != ""){
                ?> 
                  <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/wootcha/mypage/mypage_index.php?userpage_user_num=<?=$user_num?>">          
                <?php
                    // 선택 이미지의 파일명이 22자리, api 이미지는 22자리 이상
                    if (strlen($user_img) > 22) {
                        echo "<img src='$user_img' alt='프로필 이미지' class='e1cl8ith2 css-1vtztzm-RoundedImageBlock-Self-StyledProfilePhotoSmall e12ju1w01'></a>";
                    }else{
                ?>
                    <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/user/img/<?=$user_img?>" alt="프로필 이미지" class="e1cl8ith2 css-1vtztzm-RoundedImageBlock-Self-StyledProfilePhotoSmall e12ju1w01"></a>
                <?php
                    }
                ?>
                <?php
                    }
                ?>
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
                    <a href="<?=$logout?>" <?= $modalTrigger?> id="trigger_user_login"><img src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/img/wootcha_login.png" alt="프로필 이미지" class="e1cl8ith2 css-1vtztzm-RoundedImageBlock-Self-StyledProfilePhotoSmall e12ju1w01"></a>
                <?php include $_SERVER['DOCUMENT_ROOT']."/wootcha/user/user_signup_modal.php"?>
                <?php include $_SERVER['DOCUMENT_ROOT']."/wootcha/user/user_login_modal.php"?>
                <?php include $_SERVER['DOCUMENT_ROOT']."/wootcha/user/user_find_account.php"?>
            </li>
        </ul>
    </div>
</div>
