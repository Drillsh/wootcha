<?php
include_once 'init_data_test.php';
function insert_init_data($conn, $table_name){
    $flag="NO";
    $sql = "SELECT * from $table_name";
    $result=mysqli_query($conn,$sql) or die('Error: '.mysqli_error($conn));
    
    if(!empty($is_set) ){
        $flag="OK";
      }
    
      if($flag=="NO"){
        $sql = user_init_data();
      } else {
        echo "";
      }

  
    
    
    if(mysqli_query($conn,$sql)){
        echo "<script>alert('$table_name 테이블 초기값 설정 완료');</script>";
      }else{
        echo "테이블 초기값 설정 실패 : ".mysqli_error($conn);
      }
    }
?>