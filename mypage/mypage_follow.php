<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wootcha</title>
        <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/common/css/common.css?after">
        <link rel="stylesheet" type="text/css" href="./css/mypage.css?after">
        <link rel="stylesheet" type="text/css" href="./css/mypage_follow_item.css?after">
        <?php include_once $_SERVER['DOCUMENT_ROOT']."/wootcha/common/database/db_connector.php"; ?>
    </head>
    <body>
        <!-- 헤더 -->
        <header>
            <?php include "../common/page_form/header.php"?>
        </header>

        <!-- 네비게이션 : 왼쪽 -->
        <nav class="nav_left">
            <?php include "./mypage_nav_left.php"?>
        </nav>
                <?php
                    $query = "select user_num, user_nickname, user_img, user_mail from user;";
                    $result = mysqli_query($con, $query);
                    $row_count = $result->num_rows;
                ?>
        <!-- 섹션 -->
        <section id="section">
            <header class="section_header">
                <span class="title_sub"><?=$title_sub?> 페이지 &nbsp&nbsp > &nbsp&nbsp 팔로우</span><br><br>
                <span class="title_main">팔로우 <h5 id="row_count"><?=$row_count?> 명</h5></span>
            </header>
            <div class="section_container">
                <ul>
                
                <?php
                if ($row_count != 0) {
                    while ($row = mysqli_fetch_array($result)) {
                ?>  
                    <!-- db에서 가져온 값이 들어갈 것 -->
                    <li class='list_item'>
                        <a href='mypage_index.php?userpage_user_num=<?=$row['user_num']?>'>
                            <div class='img_box'>
                <?php
                            if (strlen($row['user_img']) > 22) {
                                echo "<img src='".$row['user_img']."' alt=''>";
                            }else{ 
                                echo "<img src='../user/img/".$row['user_img']."' alt=''>";
                            }
                ?>            
                            </div>

                            <h3><?=$row['user_nickname']?></h3>
                        </a>
                    </li>
                <?php
                    }
                }else{
                    echo "<div>팔로우 리스크가 없습니다. </div>";
                }
                ?>
                </ul>
            </div><!-- section_container -->
        </section><!-- section -->
        
        <!-- 푸터 -->
        <footer>
            <?php include "../common/page_form/footer.php"?>
        </footer>
    </body>
</html>