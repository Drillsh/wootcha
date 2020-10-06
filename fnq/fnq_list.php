<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css">
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/fnq/css/board.css">
<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/fnq/js/board.js"></script>
<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/js/vendor/jquery-1.10.2.min.js"></script>
<!-- script는 웹페이지에 스크립트를 추가한다 -->
<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/js/vendor/jquery-ui-1.10.3.custom.min.js?ver=3"></script>
<!-- <script src="../js/main.js"></script> -->
</head>
<body> 
<header>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>

</header>  
<section>
	
   	<div id="board_box">
	    <h3>
	    	FAQ > 목록보기
		</h3>
	    <ul id="board_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">내용</span>
					<span class="col5">등록일</span>
					<span class="col6">조회</span>
				</li>
<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;

	// $con = mysqli_connect("localhost", "user1", "12345", "sample");
	$sql = "select * from fnq_board order by fnq_num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 10;

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      // 하나의 레코드 가져오기
	  $num         = $row["fnq_num"];
	  $id          = $row["fnq_title"];
	  $name        = $row["fnq_contents"];
	  $subject     = $row["fnq_file_name"];
      $regist_day  = $row["fnq_regtime"];
      $hit         = $row["fnq_hit"];
?>
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col2"><a href="fnq_view.php?num=<?=$num?>&page=<?=$page?>"><?=$id?></a></span>
					<span class="col3"><?=$name?></span>
					<span class="col5"><?=$regist_day?></span>
					<span class="col6"><?=$hit?></span>
				</li>	
<?php
   	   $number++;
   }
   mysqli_close($con);

?>
	    	</ul>
			<ul id="page_num"> 	
<?php
	if ($total_page>=2 && $page >= 2)	
	{
		$new_page = $page-1;
		echo "<li><a href='fnq_list.php?page=$new_page'>◀ 이전</a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='fnq_list.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)		
   	{
		$new_page = $page+1;	
		echo "<li> <a href='fnq_list.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->	    	
			<ul class="buttons">
				<li><button onclick="location.href='fnq_list.php'">목록</button></li>
				<li>
<?php 
    if($userlevel==1) {
?>
					<button onclick="location.href='fnq_form.php'">글쓰기</button>
<?php
	} 
?>
				</li>
			</ul>
	</div> <!-- board_box -->
</section> 
<footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
</footer>
</body>
</html>
