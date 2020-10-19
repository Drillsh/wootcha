var formsForUpdate = new Array();
var url;

$(function(){
  
    url = "/wootcha/admin/admin_notice.php?";
    


});

function submitDelete(){

    var conf = confirm('선택한 공지사항 데이터를 삭제하시겠습니까?');

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
            url : "lib/story_delete.php",
            success : function(data){
                if(data==1){
                    location.href='/wootcha/admin/admin_notice.php?';
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

function onclickSearch(){


    var col = $('#search_select option:selected').val();
    var search = $('.form-control').val();

    if(col=="회원번호"){
        col="user_num";
    }else if(col=="이름"){
        col="user_name";
    }else if(col=="닉네임"){
        col="user_nickname";
    }else if(col=="이메일"){
        col="user_mail";
    }else if(col=="연락처"){
        col="user_phone";
    }else if(col=="생년월일"){
        col="user_age";
    }else if(col=="가입일"){
        col="user_signup_day";
    }

    if(!search){
        alert('검색어를 입력해주세요');
    }else{
        location.replace(url+"&search="+search);
    }
}


