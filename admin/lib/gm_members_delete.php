<?php

    $no   = $_POST['no'];

    include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";

    for($i = 0; $i < count($no); $i++){

        $n = $no[$i];
        $sql = "delete from qna_board where qna_num = $n;";

        if(!mysqli_query($con, $sql)){
            echo "0";
            die;
        };
    }

    mysqli_close($con);
    
    echo "1";

?>

