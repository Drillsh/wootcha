<!DOCTYPE html>
<html>

<head>
    <title>영화 상세 페이지</title>
    <link rel="stylesheet" href="./css/movie_introduce_content.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
</head>

<body>
    <table id="movie_introduce_container">
      <h1>영화 상세 페이지</h1>

<ul class="slides">
    <input type="radio" name="radio-btn" id="img-1" checked />
    <li class="slide-container">
        <div class="slide">
            <img src="http://farm9.staticflickr.com/8072/8346734966_f9cd7d0941_z.jpg" />
        </div>
        <div class="nav">
            <label for="img-6" class="prev">&#x2039;</label>
            <label for="img-2" class="next">&#x203a;</label>
        </div>
    </li>

    <input type="radio" name="radio-btn" id="img-2" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8504/8365873811_d32571df3d_z.jpg" />
        </div>
        <div class="nav">
            <label for="img-1" class="prev">&#x2039;</label>
            <label for="img-3" class="next">&#x203a;</label>
        </div>
    </li>

    <input type="radio" name="radio-btn" id="img-3" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8068/8250438572_d1a5917072_z.jpg" />
        </div>
        <div class="nav">
            <label for="img-2" class="prev">&#x2039;</label>
            <label for="img-4" class="next">&#x203a;</label>
        </div>
    </li>

    <input type="radio" name="radio-btn" id="img-4" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8061/8237246833_54d8fa37f0_z.jpg" />
        </div>
        <div class="nav">
            <label for="img-3" class="prev">&#x2039;</label>
            <label for="img-5" class="next">&#x203a;</label>
        </div>
    </li>

    <input type="radio" name="radio-btn" id="img-5" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8055/8098750623_66292a35c0_z.jpg" />
        </div>
        <div class="nav">
            <label for="img-4" class="prev">&#x2039;</label>
            <label for="img-6" class="next">&#x203a;</label>
        </div>
    </li>

    <input type="radio" name="radio-btn" id="img-6" />
    <li class="slide-container">
        <div class="slide">
          <img src="http://farm9.staticflickr.com/8195/8098750703_797e102da2_z.jpg" />
        </div>
        <div class="nav">
            <label for="img-5" class="prev">&#x2039;</label>
            <label for="img-1" class="next">&#x203a;</label>
        </div>
    </li>

    <li class="nav-dots">
      <label for="img-1" class="nav-dot" id="img-dot-1"></label>
      <label for="img-2" class="nav-dot" id="img-dot-2"></label>
      <label for="img-3" class="nav-dot" id="img-dot-3"></label>
      <label for="img-4" class="nav-dot" id="img-dot-4"></label>
      <label for="img-5" class="nav-dot" id="img-dot-5"></label>
      <label for="img-6" class="nav-dot" id="img-dot-6"></label>
    </li>
</ul>
    
<div id="movie_introduce">
    <div id="movie_subject">
        <h2>영화 제목란</h2>
</div>

<span><input type=button id="good_see_movie"></span>
<span><input type=button id="favorite_movie"></span>
<div id="movie_smail_introduce"><h2>개봉 날짜 / 장르 / 국가 / 러닝타임</h2></div>
<div id="movie_score"><h2>평점 박스</h2></div>

    <div id="movie_content">
        <h2>영화 줄거리란</h2>
</div>

<div id="movie_casting_container"><h2>영화 출연진 목록</h2>
<div id="movie_cast_1"></div>
<div id="movie_cast_2"></div>
<div id="movie_cast_3"></div>
<div id="movie_cast_4"></div>
<span><input type=button id="movie_casting_prev"></span>
<span><input type=button id="movie_casting_next"></span>
</div>

<div id="movie_comment_container"><h2>영화 코멘트 목록</h2>
<div id="movie_comment_box_1"><h2>영화 코멘트 박스 (1)</h2></div>
<div id="movie_comment_box_2"><h2>영화 코멘트 박스 (2)</h2></div>
<div id="movie_comment_box_3"><h2>영화 코멘트 박스 (3)</h2></div>
<div id="movie_comment_box_4"><h2>영화 코멘트 박스 (4)</h2></div>
<div id="movie_comment_box_5"><h2>영화 코멘트 박스 (5)</h2></div>
<div id="movie_comment_box_6"><h2>영화 코멘트 박스 (5)</h2></div>

</div>






</div>


    



</table>

</body>

</html>