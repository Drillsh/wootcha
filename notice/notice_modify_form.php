<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css">
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/notice/css/board.css">
<script src="./js/board.js"> </script>
</head>
<body> 
<header>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
</header>  
<section>
	
   	<div id="board_box">
	    <h3 id="board_title">
	    		공지사항 > 글 쓰기
		</h3>
<?php
	$num  = $_GET["num"];
	$page = $_GET["page"];
	
	include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";
	$sql = "select * from notice_board where notice_num=$num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	// $name       = $row["notice_name"];
	$subject    = $row["notice_title"];
	$content    = $row["notice_contents"];
?>
	    <form  name="board_form" method="post" action="notice_modify.php?num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2">관리자</span>
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="notice_title" type="text" value="<?=$subject?>"></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="notice_contents"><?=$content?></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">수정하기</button></li>
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
