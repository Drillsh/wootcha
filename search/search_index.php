<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title> WOOTCHA </title>

    <!-- CSS, JS 파일 링크 -->
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/common/css/common.css?after">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/search/css/view_all.css">
    <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="./js/search_func.js"></script>

    <!--    DB, Header-->
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php"; ?>
    <!-- < ?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?> -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/movie_info.php";?>
</head>

<body>

    <header class="css-11i4ae3-Self e1cl8ith0">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
        <?php
        // 세션
        if (isset($_SESSION['user_num'])) {
            $user_num = $_SESSION['user_num'];
        }else
            $user_num = "";


        // 검색 결과 받음
        if (isset($_GET['search_keyword'])) {
            $search = $_GET['search_keyword'];

            if (isset($_GET['country'])) {
                $country = $_GET['country'];
            }
            if (isset($_GET['genre'])) {
                $genre = $_GET['genre'];
            }

            echo "
          <script>
            // 검색결과 타이틀 변경
            function setSelectSear() {
              document.getElementById('view_all_search').innerHTML = '\"$search\" 검색결과';
              document.getElementById('view_all_review').innerHTML = '';
            }
          </script>
        ";

        } else {
            $search = "";
        }
        // 데이터 졍렬
        if (isset($_GET['selected_option'])) {
            $selected_option = $_GET["selected_option"];
        }
        ?>
        
    </header>
    <section>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/search/search_result.php"; ?>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
    </footer>
</body>

</html>