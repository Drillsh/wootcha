<?php
// 검색 결과 받음
if (isset($_POST['search_keyword'])) {
    $search = $_POST['search_keyword'];
    $deco = '"';

    echo "
          <script>
            function setSelectSear() {

              document.getElementById('view_all_search').innerHTML = '$deco$search 검색결과';
              document.getElementById('view_all_review').innerHTML = '';

            }
          </script>
        ";
} else {
    $search = "";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title> WOOTCHA </title>

    <!-- CSS, JS 파일 링크 -->
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/common/css/common.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/search/css/view_all.css">
    <script src="http://code.jquery.com/jquery-1.12.4.js"></script>

</head>

<body>

    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php"; ?>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
    </header>
    <section>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/search/search_result.php"; ?>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
    </footer>
</body>

</html>