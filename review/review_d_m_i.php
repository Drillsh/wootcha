<?php
    session_start();
    $user_num = $_SESSION['user_num'];

    // POST 방식으로 data 받음
    $mode = $_POST['mode'];
    
    
    include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php";

    switch ($mode) {
        // ****************
        // insert
        // ****************
        case 'insert':
            if(empty($_POST["review_short"])){
                echo "<script>alert('한줄평을 입력해주세요!');history.go(-1);</script>";
                exit;
            }
            // 영화 pk
            $mv_num = $_POST['mv_num'];
            // 장문평 입력 확인
            if(empty($_POST["review_long"])){
                $review_long = "";
            }else{
                $review_long = mysqli_real_escape_string($con, $_POST['review_long']);
                $review_long = test_input($review_long);
            }
            if(empty($_POST["review_rating"])) $review_rating = 0.0;
            else $review_rating = $_POST['review_rating'];
            
            $review_short = mysqli_real_escape_string($con, $_POST['review_short']);
            $review_short = test_input($review_short);
            $review_regtime = date("Y-m-d (H:i)");
            
            $query = "insert into review ";
            $query .= " values(null, $user_num, $mv_num, $review_rating, '$review_short', '$review_long', 0,0, '$review_regtime');";
            
            $result = mysqli_query($con, $query);
            if($result == false){
                $error = mysqli_error($con);
                mysqli_close($con);
                echo "<script>alert('리뷰 작성을 실패했습니다. : $error');
                history.go(-1);</script>";
                
                // exit을 하면 review_d_m_i.php 에서 즉시 나감. 하지 않으면 mysqli_close 2번 한다고 error 발생
                exit;
            }
            // 영화 상세 페이지로 이동하는 문장 필요
            
        break;
        
        // ****************
        // modify
        // ****************
        case 'modify':
            if(empty($_POST["review_short"])){
                echo "<script>alert('한줄평을 입력해주세요!');history.go(-1);</script>";
                exit;
            }
            // 리뷰 pk
            $review_num = $_POST['review_num'];
            $review_rating = $_POST['review_rating'];
            
            // 장문평 입력 확인
            if(empty($_POST["review_long"])){
                $review_long = "";
            }else{
                $review_long = mysqli_real_escape_string($con, $_POST['review_long']);
                $review_long = test_input($review_long);
            }
            
            $review_short = mysqli_real_escape_string($con, $_POST['review_short']);
            $review_short = test_input($review_short);
            $review_regtime = date("Y-m-d (H:i)");

            $query = "update review set ";
            $query .= "review_rating= $review_rating,review_short='$review_short',review_long= '$review_long',review_regtime= '$review_regtime' ";
            $query .= " where review_num = $review_num;";

            $result = mysqli_query($con, $query);
            if($result == false){
                $error = mysqli_error($con);
                mysqli_close($con);
                echo "<script>alert('리뷰 수정을 실패했습니다. : $error');
                        history.go(-1);</script>";
                        exit;
            }
            echo "<script>history.go(-2);</script>";
            break;

        // ****************
        // delete
        // ****************
        case 'delete':
            // 리뷰 pk
            $review_num = $_POST['review_num'];
            
            $query = "delete from review ";
            $query .= " where review_num = $review_num;";

            $result = mysqli_query($con, $query);
            if($result == false){
                $error = mysqli_error($con);
                mysqli_close($con);
                echo "<script>alert('리뷰 삭제를 실패했습니다. : $error');
                        history.go(-1);</script>";
                        exit;
            }
            echo "<script>alert('리뷰 삭제를 성공했습니다.');history.go(-2);</script>";
            break;
        
        default:
            break;
    }
    mysqli_close($con);
    
?>

