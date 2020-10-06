function check_input() {
    if (!document.board_form.faq_title.value)
    {
        alert("제목을 입력하세요!");
        document.board_form.faq_title.focus();
        return;
    }
    if (!document.board_form.faq_contents.value)
    {
        alert("내용을 입력하세요!");    
        document.board_form.faq_contents.focus();
        return;
    }
    document.board_form.submit();
 }