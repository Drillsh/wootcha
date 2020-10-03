<?php
$search_keyword = $_POST['search_keyword'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title> WOOTCHA </title>

    <!-- CSS, JS 파일 링크 -->
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/common/css/common.css">
    <script src="http://code.jquery.com/jquery-1.12.4.js"></script>

</head>

<body>

    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php"; ?>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
    </header>
    <section>
        <div class="search_all">
            <span class="search_title">&nbsp;&nbsp;:::&nbsp;&nbsp; "<?=$search_keyword?>" 에 대한 검색결과 입니다.</span>
        </div>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
    </footer>
</body>

</html>