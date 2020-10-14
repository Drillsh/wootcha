var formsForUpdate = new Array();
var url;

$(function () {

    url = "/wootcha/admin/admin_reply.php?y=" + y + "&m=" + m;

    listItemPicker();
});


function listItemPicker() {
    $('.list_row').click(function () {

        //다중 클릭시 폼배열에 중복으로 쌓이는 것 방지
        if ($(this).css('background-color') == 'rgb(142, 196, 240)') {
            return;
        }
        $(this).css('background-color', '#8ec4f0a9');
        formsForUpdate.push($(this).children('form'));
    });
}

function submitDelete() {

    var conf = confirm('선택한 리뷰 데이터를 삭제하시겠습니까?');

    if (conf) {
        var serialize = '';

        for (var i in formsForUpdate) {
            serialize += formsForUpdate[i].serialize() + "&";
        }

        serialize = serialize.slice(0, -1);
        console.log(serialize);
        $.ajax({
            type: "post",
            data: serialize,
            url: "lib/reply_delete.php",
            success: function (data) {
                if (data == 1) {
                    location.href = url + '&page=' + page;
                } else {
                    alert('오류발생: ' + data);
                }
            },
            error: function () {
                alert("시스템에러");
            }
        });
    }
}

function onclickSearch() {

    var col = $('#search_select option:selected').val();
    var search = $('.form-control').val();

    if (col == "영화 제목") {
        col = "mv_title";
    } else if (col == "글쓴이") {
        col = "user_nickname";
    } else if (col == "댓글 내용") {
        col = "review_reply_contents";
    } else if (col == "댓글 위치") {
        col = "review_num";
    } else if (col == "등록일") {
        col = "review_reply_regtime";
    }

    if (!search) {
        alert('검색어를 입력해주세요');
    } else {
        location.replace(url + "&col=" + col + "&search=" + search);
    }
}





