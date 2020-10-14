<?php
// 테이블 만드는 함수
function create_triggers($con, $trigger_name)
{
    $sql = "show triggers from wootchadb;";
    $result = mysqli_query($con, $sql) or die("show triggers Error" . mysqli_error($con));
    $flag = false;

    while ($row = mysqli_fetch_row($result)) {
        if ($row[0] === "$trigger_name") {
            $flag = true;
            break;
        }
    }

    if ($flag === false) {
        switch ($trigger_name) {
            // 탈퇴 유저 관리 
            case 'get_user_withdrawal_delete':
                $sql = "DROP TRIGGER IF EXISTS get_user_withdrawal_delete;
                        DELIMITER $$
                        CREATE TRIGGER get_user_withdrawal_delete
                        AFTER delete ON user
                        FOR EACH ROW
                        BEGIN
                            declare wd_member_num int(11);
                            declare wd_signup_date varchar(20);
                            declare wd_date varchar(20);

                            set wd_member_num = OLD.user_num;
                            set wd_signup_date = OLD.user_signup_day;
                            set wd_date = DATE_FORMAT(now(),"%Y-%m-%d (%H:%i)");

                            insert into withdrawal values(null, wd_member_num, wd_signup_date, wd_date);
                        END $$
                        DELIMITER ;";
                break;

            case 'get_review_like_after_update':
                $sql = "DROP TRIGGER IF EXISTS get_review_like_after_update; 
                        DELIMITER $$ 
                        CREATE TRIGGER get_review_like_after_update 
                        AFTER update ON review_like 
                        FOR EACH ROW 
                        BEGIN 
                            declare rv_num int(11); 
                            declare state int(11); 
                            declare total_like_old int(11); 
                            declare total_like_new int(11); 

                            set rv_num = NEW.review_num; 
                            set state = NEW.like_state; 
                            set total_like_old = (select review_like from review where review_num = rv_num); 
                            if state = 1 then 
                                set total_like_new = total_like_old + 1; 
                            elseif state = 0 then 
                                set total_like_new = total_like_old - 1; 
                            end if; 
                            update review set review_like=total_like_new where review_num = rv_num; 
                        END $$ 
                        DELIMITER ; ";
                break;

            case 'get_review_like_after_insert' :
                $sql = "DROP TRIGGER IF EXISTS get_review_like_after_insert; 
                        DELIMITER $$ 
                        CREATE TRIGGER get_review_like_after_insert 
                        AFTER insert ON review_like 
                        FOR EACH ROW 
                        BEGIN 
                        	declare rv_num int(11); 
                            declare state int(11); 
                            declare total_like_old int(11); 
                            declare total_like_new int(11);  

                            set rv_num = NEW.review_num; 
                            set state = NEW.like_state; 
                            set total_like_old = (select review_like from review where review_num = rv_num); 
                        	set total_like_new = total_like_old + 1; 
                        	update review set review_like=total_like_new where review_num = rv_num; 
                        END $$ 
                        DELIMITER ;";
                break;

            case 'get_movie_total_rating_after_update':
                $sql = "DROP TRIGGER IF EXISTS get_movie_total_rating_after_update;
                        DELIMITER $$
                        CREATE TRIGGER get_movie_total_rating_after_update
                        AFTER update ON review
                        FOR EACH ROW
                        BEGIN
                            declare rating float(2,1);
                            declare movie_num int;
                            declare total_rating_old float(2,1);
                            declare total_rating_new float(2,1);
                            set rating = NEW.review_rating;
                            set movie_num = NEW.mv_num;
                            set total_rating_old = (select mv_rating from movie where mv_num = movie_num);
                            set total_rating_new = (total_rating_old + rating)/2;
                            update movie set mv_rating=total_rating_new where mv_num = movie_num;
                        END $$
                        DELIMITER ;";
                break;

            case 'get_movie_total_rating_after_insert' :
                $sql = "DROP TRIGGER IF EXISTS get_movie_total_rating_after_insert; 
                        DELIMITER $$ 
                        CREATE TRIGGER get_movie_total_rating_after_insert 
                        AFTER INSERT ON review 
                        FOR EACH ROW 
                        BEGIN 
                            declare rating float(2,1); 
                            declare movie_num int; 
                            declare total_rating_old float(2,1); 
                            declare total_rating_new float(2,1); 
                            set rating = NEW.review_rating; 
                            set movie_num = NEW.mv_num; 
                            set total_rating_old = (select mv_rating from movie where mv_num = movie_num); 
                            set total_rating_new = (total_rating_old + rating)/2; 
                            update movie set mv_rating=total_rating_new where mv_num = movie_num; 
                        END $$
                        DELIMITER ;";
                break;
            default:
                echo "<script>alert('해당 트리거명이 없습니다. 점검요청');</script>";
        }
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('{$trigger_name} 트리거가 생성되었습니다.');</script>";
        } else {
            echo "트리거 생성 실패원인" . mysqli_error($con);
        }
    }
}