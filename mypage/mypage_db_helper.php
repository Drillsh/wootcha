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
            case 'select_my_reivew':
                $sql = "select * from review R inner join movie M on R.mv_num = M.mv_num where R.user_num = $var;";
                break;
            case 'select_my_reivew_reply':
                $sql = "select RR.review_reply_num, RR.review_reply_contents, RR.review_reply_regtime, U.user_name
                from review_reply RR
                inner join user U
                on RR.user_num = U.user_num
                where RR.review_num = $var 
                order by RR.review_reply_regtime DESC;";
                break;
            
            default:
                
                break;
        }

        // 값 가져옴
        $result = mysqli_query($con, $sql);

        //db 객체 반납
        // 여기서 닫으면 안됨 페이지 마지막에 닫아야함
        // mysqli_close($con);
        return $result;
    }
    
    

    
?>