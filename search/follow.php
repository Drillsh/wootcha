<?php
session_start();
if (!$_SESSION['user_num']) {
    echo "
        <script>
            alert('로그인 후 이용 가능합니다.');
            history.go(-1)
        </script>
    ";

} else {

    $movie_num = $_GET["no"];
    $user_num = $_SESSION['user_num'];

    include_once $_SERVER["DOCUMENT_ROOT"]."/wootcha/common/database/db_connector.php";
    
    $sql = "insert into fav_movie(user_num, mv_num) values({$user_num}, {$movie_num})";
    
    mysqli_query($con, $sql);
    mysqli_close($con);
    
    echo "
    <script>
        alert('좋아요 목록에 추가되었습니다.');
        history.go(-1)
    </script>
    ";
}

?>