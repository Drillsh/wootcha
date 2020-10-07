<!-- 왼쪽 사이드 메뉴 -->
<div class="my_info_profile">
    <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_index.php"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/img/admin_profile.png"></a>
</div>
<ul>
    <li class="<?= COMMON::$css_sub_menu; ?>"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_edit_user.php">유저 관리</a> </li>
    <li class="<?= COMMON::$css_sub_menu; ?>"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_review.php">리뷰 관리</a> </li>
    <li class="<?= COMMON::$css_sub_menu; ?>"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_reply.php">댓글 관리</a> </li>
    <li class="<?= COMMON::$css_sub_menu; ?>"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_notice.php">공지사항 관리</a> </li>
    <li class="<?= COMMON::$css_sub_menu; ?>"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_qna.php">Q&A 관리</a> </li>
    <li class="<?= COMMON::$css_sub_menu; ?>"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_faq.php">FAQ 관리</a> </li>
    <li class="<?= COMMON::$css_sub_menu; ?>"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_chart_view.php">통 계</a> </li>
</ul>
