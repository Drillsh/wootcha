<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/question/css/greet.css">
    <script src="./js/member_form.js"></script>
    <!-- <link rel="stylesheet" href="../css/memo.css"> -->
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
  <?php
include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";
include $_SERVER['DOCUMENT_ROOT']."/wootcha/question/lib/free_func.php";
$num=$id=$subject=$content=$day=$hit=$image_width=$q_num="";
$file_type_0="";
if(empty($_GET['page'])){
  $page=1;
}else{
  $page=$_GET['page'];
}

if(isset($_GET["num"])&&!empty($_GET["num"])){
    $num = test_input($_GET["num"]);
    $hit = test_input($_GET["hit"]);
    $q_num = mysqli_real_escape_string($con, $num);

    $sql="UPDATE `qna_board` SET `qna_hit`=$hit WHERE `qna_num`=$q_num;";
    $result = mysqli_query($con,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($con));
    }

    // $sql="SELECT * from `qna_board` where qna_num ='$q_num';";
    $sql = "SElECT * from `qna_board` a join `user` b on a.user_num=b.user_num where qna_num=$q_num";
    $result = mysqli_query($con,$sql);
    if (!$result) {
      echo "<script>alert()</script>";
      die('Error: ' . mysqli_error($con));
    }
    
    $row=mysqli_fetch_array($result);
    $id=$row['user_nickname'];
    // $name=$row['name'];
    // $nick=$row['nick'];
    $hit=$row['qna_hit']; 
    // echo "<script>alert($hit)</script>";
    $subject= htmlspecialchars($row['qna_title']);
    $content= htmlspecialchars($row['qna_contents']);
    $subject=str_replace("\n", "<br>",$subject);
    $subject=str_replace(" ", "&nbsp;",$subject);
    $content=str_replace("\n", "<br>",$content);
    $content=str_replace(" ", "&nbsp;",$content);
    // $is_html=$row['is_html'];
    $file_name_0=$row['qna_file_name'];
    $file_copied_0=$row['qna_file_copied'];
    $file_type_0=$row['qna_file_type'];
    $day=$row['qna_regtime'];

    //숫자 0 " " '0' null 0.0   $a = array()
    if(!empty($file_copied_0)&&$file_type_0 =="image"){
      //이미지 정보를 가져오기 위한 함수 width, height, type
      $image_info=getimagesize("./data/".$file_copied_0);
      $image_width=$image_info[0];
      $image_height=$image_info[1];
      $image_type=$image_info[2];
      if($image_width>400) $image_width = 400;
    }else{
      $image_width=0;
      $image_height=0;
      $image_type="";
    }

}

?>
  <section id="question_view_section">

  <!-- <div id="main_img_bar">
		<img src= "http://<?php echo $_SERVER['HTTP_HOST'];?>/wootcha/question/img/main_img.png">
  </div>  -->
    <div id="wrap">
      <div id="content">
       <div id="col2">
         <div id="title"><h3>답변형 게시판</h3></div>
         <div class="clear"></div>
         <div id="write_form_title"></div>
         <div class="clear"></div>
            <div id="write_form">
              <div class="write_line"></div>
              <div id="write_row1">
                <div class="col1">아이디</div>
                <div class="col2"><?=$id?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  조회 : <?=$hit?> &nbsp;&nbsp;&nbsp; 입력날짜: <?=$day?>
                </div>

              </div><!--end of write_row1  -->
              <div class="write_line"></div>
              <div id="write_row2">
                <div class="col1">제&nbsp;&nbsp;목</div>
                <div class="col2"> <input type="text" name="subject" value="<?=$subject?>" readonly></div>
              </div><!--end of write_row2  -->
              <div class="write_line"></div>

              <div id="view_content">
                <div class="col2">
                  <!-- < ?php
                    if($file_type_0 =="image"){
                      echo "<img src='./data/$file_copied_0' width='$image_width'><br>";
                    }elseif(!empty($_SESSION['user_nickname'])&&!empty($file_copied_0)){
                      $file_path = "./data/".$file_copied_0;
                      $file_size = filesize($file_path);
                      //2. 업로드된 이름을 보여주고 [저장] 할것인지 선택한다.
                      echo ("
                        ▷ 첨부파일 : $file_name_0 &nbsp; [ $file_size Byte ]
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href='download.php?mode=download&num=$q_num'>저장</a><br><br>
                      ");
                    }
                  ?> -->
                  <?=$content?>
                </div><!--end of col2  -->
              </div><!--end of view_content  -->
            </div><!--end of write_form  -->

<!--덧글내용시작  -->
<div id="ripple">
  <div id="ripple1"><h4>덧글</h4><br><hr></div>
  <div id="ripple2">
    <?php
      $sql="select * from `qna_reply` a inner join user b on a.user_num=b.user_num where qna_num='$q_num' ";
      $ripple_result= mysqli_query($con,$sql);
      while($ripple_row=mysqli_fetch_array($ripple_result)){
        $ripple_num=$ripple_row['qna_reply_num'];
        $ripple_id=$ripple_row['user_num'];
        $ripple_usernick=$ripple_row['user_nickname'];
        $ripple_nick =$ripple_row['qna_num'];
        $ripple_date=$ripple_row['qna_reply_regtime'];
        $ripple_content=$ripple_row['qna_reply_contnents'];
        $ripple_content=str_replace("\n", "<br>",$ripple_content);
        $ripple_content=str_replace(" ", "&nbsp;",$ripple_content);
    ?>
        <div id="ripple_title">
          <ul>
            <li><?=$ripple_usernick."&nbsp;&nbsp;".$ripple_date."&nbsp;&nbsp;"."&nbsp;&nbsp;"?> <?php
            $message =free_ripple_delete($ripple_usernick,$ripple_num,"dml_board.php",$page,$hit,$q_num);
            // echo "<script>alert($ripple_id,$ripple_id,$page,$hit,$q_num)</script>";
            echo $message;
            ?></li>
            <li id="mdi_del">
           
            </li>
          </ul>
        </div>
        <div id="ripple_content">
          <?=$ripple_content?>
        </div>
    <?php
      }//end of while
      mysqli_close($con);
    ?>

    <form name="ripple_form" action="dml_board.php?mode=insert_ripple" method="post">
      <input type="hidden" name="parent" value="<?=$q_num?>">
      <input type="hidden" name="hit" value="<?=$hit?>">
      <input type="hidden" name="page" value="<?=$page?>">
      <div id="ripple_insert">
        <div id="ripple_textarea"><textarea name="ripple_content" rows="3" cols="80"></textarea></div>
        <div id="ripple_button"> <input type="image"  src="./img/memo_ripple_button.png"></div>
      </div><!--end of ripple_insert -->
    </form>
  </div><!--end of ripple2  -->
</div><!--end of ripple  -->

<div id="write_button">
    <a href="./question_main.php?page=<?=$page?>"><img src="./img/list.png"></a>

  <?php
    //관리자이거나 해당된 작성자일경우 수정, 삭제가 가능하도록 설정
    if($_SESSION['user_nickname']=="admin" || $_SESSION['user_nickname']==$id){
      echo('<a href="./write_edit_form.php?mode=update&num='.$num.'"><img src="./img/modify.png"></a>&nbsp;');
      echo('<img src="./img/delete.png" onclick="check_delete('.$num.')">&nbsp;');
    }
    //로그인하는 유저에게 글쓰기 기능을 부여함.
    if(!empty($_SESSION['user_nickname'])){
    echo '<a href="write_edit_form.php"><img src="./img/write.png"></a>';
    }
  ?>
</div><!--end of write_button-->
</div><!--end of col2  -->
</div><!--end of content -->
</div><!--end of wrap  -->
</section>

<footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/page_form/footer.php"; ?>
    </footer> 
</body>
</html>
