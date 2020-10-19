<?php
if (!isset($_SESSION["admin"])){
    echo("
      <script>
      alert('관리자 전용 페이지 입니다.');
      </script>
  ");
    exit;
}
?>
<div class="my_info_content">
    <div class="left_menu">
        <!-- 순서대로쭉쭉 -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/admin/admin_side_left_menu.php"; ?>
    </div>
    <div class="right_content">

        <div class="<?= COMMON::$css_card_menu_row; ?>">
            <button class="<?= COMMON::$css_card_menu_btn; ?>" type="button" onclick="location.href='http\://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_edit_user.php'">
                <div class="<?= COMMON::$css_card_menu_btn_icon; ?>">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div class="<?= COMMON::$css_card_menu_btn_name; ?>">유저정보관리</div>
                <div class="<?= COMMON::$css_card_menu_btn_disc; ?>">총 가입자 수 현황</div>
            </button>

            <button class="<?= COMMON::$css_card_menu_btn; ?>" type="button" onclick="location.href='http\://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_notice.php'">
                <div class="<?= COMMON::$css_card_menu_btn_icon; ?>">
                    <i class="far fa-id-card"></i>
                </div>
                <div class="<?= COMMON::$css_card_menu_btn_name; ?>">공지사항 관리</div>
                <div class="<?= COMMON::$css_card_menu_btn_disc; ?>">공지사항 수정, 삭제</div>
            </button>
        </div> <!-- end of css_card_menu_row -->

        <div class="<?= COMMON::$css_card_menu_row; ?>">
            <button class="<?= COMMON::$css_card_menu_btn; ?>" type="button" onclick="location.href='http\://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_review.php'">
                <div class="<?= COMMON::$css_card_menu_btn_icon; ?>">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="<?= COMMON::$css_card_menu_btn_name; ?>">리뷰 관리</div>
                <div class="<?= COMMON::$css_card_menu_btn_disc; ?>">총 리뷰 수 현황</div>
            </button>

            <button class="<?= COMMON::$css_card_menu_btn; ?>" type="button" onclick="location.href='http\://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_qna.php'">
                <div class="<?= COMMON::$css_card_menu_btn_icon; ?>">
                    <i class="far fa-id-card"></i>
                </div>
                <div class="<?= COMMON::$css_card_menu_btn_name; ?>">QnA 게시판 관리</div>
                <div class="<?= COMMON::$css_card_menu_btn_disc; ?>">QnA 게시글 수정 및 삭제</div>
            </button>

        </div> <!-- end of css_card_menu_row -->

        <div class="<?= COMMON::$css_card_menu_row; ?>">
            <button class="<?= COMMON::$css_card_menu_btn; ?>" type="button" onclick="location.href='http\://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_reply.php'">
                <div class="<?= COMMON::$css_card_menu_btn_icon; ?>">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="<?= COMMON::$css_card_menu_btn_name; ?>">댓글 관리</div>
                <div class="<?= COMMON::$css_card_menu_btn_disc; ?>">리뷰들의 총 댓글 관리</div>
            </button>

            <button class="<?= COMMON::$css_card_menu_btn; ?>" type="button" onclick="location.href='http\://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/admin/admin_faq.php'">
                <div class="<?= COMMON::$css_card_menu_btn_icon; ?>">
                    <i class="far fa-question-circle"></i>
                </div>
                <div class="<?= COMMON::$css_card_menu_btn_name; ?>">FAQ 관리</div>
                <div class="<?= COMMON::$css_card_menu_btn_disc; ?>">FAQ 게시글 수정 및 삭제</div>
            </button>

        </div> <!-- end of css_card_menu_row -->

    </div><!-- end of right_content -->
