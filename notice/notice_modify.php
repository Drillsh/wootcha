<?php
    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["notice_title"];
    $content = $_POST["notice_contents"];
          
	include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";
    $sql = "update notice_board set notice_title='$subject', notice_contents='$content' ";
    $sql .= " where notice_num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'notice.php?page=$page';
	      </script>
	  ";
?>

   
