window.onload = function(){
     // Modal을 가져옵니다.
     var modal_container = document.getElementsByClassName("modal_container");
     // Modal을 띄우는 클래스 이름을 가져옵니다.
     var review_dialog_trigger = document.getElementsByClassName("review_dialog_trigger");
     // Modal을 닫는 close 클래스를 가져옵니다.
     var modal_close_btn = document.getElementsByClassName("modal_close_btn");
     var funcs = [];

     // Modal을 띄우고 닫는 클릭 이벤트를 정의한 함수
     function Modal(num) {
       return function() {
         // 해당 클래스의 내용을 클릭하면 Modal을 띄움
         review_dialog_trigger[num].onclick =  function() {
             modal_container[num].style.visibility = "visible";
             console.log(num);
         };
     
         // <span> 태그(X 버튼)를 클릭하면 Modal이 닫습니다.
         modal_close_btn[num].onclick = function() {
             modal_container[num].style.visibility = "hidden";
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