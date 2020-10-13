// Modal을 가져옵니다.
var modal_container_find_account = document.getElementsByClassName("modal_container_find_account");
// Modal을 띄우는 클래스 이름을 가져옵니다.
var trigger_user_find_account = document.getElementsByClassName("trigger_user_find_account");

var funcs = [];

// Modal을 띄우고 닫는 클릭 이벤트를 정의한 함수
function Modal(num) {
  return function() {
    // 해당 클래스의 내용을 클릭하면 Modal을 띄움
    trigger_user_find_account[num].onclick =  function() {
        modal_container_find_account[num].style.visibility = "visible";
    };
  };
}

// 원하는 Modal 수만큼 Modal 함수를 호출해서 funcs 함수에 정의합니다.
for(var i = 0; i < trigger_user_find_account.length; i++) {
  funcs[i] = Modal(i);
}

// 원하는 Modal 수만큼 funcs 함수를 호출합니다.초기화 하는 역할
for(var j = 0; j < trigger_user_find_account.length; j++) {
  funcs[j]();
}