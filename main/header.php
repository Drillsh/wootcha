<?php
    // session 을 읽고, 쓰고, 수정, 삭제 등 하려면 session_start() 해야함
    session_start();
    // 모든 페이지에서 확인 해야함, session 로그인할 때 넣어주고 로그아웃할 때는 없애야함
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";
    if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
    else $userpoint = "";
?>		
        <div id="top">
            <h3>
                <a href="#">WOOTCHA Test</a>
            </h3>
            <ul id="top_menu">  
<?php
    // php에서 null은 false다
    if(!$userid == true) {
?>                
                <li><a href="#">회원 가입</a> </li>
                <li> | </li>
                <li><a href="#">로그인</a></li>
<?php
    } else {
                $logged = $username."(".$userid.")님[Level:".$userlevel.", Point:".$userpoint."]";
?>
                <li><?=$logged?> </li>
                <li> | </li>
                <li><a href="#">로그아웃</a> </li>
                <li> | </li>
                <li><a href="#">정보 수정</a></li>
<?php                
                if($userlevel !=1){
?>
                <li> | </li>
                <li><a href="#">회원 탈퇴</a></li>
                
<?php
                }
    }
?>
<?php
    //관리자 구분함
    if($userlevel==1) {
?>
                <li> | </li>
                <li><a href="#">관리자 모드</a></li>
<?php
    }else{
?>
                

<?php
}
?>
            </ul>
        </div>
        <div id="menu_bar">
            <ul>
                <li class="custom-btn btn_style-1"><a href="#">HOME</a></li>                                  
                <li class="custom-btn btn_style-1"><a href="#">게시판</a></li>
                <li class="custom-btn btn_style-1"><a href="#">공지사항</a></li>
                <li class="custom-btn btn_style-1"><a href="#">메세지</a></li>
                <li class="custom-btn btn_style-1"><a href="#">Q&A게시판</a></li>
            </ul>
        </div>