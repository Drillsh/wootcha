<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css">
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/fnq/css/board.css">

</head>
<body> 
<header>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>

</header>  
<section>
	
   	<div id="board_box">
	    <h3>
	    	FnQ > 목록보기
		</h3>
	    <ul id="board_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col5">등록일</span>
					<span class="col6">조회</span>
                </li>
        <!-- <div>
            <button>자주 묻는 질문 </button>
            <button>읒차 </button>
            <button>로그인/계정 </button>
            <button>컨텐츠 </button>
        </div>             -->
<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;
	
	
	


	// $con = mysqli_connect("localhost", "user1", "12345", "sample");
	$sql = "select * from faq_board order by faq_num desc";
	$result = mysqli_query($con, $sql);
	if (!$result) {
		echo "<script>alert()</script>";
		die('Error: ' . mysqli_error($con));
	  }
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
	  $num         = $row["faq_num"];
	  $id          = $row["faq_title"];
	//   $name        = $row["faq_hit"];
	  $subject     = $row["faq_contents"];
      $regist_day  = $row["faq_regtime"];
	  $hit         = $row["faq_hit"];
	//   echo "<script>alert($hit)</script>";

?>
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col2"><a href="fnq_view.php?num=<?=$num?>&page=<?=$page?>&hit=<?=$hit?>"><?=$id?></a></span>
					<span class="col3">관리자</span>
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
		echo "<li><a href='fnq_main.php?page=$new_page'>◀ 이전</a> </li>";
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
			echo "<li><a href='fnq_main.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)		
   	{
		$new_page = $page+1;	
		echo "<li> <a href='fnq_main.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->	    	
			<ul class="buttons">
				<li><button onclick="location.href='fnq_main.php'">목록</button></li>
				<li>
<?php 
    if($user_nickname=='admin') {
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
