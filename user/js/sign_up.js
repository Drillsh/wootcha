function check(item) {
    switch (item) {
        case 'id':
            //글자 길이 체크
            var id = document.getElementById(item);
            var idValue = id.value;
            var textIDinfomation = document.getElementById('textIDinfomation');
            pattern = /^[a-z]+[a-z0-9]{4,12}$/g;
            if (idValue.length < 4 || idValue.length > 12) {
                notifyText(textIDinfomation, "길이를 확인해주세요", "red");
            } else {
                if (!pattern.test(idValue)) {
                    notifyText(textIDinfomation, "영문자와 숫자 조합,  첫글자는 영문자", "red");
                } else {
                    notifyText(textIDinfomation, "사용가능합니다.", "green");
                }
            }
            break;

        case 'pass':
            //글자 길이 체크
            var pass = document.getElementById(item);
            var passValue = pass.value;
            var textPasswordInfomation = document.getElementById('textPasswordInfomation');
            pattern = /^.*(?=^.{4,12}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/
            if (passValue.length < 4 || passValue.length > 12) {
                notifyText(textPasswordInfomation, "길이를 확인해주세요", "red");
            } else {
                if (!pattern.test(passValue)) {
                    notifyText(textPasswordInfomation, "4~12자리의 영문,숫자,특수문자(!, @, $, %, ^,&,*)만 가능", "red");
                } else {
                    notifyText(textPasswordInfomation, "사용가능합니다.", "green");
                }
            }
            break;

        case 'name':
            //글자 길이 체크
            var name = document.getElementById(item);
            var nameValue = name.value;
            var textNameInfomation = document.getElementById('textNameInfomation');
            pattern = /^[가-힣]{2,4}|[a-zA-Z]{2,30}\s[a-zA-Z]{2,30}$/;
            if (nameValue.length < 2 || nameValue.length > 30) {
                notifyText(textNameInfomation, "길이를 확인해주세요", "red");
            } else {
                if (!pattern.test(nameValue)) {
                    notifyText(textNameInfomation, "띄어쓰기 없이 입력, 반드시 실명이어야 합니다!", "red");
                } else {
                    notifyText(textNameInfomation, "사용가능합니다.", "green");
                }
            }
            break;

        case 'signup_email':
            //글자 길이 체크
            var email = document.getElementById(item);
            var emailValue = email.value;
            var signup_email_ck = document.getElementById('signup_email_ck');
            pattern = /^([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/
            if (!pattern.test(emailValue)) {
                notifyText(signup_email_ck, "이메일 양식이 알맞지 않습니다.", "red");
            } else {
                notifyText(signup_email_ck, "사용가능합니다.", "green");
            }
            break;
        default:
            break;
    }


    function notifyText(id, text, color) {
        id.innerHTML = text;
        id.style.color = color;
        id.style.display = block;
    }




}




// function checkID() {
//     reg = /\W/;           // \W는영문자와숫자가아닌경우를나타내는정규식
//     if (textID.value.search(reg) >= 0) {
//         alert("ID는영문자와숫자만사용할수있습니다.")
//     } else if (textID.value == "") {
//         alert("ID를 입력 해주세요");
//     } else {
//         alert(textID.value + "은(는) 사용할수있는 ID입니다");
//     }
// }