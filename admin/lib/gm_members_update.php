<?php

    $no   = $_POST['no'];
    $phone = $_POST['phone'];
    $expiry_day = $_POST['expiry_day'];

    include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";
    for($i = 0; $i < count($no); $i++){

        $ph = $phone[$i];
        $exp = $expiry_day[$i];
        $n = $no[$i];

        $sql = "update g_members set phone='$ph', expiry_day='$exp' where no=$n";

        $result = mysqli_query($con, $sql);
        if(!$result){
            mysqli_close($con);
            die('Could not update data - ' . mysqli_error($con));
        }

    }

    mysqli_close($con);
    echo "1";
?>

