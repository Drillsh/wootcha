<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css">
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/notice/css/board.css">
<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/notice/js/board.js"></script>
<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/js/vendor/jquery-1.10.2.min.js"></script>
<!-- script는 웹페이지에 스크립트를 추가한다 -->
<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/js/vendor/jquery-ui-1.10.3.custom.min.js?ver=3"></script>
<!-- <script src="../js/main.js"></script> -->
</head>
<body> 
<header>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
	<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/create_table.php";?>
</header>  
<!-- < ?php
      
        if (!isset ($_SESSION["userid"]) )
           { 
			   echo("<script>
				alert('로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
            exit;
        }
        ?> -->
<section>
	
   	<div id="board_box">
	    <h3 id="board_title">
	    		공지사항 > 글 쓰기
		</h3>
	    <form  name="board_form" method="post" action="notice_insert.php" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2">관리자</span>
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="notice_title" type="text"></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="notice_contents"></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">완료</button></li>
				<li><button type="button" onclick="location.href='notice.php'">목록</button></li>
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
<footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
</footer>
</body>
</html>
