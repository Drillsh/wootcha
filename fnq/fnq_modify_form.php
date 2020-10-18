<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css">
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/fnq/css/board.css">
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/fnq/css/greet.css">
<link rel="stylesheet" href="./css/gm_members.css">
<link rel="stylesheet" href="./css/nav.css">
<script src="./js/board.js"> </script>
</head>
<body> 
<header>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";?>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
</header>  
<section id="faq_modify_form">
	
   	<div id="board_box">
	    <h3 id="board_title">
	    		FaQ > 글 쓰기
		</h3>
<?php
	$num  = $_GET["num"];
	$page = $_GET["page"];
	
	
	$sql = "select * from faq_board where faq_num=$num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	// $name       = $row["faq_num"];
	// $page 		=$row("faq_regtime");
	$subject    = $row["faq_title"];
	$content    = $row["faq_contents"];
?>
	    <form  name="board_form" method="post" action="fnq_modify.php?num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : 관리자 </span>
					<span class="col2"><?=$name?></span>
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="faq_title" type="text" value="<?=$subject?>"></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="faq_contents"><?=$content?></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">수정하기</button></li>
				<li><button type="button" onclick="location.href='fnq_main.php'">목록</button></li>
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
<footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
</footer>
</body>
</html>
