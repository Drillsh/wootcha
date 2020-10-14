<?php

    $no   = $_POST['no'];
    $nickName = $_POST['nick'];

    include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";
    for($i = 0; $i < count($no); $i++){

        $nick = $nickName[$i];
        $n = $no[$i];

        $sql = "update `user` set user_nickname = '{$nick}' where user_num = {$n}";

        $result = mysqli_query($con, $sql);

        if(!$result){
            echo "0";
            mysqli_close($con);
            die('Could not update data - ' . mysqli_error($con));
        }
    }

    mysqli_close($con);
    echo "1";
?>

