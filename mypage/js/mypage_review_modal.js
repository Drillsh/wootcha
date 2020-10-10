window.onload = function(){
     // Modal을 가져옵니다.
     var modal_container_review = document.getElementsByClassName("modal_container_review");
     // Modal을 띄우는 클래스 이름을 가져옵니다.
     var review_dialog_trigger = document.getElementsByClassName("review_dialog_trigger");
     // Modal을 닫는 close 클래스를 가져옵니다.
     var modal_close_btn_review = document.getElementsByClassName("modal_close_btn_review");
     // 댓글창을 가져온다.
     var comments_container = document.getElementsByClassName("comments_container");
     // 좋아요 버튼 가져온다
     var like_ckeckbox_class = document.getElementsByClassName("like_ckeckbox_class");
     // 좋아요 form 태그를 가져온다
     var review_like_form = document.getElementsByClassName("review_like_form");
     var funcs = [];

     // Modal을 띄우고 닫는 클릭 이벤트를 정의한 함수
     function Modal(num) {
       return function() {
         // 해당 클래스의 내용을 클릭하면 Modal을 띄움
         review_dialog_trigger[num].onclick =  function() {
          modal_container_review[num].style.visibility = "visible";
         };
     
         // <span> 태그(X 버튼)를 클릭하면 Modal이 닫습니다.
         modal_close_btn_review[num].onclick = function() {
          modal_container_review[num].style.visibility = "hidden";
         };

        //  댓글 icon 클릭시 댓글 리스트 창 노출
        var checkbox = document.getElementById("checkbox" + num);
        checkbox.onclick = function () {
          if(checkbox.checked == true){
            comments_container[num].style.display = "inline-block";
          }else{
            comments_container[num].style.display = "none";
          }
        };

        // 좋아요 icon 클릭 시 폼 전송 및 icon 변경
        var like_checkbox = document.getElementById("like_checkbox" + num);
        like_checkbox.onclick = function () {
          // icon 변경 함수
          if(like_checkbox.checked == true){
            like_ckeckbox_class[num].src = "./img/like_color.png";
          }else{
            like_ckeckbox_class[num].src = "./img/like.png";
          }
          review_like_form[num].submit();
        };
       };
     }

     // 원하는 Modal 수만큼 Modal 함수를 호출해서 funcs 함수에 정의합니다.
     for(var i = 0; i < review_dialog_trigger.length; i++) {
       funcs[i] = Modal(i);
     }

     // 원하는 Modal 수만큼 funcs 함수를 호출합니다.초기화 하는 역할
     for(var j = 0; j < review_dialog_trigger.length; j++) {
       funcs[j]();
     }

}