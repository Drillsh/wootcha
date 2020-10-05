<!DOCTYPE html>
<html>

<head>
    <title>영화 상세 페이지</title>
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/movie_introduce_page/css/movie_introduce_content.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/common/css/common.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
</head>

<body>
<header>    
<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
</header>

<section>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/movie_introduce_page/movie_introduce_main.php"; ?>
</section>

<footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
</footer>
</body>

</html>