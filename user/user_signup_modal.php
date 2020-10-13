

<!-- ****************** -->
<!-- css -->
<!-- ****************** -->
<style type="text/css"> 
    /* 빈공간을 어둡게 채우는 창 */
    .modal_container { position: fixed; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);  z-index: 3; 
        opacity: 1;  visibility: hidden; transform: scale(1.0); transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s; } 

    /* 흰 화면의 dialog 부분 */
    .modal_container .modal_content {  position: absolute;   top: 50%;  left: 50%;  transform: translate(-50%, -50%); background-color: white; 
         padding: 1rem 1.5rem;   width: 400px;  height: 800px;   border-radius: 0.5rem; text-align:center; overflow:hidden;} 

    /* 끄기 버튼 */
    .modal_container .modal_close_btn_signup { float: right; width: 1.5rem; line-height: 1.5rem; text-align: center; cursor: pointer; 
        border-radius: 0.25rem; background-color: lightgray; }
    .modal_container .modal_close_btn_signup:hover { background-color: darkgray; }     

    /* 상단 닉네임 및 평점 부분 */
    .modal_container .modal_content_header{height: 50px; width:95%; position:relative;}

    /* 프로필 이미지 */
    .modal_container .small_img_box{ width: 45px; height: 45px; border-radius: 50%; overflow: hidden; display:inline-block;}
    .modal_container .small_img_box img{width: 100%; height: 100%; object-fit: cover;}
    
    /* 회원가입 폼 */
    .modal_content form{width:100%;text-align:center; margin-top:20px; margin-bottom:20px}  
    .modal_content form table{width:100%;}
    .modal_content form table tr:nth-child(odd){height:50px}
    .modal_content form table tr:nth-child(odd) td{width:100%; line-height:50px; text-align:center;}
    .modal_content form table tr:nth-child(even){display:none; width:100%;height:20px;text-align:center;}
    .modal_content form table tr:nth-child(even) td{width:100%; line-height:20px; text-align:center;}
    .modal_content form table p{width:100%;height:15px; line-height:20px; text-align:center;}
    .modal_content form table td input[type=text],[type=password],[type=tel],[type=date]{width:300px;height:50px; font-size:15px;text-align:center;}
    .modal_content form table td input{height:50px;}
    /* 생년월일 input */
    .modal_content form table tr:nth-child(11) td{position:relative;}
    .modal_content form table tr:nth-child(11) label{position:absolute; top: 50%;  left: 50%;  transform: translate(-50%, -50%); color:gray;}
    .modal_content form table tr:nth-child(11) input:focus ~ label,
    .modal_content form table tr:nth-child(11) input:valid ~ label {display:none;}
    .modal_content form table tr:nth-child(11) input[type=date]{text-align:left;}
    /* gender */
    .modal_content form table tr:nth-child(15) label{text-align:center; line-height:50px; font-size:20px}
    .modal_content form table tr:nth-child(15) input{text-align:center; line-height:50px; font-size:20px}
    /* user_img */
    .modal_content form table tr:nth-child(17) img{width: 45px; height: 45px; margin-left:5px; margin-right:5px}
    /* 회원가입 버튼 */
    .modal_content form input[type=button]{width:90%; height: 40px; background-color:#679b9b; border-style:none;
        border-radius: 0.5rem;font-size:20px;font-weight: bold}
        /* 하단 버튼 */
    .modal_content button{width:40%; height:40px; font-size:15px;margin:10px }
</style>

<!-- ****************** -->
<!-- php -->
<!-- ****************** -->

<!-- 팝업 될 레이어 --> 
<div class="modal_container" name="modal_container"> 
    <div class="modal_content"> 
        <!-- 닫기 버튼 -->
        <span class="modal_close_btn_signup">&times;</span>
        <!-- 상단 로고 -->
        <div class="modal_content_header">
            <!-- 로고 -->
            <!-- <div class="small_img_box">
                <img src="./img/profile_image< ?=$i?>.png" alt="프로필 이미지">
            </div>  -->
        </div>
        <hr width="99%" color="#e2e2e2" noshade/>
        
        <!-- 회원가입 폼 -->
        <form action="http://<?= $_SERVER['HTTP_HOST'] ?>/wootcha/user/user_signup.php" id="signup_form" name="signup_form" method="post">
        <table>
            <!-- 아이디(이메일) -->
            <tr><td>
                    <input type="text" id="signup_email" name="signup_email" placeholder="이메일(ID로 사용)" onblur="checkEmail()">
            </td></tr>
            <tr id="hidden_bar_email"><td><p id="signup_email_ck"></p></td></tr>

            <!-- 비밀번호 -->
            <tr><td>
                    <input type="password" id="signup_password" name="signup_password" placeholder="비밀번호" onblur="checkPass()">
            </td></tr>
            <tr id="hidden_bar_password"><td><p id="signup_password_ck"></p></td></tr>
            
            <!-- 비밀번호  확인-->
            <tr><td>
                    <input type="password" id="signup_password_re" name="signup_password_re" placeholder="비밀번호 확인" onblur="checkPass_re()">
            </td></tr>
            <tr id="hidden_bar_password_re"><td><p id="signup_password_re_ck"></p></td></tr>
            
            <!-- 이름 -->
            <tr><td>
                    <input type="text" id="signup_name" name="signup_name" placeholder="이름" onblur="checkName()">
            </td></tr>
            <tr id="hidden_bar_name"><td><p id="signup_name_ck"></p></td></tr>
            
            <!-- 닉네임 -->
            <tr><td>
                    <input type="text" id="signup_nickname" name="signup_nickname" placeholder="닉네임" onblur="checkNickName()">
            </td></tr>
            <tr id="hidden_bar_nickname"><td><p id="signup_nickname_ck"></p></td></tr>
            
            <!-- 생년월일 -->
            <tr><td>
                    <input type="date" id="signup_birth_day" name="signup_birth_day" required aria-required="true">
                    <label for="date_input">생년월일</label>
            </td></tr>
            <tr><td><p id="signup_birth_day_ck"></p></td></tr>
            
            <!-- 전화번호 -->
            <tr><td>
                    <input type="tel" id="signup_phone" name="signup_phone" placeholder="휴대전화 ex) 010-1234-5678 " onblur="checkPhone()">
            </td></tr>
            <tr id="hidden_bar_phone"><td><p id="signup_phone_ck"></p></td></tr>

            <!-- 성별 -->
            <tr><td>
                    <input type="radio" id="radio_male" name="gender" value="0" checked>
                    <label for="radio_male">male</label>
                    <input type="radio" id="radio_female" name="gender" value="1">
                    <label for="radio_female">female</label>
            </td></tr>
            <tr><td><p></p></td></tr>

            <!-- 아바타 -->
            <tr><td>
                    <input type="radio" id="avatar_1" name="avatar" value="user_robot_avatar0.png" checked>
                    <label for="avatar_1"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/user/img/user_robot_avatar0.png" alt=""></label>
                    <input type="radio" id="avatar_2" name="avatar" value="user_robot_avatar1.png">
                    <label for="avatar_2"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/user/img/user_robot_avatar1.png" alt=""></label>
                    <input type="radio" id="avatar_3" name="avatar" value="user_robot_avatar2.png">
                    <label for="avatar_3"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/user/img/user_robot_avatar2.png" alt=""></label>
                    <input type="radio" id="avatar_4" name="avatar" value="user_robot_avatar3.png">
                    <label for="avatar_4"><img src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/user/img/user_robot_avatar3.png" alt=""></label>
            </td></tr>
        </table>
        <input type="button" value="회원가입" onclick="allCheck()">
        </form>
        <hr width="99%" color="#e2e2e2" noshade/><!-- 구분선 -->
        <!-- kakaoConn()는 mypage_index에 있음  -->
        <div id="kakao_login_button" onclick="kakaoConn();"><img src="/wootcha/user/img/kakao_login_button.png" alt="kakao_login_button"></div>
    </div>
</div>

<!-- ****************** -->
<!-- javascript -->
<!-- ****************** -->

<!-- 카카오 api -->
<script src = "https://developers.kakao.com/sdk/js/kakao.js" > </script>
<script src="/wootcha/user/js/kakao_login.js"></script>


<script type = "text/javascript" >
// Modal을 가져옵니다.
var modal_container = document.getElementsByClassName("modal_container");
// Modal을 띄우는 클래스 이름을 가져옵니다.
var trigger_user_signup = document.getElementsByClassName(
    "trigger_user_signup"
);
// Modal을 닫는 close 클래스를 가져옵니다.
var modal_close_btn_signup = document.getElementsByClassName(
    "modal_close_btn_signup"
);
// 이메일
signup_email = document.getElementById('signup_email');
signup_email_ck = document.getElementById('signup_email_ck');
hidden_bar_email = document.getElementById('hidden_bar_email');
// 비밀번호
signup_password = document.getElementById('signup_password');
signup_password_ck = document.getElementById('signup_password_ck');
hidden_bar_password = document.getElementById('hidden_bar_password');
// 비밀번호 확인
signup_password_re = document.getElementById('signup_password_re');
signup_password_re_ck = document.getElementById('signup_password_re_ck');
hidden_bar_password_re = document.getElementById('hidden_bar_password_re');
// 이름
signup_name = document.getElementById('signup_name');
signup_name_ck = document.getElementById('signup_name_ck');
hidden_bar_name = document.getElementById('hidden_bar_name');
// 닉네임
signup_nickname = document.getElementById('signup_nickname');
signup_nickname_ck = document.getElementById('signup_nickname_ck');
hidden_bar_nickname = document.getElementById('hidden_bar_nickname');
// 생년월일
signup_birth_day = document.getElementById('signup_birth_day');
signup_birth_day_ck = document.getElementById('signup_birth_day_ck');
// 전화번호
signup_phone = document.getElementById('signup_phone');
signup_phone_ck = document.getElementById('signup_phone_ck');
hidden_bar_phone = document.getElementById('hidden_bar_phone');


// Modal을 띄우고 닫는 클릭 이벤트를 정의한 함수 해당 클래스의 내용을 클릭하면 Modal을 띄움
trigger_user_signup[0].onclick = function () {
    modal_container[0].style.visibility = "visible";
};

// <span> 태그(X 버튼)를 클릭하면 Modal이 닫습니다.
modal_close_btn_signup[0].onclick = function () {
    signup_email.value = "";
    signup_password.value = "";
    signup_password_re.value = "";
    signup_name.value = "";
    signup_nickname.value = "";
    signup_birth_day.value = "";
    signup_phone.value = "";
    hidden_bar_email.style.display = 'none';
    hidden_bar_password.style.display = 'none';
    hidden_bar_password_re.style.display = 'none';
    hidden_bar_name.style.display = 'none';
    hidden_bar_nickname.style.display = 'none';
    hidden_bar_phone.style.display = 'none';
    
    modal_container[0].style.visibility = "hidden";
};



function checkEmail() {
    var email = signup_email.value;
    var emailReg = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/;

    if (!emailReg.test(email)) {
        var text = " &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 올바른 E-mail주소 형식으" +
                "로 입력하세요. &nbsp&nbsp&nbsp ";
        notifyText_back(signup_email_ck, text, hidden_bar_email);
        return false;
    } else {

        // 패턴 맞으면 중복확인 ajax 사용함
        var httpRequest = new XMLHttpRequest();
        var data = "";
        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState == XMLHttpRequest.DONE && httpRequest.status == 200) {
                if (httpRequest.responseText != "") {
                    notifyText_back(signup_email_ck, httpRequest.responseText, hidden_bar_email);
                } else {
                    notifyText_ok(hidden_bar_email);
                }
            }
        };

        data = "mode=email&value=" + email;
        httpRequest.open("POST", "./user/user_signup_check.php", true);
        httpRequest.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded"
        );
        httpRequest.send(data);
        return true;
    }
}

function checkPass() {
    var pass = signup_password.value;
    var passReg = /^.*(?=^.{4,12}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@$%^&*]).*$/;
    if (!passReg.test(pass)) {
        var text = "&nbsp&nbsp 4~12자리의 영문,숫자,특수문자(!, @, $, %, ^,&,*)로 구성 &nbsp&nbsp&nbsp";
        notifyText_back(signup_password_ck, text, hidden_bar_password);
        return false;
    } else {
        notifyText_ok(hidden_bar_password);
        return true;
    }
}

function checkPass_re() {
    var pass = signup_password.value;
    var pass2 = signup_password_re.value;
    if (pass !== pass2) {
        var text = "&nbsp&nbsp 비밀번호가 일치하지 않습니다. 상위 비밀번호와 일치 요망 &nbsp&nbsp&nbsp";
        notifyText_back(signup_password_re_ck, text, hidden_bar_password_re);
        return false;
    } else {
        notifyText_ok(hidden_bar_password_re);
        return true;
    }

}

function checkName() {
    var name = signup_name.value;
    var nameReg = /^[가-힣a-zA-Z]+$/;
    if (!nameReg.test(name)) {
        var text = " &nbsp&nbsp 올바른 성명을 입력하세요. 특수문자 및 숫자는 입력 불가";
        notifyText_back(signup_name_ck, text, hidden_bar_name);
        return false;
    } else {
        notifyText_ok(hidden_bar_name);
        return true;
    }
}

function checkNickName() {
    var name = signup_nickname.value;
    var nameReg = /^[\w\Wㄱ-ㅎㅏ-ㅣ가-힣]{2,10}$/;
    if (!nameReg.test(name)) {
        var text = "&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp 2~10자리, 한글, 영문, 숫자 사용 가능합" +
                "니다. &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
        notifyText_back(signup_nickname_ck, text, hidden_bar_nickname);
        return false;
    } else {
        // 패턴 맞으면 중복확인 ajax 사용함
        var httpRequest = new XMLHttpRequest();
        var data = "";
        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState == XMLHttpRequest.DONE && httpRequest.status == 200) {
                if (httpRequest.responseText != "") {
                    notifyText_back(
                        signup_nickname_ck,
                        httpRequest.responseText,
                        hidden_bar_nickname
                    );
                } else {
                    notifyText_ok(hidden_bar_nickname);
                }
            }
        };

        data = "mode=nickname&value=" + name;
        httpRequest.open("POST", "./user/user_signup_check.php", true);
        httpRequest.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded"
        );
        httpRequest.send(data);
        return true;
    }
}

function checkPhone() {
    var name = signup_phone.value;
    var nameReg = /^\d{3}-\d{3,4}-\d{4}$/;
    if (!nameReg.test(name)) {
        var text = "휴대전화 번호를 확인해주세요. 형식이 올바르지 않습니다.";
        notifyText_back(signup_phone_ck, text, hidden_bar_phone);
        return false;
    } else {
        notifyText_ok(hidden_bar_phone);
        return true;
    }
}

// 정규식 맞지 않을 때 사용하는 함수
function notifyText_back(id, text, hidden_bar) {
    hidden_bar.style.display = 'inline-block';
    id.innerHTML = text;
    id.style.color = 'red';
}

// 정규식 맞을 때 사용!
function notifyText_ok(hidden_bar) {
    hidden_bar.style.display = 'none';
}

// 폼 보낼 때 모두 체크
function allCheck() {
    if (!checkEmail()) 
        return;
    if (!checkPass()) 
        return;
    if (!checkPass_re()) 
        return;
    if (!checkName()) 
        return;
    if (!checkNickName()) 
        return;
    if (!checkPhone()) 
        return;
    document
        .signup_form
        .submit();
}
</script>
