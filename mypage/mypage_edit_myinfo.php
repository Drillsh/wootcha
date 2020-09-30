<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wootcha</title>
        <link rel="stylesheet" type="text/css" href="./css/mypage.css">
        <!-- <link rel="stylesheet" type="text/css" href="./css/mypage_comment_list_item.css"> -->
    </head>
    <body>
        <!-- 헤더 -->
        <header>헤더</header>

        <!-- 네비게이션 : 왼쪽 -->
        <nav class="nav_left">
            <?php include "./mypage_nav_left.php"?>
        </nav>

        <!-- 섹션 -->
        <section id="section">
            <header class="section_header">
                <span class="title_sub">마이 페이지 &nbsp&nbsp > &nbsp&nbsp 내 정보 수정</span><br><br>
                <span class="title_main">내 정보 수정</span>
            </header>
            <div class="section_container">
                <!-- db에서 가져온 값이 들어갈 것 -->
                <table>
                    <tr><td>프로필사진</td><td><input type="text" readonly></td></tr>
                    <tr><td>아이디</td><td><input type="text" readonly></td></tr>
                    <tr><td>이름</td><td><input type="text" readonly></td></tr>
                    <tr><td>생년월일</td><td><input type="text" readonly></td></tr>
                    <tr><td>가입일자</td><td><input type="text" readonly></td></tr>
                    <tr><td>닉네임</td><td><input type="text" ></td></tr>
                    <tr><td>전화번호</td><td><input type="text"></td></tr>
                    <tr><td>비밀번호</td><td><input type="text"></td></tr>
                    
                
                </table>


            </div><!-- section_container -->
        </section><!-- section -->
        
        <!-- 푸터 -->
        <footer>푸터</footer>
    </body>
</html>