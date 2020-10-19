<?php
session_start();

if (!isset($_SESSION["admin"])){
    echo("
      <script>
      alert('관리자 전용 페이지 입니다.');
      history.back();
      </script>
  ");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title> WOOTCHA </title>

    <!-- CSS, JS 파일 링크 시, -->
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/common/css/common.css">

    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/common_class_value.php"; ?>
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
    </header>
    <section>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/admin/admin_main.php"; ?>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
    </footer>
</body>

</html>