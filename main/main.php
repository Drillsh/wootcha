<div class="slideShow">
        <div class="slideShow_slides">
            <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/img/slide-1.jpg" alt="slide1"></a>
            <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/img/slide-2.jpg" alt="slide2"></a>
            <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/img/slide-3.jpg" alt="slide3"></a>
            <a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/img/slide-4.jpg" alt="slide4"></a>
        </div>
        <div class="slideShow_nav">
            <a href="#" class="prev">이전</a>
            <a href="#" class="next">다음</a>
        </div>
        <div class="slideShow_indicator">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
        </div>
</div>
<div class="main_center">
<div class="main_all">

    <span class="main_title" class="sub_title">테스트 &nbsp;:::&nbsp; BEST MOVIE LIST</span>

    <?php
      $con = mysqli_connect("localhost", "root", "123456", "wootchatestdb");
      $sql    = "select * from seller order by seller_num asc limit 6";
      $result = mysqli_query($con, $sql);
    ?>

      <div class="search_member">

    <?php
      while($row = mysqli_fetch_array($result)){
        $seller_num = $row['seller_num'];
        $store_name = $row['store_name'];
        $introduction = $row['introduction'];
        $sql2    = "select * from store_img where seller_num='$seller_num' order by num asc limit 1";
        $result2 = mysqli_query($con, $sql2);
        while($row2 = mysqli_fetch_array($result2)){
          $store_file_copied = $row2['store_file_copied'];
      ?>

            <a href="#">
              <p class="summary_first">
                <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/main/image/<?=$store_file_copied?>">
                  <span class="summary_span_first">#<?=$store_name?></span>
                  <span class="summary_span_second"><?=$introduction?></span>
              </p>
            </a>

      <?php
          }
        }
          mysqli_close($con);
      ?>

    </div>
  </div> <!-- end 배스트리스트 -->

<div class="main_all">

    <span class="main_title" class="sub_title">테스트 &nbsp;:::&nbsp; LIKE MOVIE LIST</span>

    <?php
      $con = mysqli_connect("localhost", "root", "123456", "wootchatestdb");
      $sql    = "select * from seller order by seller_num asc limit 6";
      $result = mysqli_query($con, $sql);
    ?>

      <div class="search_member">

    <?php
      while($row = mysqli_fetch_array($result)){
        $seller_num = $row['seller_num'];
        $store_name = $row['store_name'];
        $introduction = $row['introduction'];
        $sql2    = "select * from store_img where seller_num='$seller_num' order by num asc limit 1";
        $result2 = mysqli_query($con, $sql2);
        while($row2 = mysqli_fetch_array($result2)){
          $store_file_copied = $row2['store_file_copied'];
      ?>

            <a href="#">
              <p class="summary_first">
                <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/main/image/<?=$store_file_copied?>">
                  <span class="summary_span_first">#<?=$store_name?></span>
                  <span class="summary_span_second"><?=$introduction?></span>
              </p>
            </a>

      <?php
          }
        }
          mysqli_close($con);
      ?>

    </div>
  </div> <!-- end 무비리스트 -->
  
  <div class="main_best_score">
        <span class="main_title" class="sub_title">테스트 &nbsp;&nbsp;:::&nbsp;&nbsp; 광고 배너</span>
        <span class="main_title_sub">최신으로 홍보된 식당들을 만나보세요.</span>

        <div class="slideshow">

          <div class="slideshow_slides">

            <?php
           	$con = mysqli_connect("localhost", "root", "123456", "wootchatestdb");
            $sql    = "select * from advertise order by num asc";
            $result = mysqli_query($con, $sql);
            for($i = 0 ; $i < 5 ; $i++){
            ?>

            <div class="center_summary">

            <?php
                for($j = 0 ; $j < 4 ; $j++){
                  $row = mysqli_fetch_array($result);
                  $seller_num = $row['seller_num'];
                  $file_copied = $row['file_copied'];
                  $store_name = $row['store_name'];
                  $introduction = $row['introduction'];
            ?>

                <a href="#">
                  <p class="summary_first">

            <?php
              if($row === null){
            ?>
                    <img src="#">
                      <span class="slide_span_fourth">광고를 등록해주세요.</span>
                      <span class="slide_span_second"><?=$introduction?></span>

            <?php
              }else{
            ?>

                    <!-- <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/main/image/<?=$file_copied?>">
                      <span class="slide_span_first">#<?=$store_name?></span>
                      <span class="slide_span_second"><?=$introduction?></span> -->

              <?php
              }
              ?>

                  </p>
                </a>

              <?php
                  }
              ?>

              </div>


        <?php
            }
            mysqli_close($con);
        ?>

          </div>

          <div class="slideshow_nav">

            <a href="#" class="prev">prev</a>
            <a href="#" class="next">next</a>

          </div>

          <div class="slideshow_indicator">

            <a href="#"></a>
            <a href="#"></a>
            <a href="#"></a>
            <a href="#"></a>
            <a href="#"></a>

          </div>

        </div>
     </div> <!-- end 광고배너 -->

     <div class="slideshow">
                <?php include $_SERVER['DOCUMENT_ROOT']."/source/myHome_ver2/slid_image.php";?>
            </div>
            <!-- ********************** -->
            <!-- data list -->
            <!-- ********************** -->
            <div class="list_box">
                <h3>코드리뷰 > 목록보기</h3>
                <ul id="image_list">
                    <?php
                    // db의 code table 내용을 가져옴
                    $sql="SELECT * from `code` order by num desc;";
                    $result=mysqli_query($con,$sql);
                    
                    // 전체 레코드 수
                    $num_row = mysqli_num_rows($result);

                    // 한페이지에 나타낼 레코드 수 9개

                    // 전체 페이지 수
                    ($num_row % SCALE == 0) ? $total_page = $num_row/SCALE : $total_page = ceil($num_row/SCALE);
                    
                    //출력을 시작할 레코드 위치 구하기 : 현재 페이지에서 -1 한 값에 뿌릴 개수를 곱하여 이전에 출력한 수를 구하고 남은 위치부터 출력함
                    $start=($page -1) * SCALE;
                    mysqli_data_seek($result, $start);

                    //list 출력하기
                    $flag_break = 0;
                    while($row = mysqli_fetch_array($result)){
                ?>
                    <li class='code_view_anchor'>
                        <a href='./view.php?page=<?=$page?>&num=<?=$row['num']?>&hit=<?=$row['hit']+1?>'>
                            <span class='imageBox'>
                                <img src='./img/<?=$row['language']?>.png' alt="<?=$row['language']?>">
                            </span>
                            <span class='contentBox'>
                                <h3>제목 :
                                    <?=$row['subject']?></h3>
                                <span class="content_explain">
                                    <p>언어 :
                                        <?=$row['language']?></p>
                                    <p>날짜 :
                                        <?=$row['regist_day']?></p>
                                    <p>아이디 :
                                        <?=$row['id']?></p>
                                    <p>조회수 :
                                        <?=$row['hit']?></p>
                                </span>
                            </span>
                        </a>
                    </li>
                <?php
                    if($flag_break == 8){
                        $flag_break = 0;
                    break;
                    }else{
                        $flag_break++;
                    }
                }
                ?>
                </ul>
                <!-- ********************** -->
                <!-- 하단 페이지 수 -->
                <!-- ********************** -->
                <ul id="page_num">
                <?php
	if ($total_page>=2 && $page >= 2)	
	{
		$new_page = $page-1;
		echo "<li><a href='code_list.php?page=$new_page'>◀ 이전</a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++){
        // 현재 페이지 번호 링크 안함
        if ($page == $i){
			echo "<li><b> $i </b></li>";
		}else{
			echo "<li><a href='code_list.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)	{
		$new_page = $page+1;	
		echo "<li> <a href='code_list.php?page=$new_page'>다음 ▶</a> </li>";
	}else 
		echo "<li>&nbsp;</li>";
?>
                </ul>

                <!-- ********************** -->
                <!-- 하단 글쓰기 버튼 -->
                <!-- ********************** -->
                <ul class="buttons">
                    <li>
                        <?php 
                //로그인 안해도 글쓰기 버튼을 보여줌, 바로 alert 찍을 수 있도록 설계함
                if($userid) {
                ?>
                        <button onclick="location.href='code_write_edit_form.php'">글쓰기</button>
                    <?php
                } else {
                ?>
                        <a href="javascript:alert('로그인 후 이용해 주세요!')">
                            <button>글쓰기</button>
                        </a>
                        <?php
                }
                ?>
                    </li>
                </ul>
            </div>
</div>


