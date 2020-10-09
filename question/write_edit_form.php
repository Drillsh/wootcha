<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/question/css/greet.css">
    <script type="text/javascript" src="./js/member_form.js"></script>
    <script src="../js/vendor/jquery-1.10.2.min.js"></script>
    <!-- script는 웹페이지에 스크립트를 추가한다 -->
    <script src="../js/vendor/jquery-ui-1.10.3.custom.min.js?ver=3"></script>
    <script src="../js/main.js"></script>
    <title></title>
  </head>
  <body>
  <header>
  <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/header.php"; ?>
  </header> 
  <!-- <div id="main_img_bar">
		<img src= "http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/img/main_img.png">
  </div> -->
  <?php
include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";

if(!isset($_SESSION['user_mail'])){
  echo "<script>alert('권한없음11!');history.go(-1);</script>";
  exit;
}

$mode="insert";
$checked="";
$subject="";
$content="";
$id= $_SESSION['user_mail'];

if(isset($_GET["mode"])&&$_GET["mode"]=="update"){
    $mode="update";
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($con, $num);

    $sql="SELECT * from `user` where user_num ='$q_num';";
    $result = mysqli_query($con,$sql);

    if (!$result) alert_back("Error: " . mysqli_error($con));

    $row=mysqli_fetch_array($result);
    $id=$row['user_name'];
    $subject= htmlspecialchars($row['subject']);
    $content= htmlspecialchars($row['content']);
    $subject=str_replace("\n", "<br>",$subject);
    $subject=str_replace(" ", "&nbsp;",$subject);
    $content=str_replace("\n", "<br>",$content);
    $content=str_replace(" ", "&nbsp;",$content);
    $file_name_0=$row['file_name_0'];
    $file_copied_0=$row['file_copied_0'];
    $day=$row['regist_day'];
    $is_html=$row['is_html'];
    $checked=($is_html=="y")? ("checked"):("");
    $hit=$row['hit'];
    mysqli_close($con);
}
?>

  <div id="wrap">
       <div id="col2">
         <div id="title"><h3>답변형 게시판 > 가입인사</h3></div>
         <div class="clear"></div>
         <div id="write_form_title"><img src="./img/write_form_title.gif"></div>
         <div class="clear"></div>
         <form name="board_form" action="dml_board.php?mode=<?=$mode?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="num" value="<?=$num?>">
          <input type="hidden" name="hit" value="<?=$hit?>">
          <div id="write_form">
              <div class="write_line"></div>
              <div id="write_row1">
                <div class="col1">아이디</div>
                <div class="col2"><?=$user_mail?></div>
                <div class="col3">
                  <input type="checkbox" name="is_html" value="y" <?=$checked?>>HTML 쓰기</div>
              </div><!--end of write_row1  -->
              <div class="write_line"></div>
              <div id="write_row2">
                <div class="col1">제&nbsp;&nbsp;목</div>
                <div class="col2"><input type="text" name="subject" value=<?=$subject?>></div>
              </div><!--end of write_row2  -->
              <div class="write_line"></div>

              <div id="write_row3">
                <div class="col1">내&nbsp;&nbsp;용</div>
                <div class="col2"><textarea name="content" rows="15" cols="79"><?=$content?></textarea>  </div>
              </div><!--end of write_row3  -->
              <div class="write_line"></div>
              <div id="write_row4">
                <div class="col1">파일업로드</div>
                <div class="col2">
                  <?php
                    if($mode=="insert"){
                      echo '<input type="file" name="upfile" >이미지(2MB)파일(0.5MB)';
                    }else{
                  ?>
                    <input type="file" name="upfile" onclick='document.getElementById("del_file").checked=true; document.getElementById("del_file").disabled=true'>
                 <?php
                    }
                  ?>
                  <?php
                    if($mode=="update" && !empty($file_name_0)){
                      echo "$file_name_0 파일등록";
                      echo '<input type="checkbox" id="del_file" name="del_file" value="1">삭제';
                      echo '<div class="clear"></div>';
                    }
                  ?>
                </div><!--end of col2  -->
              </div><!--end of write_row4  -->
              <div class="clear"></div>

              <div class="write_line"></div>
              <div class="clear"></div>
            </div><!--end of write_form  -->

            <div id="write_button">
              <input type="image" onclick='document.getElementById("del_file").disabled=false' src="./img/ok.png">&nbsp;
              <a href="./list.php"><img src="./img/list.png"></a>
            </div><!--end of write_button-->
         </form>

      </div><!--end of col2  -->
      </div><!--end of content -->
    </div><!--end of wrap  -->
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
    </footer> 
  </body>
</html>
