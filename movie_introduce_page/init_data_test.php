<?php
 include $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";

function user_init_data(){
    
    $sql ="INSERT INTO `user_test` VALUES "; 
    
    // 10부터 1000까지의 정수를 랜덤으로 출력한다.
    $user_nickname = random_int(10, 1000); 
    
    // 이미지 정보 값을 저장.
    $user_img = array('user_robot_avatar0.png', 'user_robot_avatar1.png', 'user_robot_avatar2.png', 'user_robot_avatar3.png', 'user_robot_avatar4.png');
     
    // $user_img의 문자열 값을 랜덤으로 출력한다.
    $user_img_output= array_rand($user_img);
    
    // 10부터 60까지의 정수를 랜덤으로 출력한다.
    $user_age = random_int(10, 60); 
    
    // 0부터 1까지의 정수를 랜덤으로 출력한다.
    $user_gender = random_int(0, 1);

    //  start_date와 end_date 사이의 임의의 전화번호 값을 출력한다.
    $user_phone = '010-1234-56789';
    
    // start_date와 end_date 사이의 임의의 가입일자 값을 출력한다.
    $user_signup_day = randomDate('1960-01-01', '2020-10-18');

    // user_num columm 값을 증가시킨다.
    for($no = 1; $no<= 100 ; $no++) {
       
        // query 문 실행.
        $sql .= "($no, 'test$no@naver.com', 'a123456!', user$no, 닉네임$no, $user_img[$user_img_output], $user_age, $user_gender, $user_phone, $user_signup_day)";
    }
    return $sql;
    }    
?>
