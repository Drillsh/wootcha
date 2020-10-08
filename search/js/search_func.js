//정렬 함수
function selectOption(search, country, genre) {
    // 정렬 옵션 가져오기
    let option = $("#follow_list_select_mode option:selected").val();
    location.href = "/wootcha/search/search_index.php?search_keyword="+search+"&country="+country+"&genre="+genre+"&selected_option=" + option;
}

