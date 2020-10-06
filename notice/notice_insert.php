<meta charset="utf-8">
<?php
	include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";
	include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/create_table.php";
 
//세션값 확인  
session_start();
	if (isset($_SESSION["userid"])) 
		$userid = $_SESSION["userid"];
	else 
		$userid = "";
	if (isset($_SESSION["username"])) 
		$username = $_SESSION["username"];
	else 
		$username = "";

    if ( !$userid )
    {
        echo("
                    <script>
                    alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
                    history.go(-1)
                    </script>
        ");
                exit;
    }
	$subject = $_POST["subject"];
    $content = $_POST["content"];

    $subject = test_input($subject);
    $content = test_input($content);

	// $subject = htmlspecialchars($subject, ENT_QUOTES);
	// $content = htmlspecialchars($content, ENT_QUOTES);

	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	create_table($con, "notice_board");
	// $con = mysqli_connect("localhost", "user1", "12345", "sample");

	$sql = "insert into notice_board (notice_num, notice_title, notice_contents, notice_hit, notice_regtime, notice_file_name, notice_file_copied, notice_file_type) ";
	$sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0);";
	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
	
	mysqli_close($con);                // DB 연결 끊기

	echo "
	   <script>
	    location.href = 'notice_list.php';
	   </script>
	";
?>

  
