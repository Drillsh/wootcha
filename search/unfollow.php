<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"]."/wootcha/common/database/db_connector.php";

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

    $sql = "DELETE FROM fav_movie WHERE mv_num = {$movie_num} AND user_num ={$user_num}";

    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
        <script>
            alert('좋아요 목록에서 삭제되었습니다.');
            history.go(-1)
        </script>
        ";
    }

?>