<?php
 
 include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/movie_introduce_page/init_data_test.php";

    function insert_init_data($con, $table_name){
    $flag = "NO";
    $sql = "SELECT * from $table_name";
    $result = mysqli_query($con,$sql) or die('Error: '.mysqli_error($con));
    $is_set=mysqli_num_rows($result);

      if($flag=="NO") {
        $sql = user_init_data();
      if(mysqli_query($con,$sql)){
        echo "<script>alert('$table_name 테이블 초기값 설정 완료');</script>";
      } else {
        echo "<script>alert('테이블 초기값 설정 실패 :') .mysqli_error($con);</script>";
      }
    }
  }

  
  
  
