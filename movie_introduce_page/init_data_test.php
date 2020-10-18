<?php
include_once "./common/database/db_connector.php";

function user_init_data(){
    $sql ="INSERT INTO `user_test` VALUES "; 
    
    $user_mail = array('1st@naver.com', '2st@gmail.com', '3st@hanmail.net', '4st@nate.com', '5st@zum.com');
    $password = rand(1, 1000);
    $user_name =  array('이시형', '임훈사', '홍용천', '박다니엘', '오선환');
    $user_nickname = array('1st', '2st', '3st', '4st', '5st');
    $user_img = array('user_robot_avatar0.png', 'user_robot_avatar1.png', 'user_robot_avatar2.png', 'user_robot_avatar3.png', 'user_robot_avatar4.png');
    $user_age = rand(20, 30);
    $user_gender = array('male');
    $user_phone = randomDate('010-1111-1111', '010-9999-9999');
    $user_signup_day = randomDate('2020-01-01', '2020-10-18');

    for($no = 1; $no<= 100 ; $no++) {
       
        $sql .= "($no, $user_mail, $password, $user_nickname, $user_name, $user_img, $user_age, $user_gender, $user_phone, $user_signup_day)";
    }
    return $sql;
    }    
?>