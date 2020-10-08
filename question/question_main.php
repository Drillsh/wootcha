<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QnA</title>
  <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css">
  <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/question/css/help_center_page.css">
  <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/common_class_value.php"; ?>

</head>
<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
    </header>
   <section>
   <div class="my_info_content">
      <div class="left_menu">
        <!-- 왼쪽 사이드 메뉴 -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/question/helpcenter/help_center_side_left_menu.php"; ?>
      </div>
      <div class="right_content">
        <h1>안녕하세요. 무엇을 도와드릴까요?</h1>
        <div class="<?= COMMON::$css_card_menu_row; ?>">
          <button class="<?= COMMON::$css_card_menu_btn; ?>" type="button" onclick="location.href='http\://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/index.php'">
            <div class="<?= COMMON::$css_card_menu_btn_icon; ?>">
              <i class="fas fa-user-cog"></i>
            </div>
            <div class="<?= COMMON::$css_card_menu_btn_name; ?>">메인화면가기</div>
            <div class="<?= COMMON::$css_card_menu_btn_disc; ?>">.........</div>
          </button>

          <button class="<?= COMMON::$css_card_menu_btn; ?>" type="button" onclick="location.href='http\://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/fnq/fnq_main.php'">
            <div class="<?= COMMON::$css_card_menu_btn_icon; ?>">
              <i class="far fa-id-card"></i>
            </div>
            <div class="<?= COMMON::$css_card_menu_btn_name; ?>">자주 묻는 질문에서 도움을 받으세요.</div>
            <div class="<?= COMMON::$css_card_menu_btn_disc; ?>">식당 관리와 손님과의 의사소통 등에 도움을 받으세요.</div>
          </button>

        </div> 
            <!-- end of css_card_menu_row -->


        <h3>읏차에 처음 오셨나요?</h3>
        <h2>도움이 될 만한 게시글을 확인해보세요.</h2>

        <!-- 도움말 json 기사를 css_card_menu_row로 자동 작업 -->
        <!-- < ?php include $_SERVER['DOCUMENT_ROOT'] . "/echelin/help_center/json_parsing_help_center.php";
        helpCenterMainButton();
        ?> -->
      </div><!-- end of right_content -->

   </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
    </footer>      
</body>
</html>
