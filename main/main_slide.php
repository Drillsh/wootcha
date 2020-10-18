<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/movie_introduce_page/js/movie_introduce_contents.js"></script>
<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/wootcha/movie_introduce_page/css/movie_introduce_content.css?after">
<?php
$sql = "select A.mi_img_path, M.mv_title from (select * from `movie_img` order by rand() limit 10) as A left join movie M on A.mv_num = M.mv_num order by rand();";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
while ($row = mysqli_fetch_array($result)) {
    $mi_img_path[] = $row['mi_img_path'];
    $movie_title[] = $row['mv_title'];
}
?>
<div class="slideShow">
    <div color="#211C38" class="css-1rtfe1i-LeftGradient e1svyhwg8"></div>
    <div color="#303539" class="css-ml7z2y-RightGradient e1svyhwg9"></div>
    <div color="#211C38" class="css-tyue43-LeftBackground e1svyhwg6"></div>
    <div color="#303539" class="css-1ctk406-RightBackground e1svyhwg7"></div>
    <div class="slideShow_slides">
        <?php
        for ($i = 0; $i < count($mi_img_path); $i++) {
            echo "<a href='#'><img src='{$mi_img_path[$i]}' alt='slide1'></a>";
        }
        ?>
        <script>
            var movie_title = <?= json_encode($movie_title)?>;
        </script>
    </div>
    <div class="movie_title_main">
        <?php
            echo "<h1>영화영화제모오옹옥</h1>";
        ?>
    </div>
    <div class="slideShow_nav">
        <!--왼쪽버튼-->
        <div class="css-jxbkzh-StyledJumbotronArrowButton-StyledJumbotronArrowPrevButton eayv25j4">
                <span class="SVGInline css-1jewpj1-StyledJumbotronArrowButtonIcon eayv25j2">
                    <!--?xml version="1.0" encoding="UTF-8"?-->
                    <svg class="SVGInline-svg css-1jewpj1-StyledJumbotronArrowButtonIcon-svg eayv25j2-svg" width="12px"
                         height="22px" viewBox="0 0 12 22" version="1.1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink">
                        <!-- Generator: Sketch 57.1 (83088) - https://sketch.com -->
                        <title>arrow</title>
                        <desc>Created with Sketch.</desc>
                        <g id="UI" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="홈" transform="translate(-13.000000, -281.000000)" fill="#CCCCCC">
                              <g id="Group" transform="translate(13.000000, 281.000000)">
                                  <polygon id="arrow"
                                           transform="translate(6.000000, 10.560000) scale(-1, 1) translate(-6.000000, -10.560000) "
                                           points="9.12 10.56 -2.83182089e-13 19.68 1.44 21.12 11.28 11.28 12 10.56 1.44 -5.5067062e-14 -2.81976258e-13 1.44"></polygon>
                              </g>
                          </g>
                        </g>
                    </svg>
                </span>
        </div>
        <!-- 오른쪽버튼 -->
        <div class="css-1kvaztz-StyledJumbotronArrowButton-StyledJumbotronArrowNextButton eayv25j3">
                <span class="SVGInline css-1jewpj1-StyledJumbotronArrowButtonIcon eayv25j2">
                     <!--?xml version="1.0" encoding="UTF-8"?-->
                     <svg class="SVGInline-svg css-1jewpj1-StyledJumbotronArrowButtonIcon-svg eayv25j2-svg" width="12px"
                          height="22px" viewBox="0 0 12 22" version="1.1" xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink">
                        <!-- Generator: Sketch 57.1 (83088) - https://sketch.com -->
                        <title>arrow</title>
                        <desc>Created with Sketch.</desc>
                        <g id="UI" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="홈" transform="translate(-1255.000000, -281.000000)" fill="#CCCCCC">
                                <g id="Group" transform="translate(13.000000, 281.000000)">
                                    <polygon id="arrow"
                                             points="1251.12 10.56 1242 19.68 1243.44 21.12 1253.28 11.28 1254 10.56 1243.44 -5.5067062e-14 1242 1.44"></polygon>
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
        </div>
    </div>


    <div class="slideShow_indicator">
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">7</a>
        <a href="#">8</a>
    </div>
</div>