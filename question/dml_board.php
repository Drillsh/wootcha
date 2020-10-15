<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";

if(!isset($_SESSION['user_mail'])){
    echo "<script>alert('권한없음!12');history.go(-1);</script>";
    exit;
}

$user_mail = $_SESSION['user_mail'];
$usernick = $_SESSION['user_nickname'];
$user_num =$_SESSION['user_num'];
if(isset($_GET["mode"])&&$_GET["mode"]=="insert"){
    $content = trim($_POST["content"]);
    $subject = trim($_POST["subject"]);

     if(empty($content)||empty($subject)){
       alert_back('1. 내용이나제목입력요망!');
     }

     $subject = test_input($_POST["subject"]);
     $content = test_input($_POST["content"]);
    $user_mail = test_input($user_mail);
    $hit = 0;
    // $is_html=(!isset($_POST["is_html"]))?('n'):('y');
    $q_subject = mysqli_real_escape_string($con, $subject);
    $q_content = mysqli_real_escape_string($con, $content);
    $q_user_mail = mysqli_real_escape_string($con, $user_mail);
    $regist_day=date("Y-m-d (H:i)");

    //파일업로드기능
    //1. $_FILES['upfile']로부터 5가지 배열명을 가져와서 저장한다.
    $upfile = $_FILES['upfile'];//한개파일업로드정보(5가지정보배열로들어있음)
    $upfile_name= $_FILES['upfile']['name'];//f03.jpg
    $upfile_type= $_FILES['upfile']['type'];//image/gif  file/txt
    $upfile_tmp_name= $_FILES['upfile']['tmp_name'];
    $upfile_error= $_FILES['upfile']['error'];
    $upfile_size= $_FILES['upfile']['size'];

    //2. 파일명과 확장자를 구분해서 저장한다.
    $file = explode(".", $upfile_name); //파일명과 확장자구분에서 배열저장
    $file_name = $file[0];              //파일명
    $file_extension = $file[1];         //확장자


    //3.업로드될 폴더를 지정한다.
    $upload_dir ="./data/"; //업로드된파일을 저장하는장소지정

    //4.파일업로드가성공되었는지 점검한다. 성공:0 실패:1
    //파일명이 중복되지 않도록 임의파일명을 정한다.
    if(!$upfile_error){
      $new_file_name=date("Y_m_d_H_i_s");
      $new_file_name = $new_file_name."_"."0";
      $copied_file_name= $new_file_name.".".$file_extension;
      $uploaded_file = $upload_dir.$copied_file_name;
      // $uploaded_file = "./data/2019_04_22_15_09_30_0.jpg";
    }

    //5 업로드된 파일확장자를 체크한다.  "image/gif"
    $type=explode("/", $upfile_type);


    if($type[0]=='image'){
      switch ($type[1]) {
        case 'gif': case 'jpg': case 'png': case 'jpeg':
          case 'pjpeg': break;
          default:alert_back('3. gif jpg png 확장자가아닙니다.');
        }
        //6 업로드된 파일사이즈(2mb)를 체크해서 넘어버리면 돌려보낸다.
        if($upfile_size>2000000){
          alert_back('2. 이미지파일사이즈가 2MB이상입니다.');
        }
    }else{
        //5 업로드된 파일사이즈(500kb)를 체크해서 넘어버리면 돌려보낸다.
        if($upfile_size>500000){
            alert_back('2. 파일사이즈가 500KB이상입니다.');
        }
    }

    //7. 임시저장소에 있는 파일을 서버에 지정한 위치로 이동한다.
    if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){
      alert_back('4. 서버 전송에러!!');
    }

    //8 파일의 실제명과 저장되는 명을 삽입한다.
    $sql="INSERT INTO `qna_board` VALUES (null, $user_num,'$q_subject','$q_content',$hit+1,'$regist_day','$upfile_name','$copied_file_name','$type[0]');";
    $result = mysqli_query($con,$sql);
    if (!$result) {
        alert_back('Error:5 ' . mysqli_error($con));
        // die('Error: ' . mysqli_error($conn));
    }

    //등록된사용자가 최근 입력한 이미지게시판을 보여주기 위하여 num 찾아서 전달하기 위함이다.
    $sql="SELECT qna_num from `qna_board` q left join user u on q.user_num = u.user_num where user_mail ='$user_mail' order by qna_num desc limit 1;";
    $result = mysqli_query($con,$sql);
    if (!$result) {
        alert_back('Error: 6' . mysqli_error($con));
        // die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $num=$row['qna_num'];
    mysqli_close($con);

    echo "<script>location.href='./view.php?num=$num&hit=$hit';</script>";



    }else if(isset($_GET["mode"])&&$_GET["mode"]=="delete"){
        $num = test_input($_GET["num"]);
        $q_num = mysqli_real_escape_string($con, $num);

        //삭제할 게시물의 이미지파일명을 가져와서 삭제한다.
        $sql="SELECT `qna_file_copied` from `qna_board` where qna_num ='$q_num';";
        $result = mysqli_query($con,$sql);
        if (!$result) {
          alert_back('Error: 6' . mysqli_error($con));
          // die('Error: ' . mysqli_error($conn));
        }
        $row=mysqli_fetch_array($result);
        $qna_file_copied=$row['qna_file_copied'];

        if(!empty($qna_file_copied)){
          unlink("./data/".$qna_file_copied);
        }

        $sql ="DELETE FROM `qna_board` WHERE qna_num=$q_num";
        $result = mysqli_query($con,$sql);
        if (!$result) {
          die('Error: ' . mysqli_error($conn));
        }

        $sql ="DELETE FROM `qna_reply` WHERE qna_num=$q_num";
        $result = mysqli_query($con,$sql);
        if (!$result) {
          die('Error: ' . mysqli_error($con));
        }
        mysqli_close($con);

        echo "<script>location.href='./question_main.php';</script>";

    }else if(isset($_GET["mode"])&&$_GET["mode"]=="update"){
      $usernick=$_SESSION['user_nickname'];
      $content = trim($_POST["content"]);
      $subject = trim($_POST["subject"]);
      if(empty($content)||empty($subject)){
        echo "<script>alert('내용이나제목입력요망!');history.go(-1);</script>";
        exit;
      }
      $subject = test_input($_POST["subject"]);
      $content = test_input($_POST["content"]);
      $usernick = test_input($usernick);
      $num = test_input($_POST["num"]);
      $hit = test_input($_POST["hit"]);
      $is_html=(isset($_POST["is_html"]))?('y'):('n');
      $q_subject = mysqli_real_escape_string($con, $subject);
      $q_content = mysqli_real_escape_string($con, $content);
      $q_userid = mysqli_real_escape_string($con, $usernick);
      $q_num = mysqli_real_escape_string($con, $num);
      $regist_day=date("Y-m-d (H:i)");

      //1번과 2번이 해당이 된다. 파일삭제만 체크한다..
      if(isset($_POST['del_file']) && $_POST['del_file'] =='1'){
        //삭제할 게시물의 이미지파일명을 가져와서 삭제한다.
        $sql="SELECT `qna_file_copied` from `qna_board` where qna_num ='$q_num';";
        $result = mysqli_query($con,$sql);
        if (!$result) {
          alert_back('Error: 6' . mysqli_error($con));
          // die('Error: ' . mysqli_error($conn));
        }
        $row=mysqli_fetch_array($result);
        $file_copied_0=$row['qna_file_copied'];
        if(!empty($file_copied_0)){
          unlink("./data/".$file_copied_0);
        }

        $sql="UPDATE `qna_board` SET `qna_file_name`='', `qna_file_copied` ='', `qna_file_type` =''  WHERE `qna_num`=$q_num;";
        $result = mysqli_query($con,$sql);
        if (!$result) {
          die('Error: ' . mysqli_error($con));
        }

      }

      //1번과 2번 파일삭제신경쓰지 않고 업로드가 됬느냐? 안됐는냐?
      if(!empty($_FILES['upfile']['name'])){
        //include 파일업로드기능
        include  "./lib/file_upload.php";

        $sql="UPDATE `qna_board` SET `qna_file_name`= '$upfile_name', `qna_file_copied` ='$copied_file_name', `qna_file_type` ='$type[0]' WHERE `qna_num`=$q_num;";
        $result = mysqli_query($con,$sql);
        if (!$result) {
          die('Error: ' . mysqli_error($con));
        }
      }

      //3번 파일과 상관없이 무조건 내용중심으로 update한다.
      $sql="UPDATE `qna_board` SET `qna_title`='$q_subject',`qna_contents`='$q_content',`qna_regtime`='$regist_day' WHERE `qna_num`=$q_num;";
      $result = mysqli_query($con,$sql);
      if (!$result) {
        die('Error: ' . mysqli_error($con));
      }

      echo "<script>location.href='./view.php?num=$num&page=1&hit=$hit';</script>";


    }else if(isset($_GET["mode"])&&$_GET["mode"]=="insert_ripple"){
      if(empty($_POST["ripple_content"])){
        echo "<script>alert('내용입력요망!');history.go(-1);</script>";
        exit;
      }
      // echo "<script>alert($userid)</script>";
      //"덧글을 다는사람은 로그인을 해야한다." 말한것이다.
      $userid=$_SESSION['user_nickname'];
      $q_userid = mysqli_real_escape_string($con, $userid);
      $sql="SELECT * from qna_reply INNER JOIN `user` on qna_reply.user_num = user.user_num where user.user_num";
      $result = mysqli_query($con,$sql);
      if (!$result) {
        die('Error: ' . mysqli_error($con));
      }
      $rowcount=mysqli_num_rows($result);

      if(!$rowcount){
        echo "<script>alert('없는 아이디!!');history.go(-1);</script>";
        exit;
      }else{
        $content = test_input($_POST["ripple_content"]);
        $page = test_input($_POST["page"]);
        $parent = test_input($_POST["parent"]);
        $hit = test_input($_POST["hit"]);
        $q_usernum = mysqli_real_escape_string($con, $_SESSION['user_num']);
        $q_qnanum = mysqli_real_escape_string($con, $_SESSION['qna_num']);
        $q_content = mysqli_real_escape_string($con, $content);
        $q_parent = mysqli_real_escape_string($con, $parent);
        $regist_day=date("Y-m-d (H:i)");

        $sql="INSERT INTO qna_reply VALUES (null,$q_usernum,$q_parent,'$q_content','$regist_day')";
        $result = mysqli_query($con,$sql);
        if (!$result) {
          die('Error: ' . mysqli_error($con));
        }
        mysqli_close($con);

        echo "<script>location.href='./view.php?num=$parent&page=$page&hit=$hit';</script>";
      }//end of if rowcount
    }else if(isset($_GET["mode"])&&$_GET["mode"]=="delete_ripple"){
      $page= test_input($_GET["page"]);
      $hit= test_input($_GET["hit"]);
      $parent = test_input($_POST["parent"]);
      $num = test_input($_POST["num"]);
      $q_num = mysqli_real_escape_string($con, $num);
      

      $sql ="DELETE FROM `qna_reply` WHERE qna_reply_num=$q_num";
      $result = mysqli_query($con,$sql);
      if (!$result) {
        die('Error: ' .$m= mysqli_error($con));
        
        echo "<script>alert($m)</script>";
      }
      mysqli_close($con);
     echo "<script>location.href='./view.php?num=$parent&page=$page&hit=$hit';</script>";

}//end of if insert 
    
