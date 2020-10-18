var formsForUpdate = new Array();
var url;

$(function(){


    $('.date_field').datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: -0,
        maxDate: "+1Y",
        beforeShow: function() {
            setTimeout(function(){
                $('.ui-datepicker').css('z-index', 99999999999999);
            }, 0);
        }
    });

});



function submitDelete(){

    var conf = confirm('공지사항 데이터를 삭제하시겠습니까?');

    if(conf){
        var formsForUpdate = new Array();

        $("input:checkbox[name='no[]']").each(function() {
            if($(this).is(":checked") == true) {//체크되어있으면
                formsForUpdate.push($(this).closest("form")); //해당 폼 객체를 배열에 저장
            }
        });
        var serialize ='';
    
        for(var i in formsForUpdate){
            serialize += formsForUpdate[i].serialize() + "&";
        }

        serialize = serialize.slice(0,-1);
        console.log(serialize);
        $.ajax({
            type: "post",
            data: serialize,
            url : "lib/notice_members_delete.php",
            success : function(data){
                if(data==1){
                    location.href='/wootcha/admin/admin_notice.php';
                }else{
                    alert('오류발생: '+data);
                }
            },
            error : function(){
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