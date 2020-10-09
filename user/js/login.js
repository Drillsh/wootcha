function check_input_login()
{
    if (!document.login_form.login_email.value)
    {
        alert("아이디를 입력하세요");    
        document.login_form.login_email.focus();
        return;
    }

    if (!document.login_form.login_password.value)
    {
        alert("비밀번호를 입력하세요");    
        document.login_form.login_password.focus();
        return;
    }
    document.login_form.submit();
}