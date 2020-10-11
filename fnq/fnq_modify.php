<?php
    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["faq_title"];
    $content = $_POST["faq_contents"];
          
	include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";
    $sql = "update faq_board set faq_title='$subject', faq_contents='$content' ";
    $sql .= " where faq_num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'fnq_main.php?page=$page';
	      </script>
	  ";
?>

   
