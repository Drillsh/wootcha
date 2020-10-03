<div id="top">
    <h3><a href="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/index.php"> WOOTCHA </a></h3>
    <div id="top_menu">
        <form class="search_form" method="post" action="search/search_index.php">
            <input class="search_input" type="text" placeholder="작품 제목,배우,감독을 검색해보세요" name="search_keyword">
            <button class="search_result_btn" id="search">검색</button>
            <button class="search_result_btn" type="button" name="search_filter" id="keyword_btn">&nbsp필터 ▼</button>
        </form>
        <div class="search_profile">
            <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/wootcha/mypage/mypage_index.php"><img src="https://ca-times.brightspotcdn.com/dims4/default/444499c/2147483647/strip/true/crop/3000x2000+0+0/resize/840x560!/quality/90/?url=https%3A%2F%2Fcalifornia-times-brightspot.s3.amazonaws.com%2F7d%2F24%2F0d9fed4c40c285ffca41843ae569%2Fdecadefood.jpg"></a>
        </div>
    </div>
</div>
