<?php
// 세션을 사용하기 위해서는 세션 스타트를 써야한다
session_start();    //클라이언트의 정보를 서버에 저장하는 것을 session 이라한다.
// 세션에 유저 아이디가 세팅 됐다면 userid에 그 값을 저장한다
if (isset($_SESSION["user_mail"])) $userid = $_SESSION["user_mail"];
else $userid = "";
if (isset($_SESSION["user_nickname"])) $username = $_SESSION["user_nickname"];
else $username = "";
if (isset($_SESSION["user_num"])) $userlevel = $_SESSION["user_num"];
else $userlevel = "";
if (isset($_SESSION["user_img"])) $userpoint = $_SESSION["user_img"];
else $userpoint = "";
// echo $_SERVER['HTTP_HOST'];//localhost
// echo $_SERVER['DOCUMENT_ROOT'];// /Users/hong-yongcheon/Sites
?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>읒차공지</title>
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css">
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/notice/css/board.css">
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/notice/css/greet.css">

<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/board/js/board.js"></script>
</head>
<body> 
<header>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
</header>  
<section id="notice_section">
	
   	<div id="board_box">
	    <h3 class="title">
			공지사항 > 내용보기
		</h3>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";
	if(empty($_GET['page'])){
		$page=1;
	  }else{
		$page=$_GET['page'];
	  }
	  
	  if(isset($_GET["num"])&&!empty($_GET["num"])){
		  $num = test_input($_GET["num"]);
		  $hit = test_input($_GET["hit"]);
		  $q_num = mysqli_real_escape_string($con, $num);
	  
		  $sql="UPDATE `notice_board` SET `notice_hit`=$hit WHERE `notice_num`=$q_num;";
		  $result = mysqli_query($con,$sql);
		  if (!$result) {
			die('Error: ' . mysqli_error($con));
		  }
		}
	
	
	
	// $num  = $_GET["num"];
	// $page  = $_GET["page"];
	// $hit =$_GET["hit"];

	// $sql="UPDATE `notice_board` SET `notice_hit`=$hit WHERE `notice_num`=$q_num;";
    // $result = mysqli_query($con,$sql);
    // if (!$result) {
    //   die('Error: ' . mysqli_error($con));
    // }


	//$con = mysqli_connect("localhost", "user1", "12345", "sample");
	$sql = "select * from notice_board where notice_num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$id      = $row["notice_num"];
	$name      = $row["notice_title"];
	$regist_day = $row["notice_regtime"];
	$subject    = $row["notice_file_name"];
	$content    = $row["notice_contents"];
	$hit          = $row["notice_hit"];
    // echo "<script>alert($hit)</script>";

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	$new_hit = $hit + 1;
	$sql = "update notice_board set notice_hit=$new_hit where num=$num";   
	mysqli_query($con, $sql);
?>		
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$name?></span>
				<span class="col2">조회수 &nbsp;<?=$hit?> | <?=$regist_day?></span>
			</li>
			<li>
			<!-- $content db에 저장할 때 필요함  -->
				<?=$content?>
			</li>		
	    </ul>
	    <ul class="buttons">
				<?php
				if($user_nickname=='admin'){
				?>
				<li><button onclick="location.href='notice.php?page=<?=$page?>'">목록</button></li>
				<!-- 여기 아래로는 관리자가 되면 나타나게 해야된다 -->
				<li><button onclick="location.href='notice_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li>
				<li><button onclick="location.href='notice_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
				<li><button onclick="location.href='notice_form.php?num=<?=$num?>&page=<?=$page?>'">글쓰기</button></li>
				<?php
        		} else {	
				?>
				<li><button onclick="location.href='notice.php?page=<?=$page?>'">목록</button></li>
				<?php
        		} 	
				?>
		</ul>
	</div> <!-- board_box -->
</section> 
<footer>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
</footer>
</body>
</html>
