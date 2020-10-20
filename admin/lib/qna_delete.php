<?php

    $no   = $_POST['no'];

    include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";
    for($i = 0; $i < count($no); $i++){

        $n = $no[$i];
        $sql = "DELETE FROM qna_board WHERE qna_num = $n;";

        if(!mysqli_query($con, $sql)){
            echo "0";
            die(mysqli.error($con));
        };
    
    }

    mysqli_close($con);
    
    echo "1";

?>

