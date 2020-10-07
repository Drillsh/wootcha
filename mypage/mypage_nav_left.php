<?php
$user_img = $_SESSION['user_img'];
?>

<div class="profile_img_box">
    <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/user/img/<?=$user_img?>" alt="프로필 이미지">
</div>
<ul>
    <li><a href="./mypage_index.php">내가 작성한 리뷰</a></li>
    <li><a href="./mypage_wishlist_or_like.php?mode=wish">보고싶은 영화</a></li>
    <li><a href="./mypage_wishlist_or_like.php?mode=like">좋아요</a></li>
    <li><a href="./mypage_follow.php">팔로우</a></li>
    <li><a href="./mypage_edit_myinfo.php">내 정보 수정</a></li>
</ul>