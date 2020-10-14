<?php

    $no   = $_POST['no'];
    $phone = $_POST['phone'];
    $expiry_day = $_POST['expiry_day'];

    include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";
    for($i = 0; $i < count($no); $i++){

        $un = $user_num[$i];
        $exp = $expiry_day[$i];
        $n = $no[$i];

        $sql = "update `user` set user_num = {$n} where no={$n}";

        $result = mysqli_query($con, $sql);
        if(!$result){
            mysqli_close($con);
            die('Could not update data - ' . mysqli_error($con));
        }

    }

    mysqli_close($con);
    echo "1";
?>

