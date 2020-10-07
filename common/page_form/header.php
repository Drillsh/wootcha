<div id="top">
    <h3><a href="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/index.php"> WOOTCHA </a></h3>
    <div id="top_menu">
        <form class="search_form" method="post" action="http://<?= $_SERVER['HTTP_HOST']; ?>/wootcha/search/search_index.php">
            <input class="search_input" type="text" placeholder="영화 제목을 검색해보세요:)" name="search_keyword">
            <button class="search_result_btn" id="search">검색</button>
            <select class="search_result_btn" name="country">
                <option value="">국가</option>
                <option value="KR">한국</option>
                <option value="JP">일본</option>
                <option value="US">미국</option>
                <option value="HK),">홍콩</option>
                <option value="GB">영국</option>
                <option value="FR">프랑스</option>
                <option value="ETC">기타</option>
            </select>
            <select class="search_result_btn" name="genre">
                <option value="">장르</option>
                <option value="1">드라마</option>
                <option value="2">판타지</option>
                <option value="3">서부</option>
                <option value="4">공포</option>
                <option value="5">로맨스</option>
                <option value="6">모험</option>
                <option value="7">스릴러</option>
                <option value="8">느와르</option>
                <option value="9">컬트</option>
                <option value="10">다큐멘터리</option>
                <option value="11">코미디</option>
                <option value="12">가족</option>
                <option value="13">미스터리</option>
                <option value="14">전쟁</option>
                <option value="15">애니메이션</option>
                <option value="16">범죄</option>
                <option value="17">뮤지컬</option>
                <option value="18">SF</option>
                <option value="19">액션</option>
                <option value="20">무협</option>
                <option value="21">에로</option>
                <option value="22">서스펜스</option>
                <option value="23">서사</option>
                <option value="24">블랙코미디</option>
                <option value="25">실험</option>
                <option value="26">영화카툰</option>
                <option value="27">영화음악</option>
                <option value="28">영화패러디포스터</option>
            </select>
        </form>
        <div class="search_profile">
            <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/wootcha/mypage/mypage_index.php"><img src="https://ca-times.brightspotcdn.com/dims4/default/444499c/2147483647/strip/true/crop/3000x2000+0+0/resize/840x560!/quality/90/?url=https%3A%2F%2Fcalifornia-times-brightspot.s3.amazonaws.com%2F7d%2F24%2F0d9fed4c40c285ffca41843ae569%2Fdecadefood.jpg"></a>
        </div>
    </div>
</div>
