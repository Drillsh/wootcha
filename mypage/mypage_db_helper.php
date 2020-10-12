<?php
    // *******************
    // select 문
    // *******************
    function select_data($con, $query_mode, $var){
        // 쿼리문 결정
        switch ($query_mode) {
            case 'select_user':
                $sql = "select * from user where user_mail = '$var'";
                break;

            case 'select_my_review':
                $sql = "select * from review R inner join movie M on R.mv_num = M.mv_num where R.user_num = $var order by R.review_num DESC limit 4;";
                break;

            case 'select_my_review_reply':
                $sql = "select RR.review_reply_num, RR.review_reply_contents, RR.review_reply_regtime, U.user_nickname, U.user_img, U.user_num  
                from review_reply RR
                inner join user U
                on RR.user_num = U.user_num
                where RR.review_num = $var 
                order by RR.review_reply_num DESC;";
                break;

            case 'select_my_favorite_movie':
                $sql = "select * from fav_movie F 
                inner join movie M 
                on F.mv_num = M.mv_num 
                where F.user_num = $var order by F.fav_num DESC;";
                break;
            
            default:
                
                break;
        }

        // 값 가져옴
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        return $result;
    }
    
    

    
?>