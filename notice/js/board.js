function check_input_notice() {
    if (!document.board_form.notice_title.value)
    {
        alert("제목을 입력하세요!");
        document.board_form.notice_title.focus();
        return;
    }
    if (!document.board_form.notice_contents.value)
    {
        alert("내용을 입력하세요!");    
        document.board_form.notice_contents.focus();
        return;
    }
    document.board_form.submit();
 }