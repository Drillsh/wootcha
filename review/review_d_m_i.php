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
            // $url = "http://".$_SERVER['HTTP_HOST']."/wootcha/mypage/mypage_index.php?userpage_user_num=$user_num";
            // echo "<script>alert('리뷰 삭제를 성공했습니다.');location.href = '$url';</script>";
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
            $url = "http://".$_SERVER['HTTP_HOST']."/wootcha/mypage/mypage_index.php?userpage_user_num=$user_num";
            echo "<script>alert('리뷰 수정을 성공했습니다.');location.href = '$url';</script>";
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
            $url = "http://".$_SERVER['HTTP_HOST']."/wootcha/mypage/mypage_index.php?userpage_user_num=$user_num";
            echo "<script>alert('리뷰 삭제를 성공했습니다.');location.href = '$url';</script>";
            break;
        
        // ****************
        // insert_reply
        // ****************
        case 'insert_reply':
            // 리뷰 pk
            $review_num = $_POST['review_num'];
            $userpage_user_num = $_POST['userpage_user_num'];
            $review_reply_contents = $_POST['review_reply_contents'];
            $review_reply_regtime = date("Y-m-d (H:i)");

            $review_reply_contents = mysqli_real_escape_string($con, $review_reply_contents);
            $review_reply_contents = test_input($review_reply_contents);

            $query = "insert into review_reply ";
            $query .= " values(null, $review_num, $user_num, '$review_reply_contents', '$review_reply_regtime');";

            $result = mysqli_query($con, $query);
            if($result == false){
                $error = mysqli_error($con);
                mysqli_close($con);
                echo "<script>alert('댓글 작성을 실패했습니다. : $error');
                        history.go(-1);</script>";
                        exit;
            }
            
            $query = "select RR.review_reply_num, RR.review_reply_contents, RR.review_reply_regtime, U.user_nickname, U.user_img, U.user_num  
            from review_reply RR
            inner join user U
            on RR.user_num = U.user_num
            where RR.review_num = $review_num 
            order by RR.review_reply_regtime DESC;";

            $result = mysqli_query($con, $query);
            
            header("replycount: $result->num_rows");

            for ($i=0; $i < $result->num_rows; $i++) { 
                mysqli_data_seek($result,$i);
                $row = mysqli_fetch_array($result);
            
                $review_reply_num = $row['review_reply_num'];
                $review_reply_contents = $row['review_reply_contents'];
                $review_reply_regtime = $row['review_reply_regtime'];
                $user_nickname = $row['user_nickname'];
                $user_img = $row['user_img'];
                $user_num = $row['user_num'];

                echo "<div class='comments_item'>
                        <!-- profile image -->
                        <div class='profile_box'>
                            <!-- 댓글 을 쓴 사람의 num을 받아서 a로 넘겨야함 -->
                            <!-- mypage주소에 get방식으로 user_num을 보내야함 -->
                            <a href='mypage_index.php?userpage_user_num=$user_num'>
                                <div class='small_img_box'>
                                    <img src='../user/img/$user_img' alt='프로필 이미지 수정'>
                                </div>
                                <!-- 닉네임 -->
                                <p>$user_nickname</p>
                            </a>
                        </div>
                        <div class='comment_content'>
                            <!-- 댓글 내용 -->
                            <p>$review_reply_contents</p>
                        </div>
                    </div>";
            }
            break;
        
        default:
            break;
    }
    mysqli_close($con);
    
?>

