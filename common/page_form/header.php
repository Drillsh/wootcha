<div id="top">
    <h3>Wootcha</h3>
    <div id="top_menu">
        <form class="search_form" action="index_search.php" method="post">
            <input class="search_input" type="text" placeholder="작품 제목,배우,감독을 검색해보세요" name="r_name">
            <button class="search_result_btn" id="search">검색</button>
            <button type="button" name="button" class="search_result_btn" id="keyword_btn">&nbsp필터 ▼</button>
        </form>
        <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/mypage/mypage_index.php">마이페이지(프로필 사진)</a>
    </div>
</div>
