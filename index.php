<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title> Wootcha </title>

    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/main/css/main.css?after">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/main/css/main_test.css?after">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css?after">

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/main/js/slide/main.js"></script>

    <!-- 모달 리뷰 화면 -->
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/mypage/css/mypage_review_modal.css?after">
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/mypage/js/mypage_review_modal.js"></script>
    <!-- 아이콘 폰트  https://fontawesome.com/  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/v4-shims.css">

</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
    </header>
    <section class="css-xpk6f5-Main ebsyszu1">
        <div class="css-7eleqt-Self ebeya3l1">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/main/main.php"; ?>
        </div>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
    </footer>
</body>

</html>

