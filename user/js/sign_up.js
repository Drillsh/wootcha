window.onload = function () {
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

}


function checkEmail() {
    // var emailArray = <?php ?>
    var email = signup_email.value;
    var emailReg = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/;
    if (!emailReg.test(email)) {
        var text = "올바른 E-mail주소를 입력하세요.";
        notifyText_back(signup_email_ck, text, hidden_bar_email);
        return false;
    } else {
        notifyText_ok(hidden_bar_email);
        return true;
    }
}

function checkPass() {
    var pass = signup_password.value;
    var passReg = /^.*(?=^.{4,12}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@$%^&*]).*$/;
    if (!passReg.test(pass)) {
        var text = "4~12자리의 영문,숫자,특수문자(!, @, $, %, ^,&,*)로 구성해야합니다.";
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
            var text = "비밀번호가 일치하지 않습니다.";
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
        var text = "올바른 성명을 입력하세요.";
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
        var text = "2~10자리, 특수문자 제외";
        notifyText_back(signup_nickname_ck, text, hidden_bar_nickname);
        return false;
    } else {
        notifyText_ok(hidden_bar_nickname);
        return true;
    }
}

function checkPhone() {
    var name = signup_phone.value;
    var nameReg = /^\d{3}-\d{3,4}-\d{4}$/;
    if (!nameReg.test(name)) {
        var text = "휴대전화가 올바르지 않습니다.";
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
    if (!checkEmail()) return;
    if (!checkPass()) return;
    if (!checkPass_re()) return;
    if (!checkName()) return;
    if (!checkNickName()) return;
    if (!checkPhone()) return;
    
    document.signup_form.submit();
}


    



