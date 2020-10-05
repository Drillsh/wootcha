<?php
    function create_table($con, $table_name){
        $flag = false;
        $sql = "show tables from sample";
        $result = mysqli_query($con, $sql) or die('Error'.mysqli_error($con));

        // 반복문을 통해서 한레코드씩 가져와서 첫번째  필드내용을
        // 조사해서 해당된 테이블명이 있는지 확인한다
        while ($row = mysqli_fetch_row($result)) {
            if ($row[0] == "$table_name") {
                $flag = true;
                break;
            }
        }// end of if(flag)

        // 해당된 테이블이 없으면 해당테이블명을 찾아서 테이블 쿼리문을 생성한다
        if($flag === false){
            switch ($table_name) {
                    // 판매자테이블
                case 'seller':
                    $sql = "CREATE TABLE `seller` (
                    `seller_num` int unsigned NOT NULL AUTO_INCREMENT,
                    `user_id` varchar(20) NOT NULL,
                    `business_license` char(10) NOT NULL,
                    `store_name` varchar(45) NOT NULL,
                    `store_type` varchar(45) NOT NULL,
                    `store_address` varchar(400) NOT NULL,
                    `store_postcode` char(10) NOT NULL,
                    `store_lat` double NOT NULL,
                    `store_lon` double NOT NULL,
                    `convenient_facilities` varchar(80) NOT NULL,
                    `introduction` text DEFAULT NULL,
                    `break_start` char(10) DEFAULT NULL,
                    `break_end` char(10) DEFAULT NULL,
                    `nokids` boolean NOT NULL,
                    `opening_day` date NOT NULL,
                    `opening_hours_start` char(10) NOT NULL,
                    `opening_hours_end` char(10) NOT NULL,
                    `store_tel` char(13) NOT NULL,
                    `special_note` text DEFAULT NULL,
                    `max_reserv_time_num_of_people` int unsigned NOT NULL,
                    `max_reserv_month` char(10) NOT NULL,
                    `intensity_of_reserv` char(10) NOT NULL,
                    `keywords`  varchar(100) NULL,
                    PRIMARY KEY (`seller_num`)
                    ) DEFAULT CHARSET=utf8 ENGINE = InnoDB;
                ";
                    break;
                        // 식당 외/내부 사진 테이블
                case 'store_img':
                    $sql = "CREATE TABLE `store_img` (
                            `num` int unsigned NOT NULL AUTO_INCREMENT,
                            `user_id` varchar(20) NOT NULL,
                            `seller_num` int unsigned NOT NULL,
                            `store_name` varchar(45) NOT NULL,
                            `store_file_name` varchar(45) NOT NULL,
                            `store_file_type` varchar(45) NOT NULL,
                            `store_file_copied` varchar(45) NOT NULL,
                            PRIMARY KEY (`num`)
                        ) DEFAULT CHARSET=utf8 ENGINE = InnoDB;
                    ";
                    break;
                case 'imsitable':
                    $sql = "";
                    break;
                default : echo "<script>alert('해당테이블명이 없습니다.');</script>"; break;
            }//end of switch
            if(mysqli_query($con,$sql)){
                        echo "<script>alert('{$table_name}테이블이 생성되었습니다.');</script>";
                    }else{
                        echo "Error 테이블 생성 실패".mysqli_error($con);
                    }
        }

        

   

    }// end of function
?>