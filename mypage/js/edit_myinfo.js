window.onload = function(){
    // 모달창 및 버튼 객체 가져옴
    var modal = document.querySelector(".modal"); 
    var trigger = document.querySelector(".trigger"); 
    var closeButton = document.querySelector(".close-button"); 
    var cancelButton = document.querySelector("#cancel");


    // 모달화면을 가렸다가 나타냈다가 하는 함수 
    function toggleModal() { 
         modal.classList.toggle("show-modal"); 
     }

    // 화면에서 이벤트가 발생했을 때 이벤트의 대상이 modal 이라면 toggleModal() 실행
    function windowOnClick(event) { 
         if (event.target === modal) { 
             toggleModal(); 
         } 
     }
    // 버튼들에 togglemodal 함수 리스너 설정
    trigger.addEventListener("click", toggleModal); 
    closeButton.addEventListener("click", toggleModal); 
    cancelButton.addEventListener("click", toggleModal); 

    // 윈도우 화면이 켜졌을 때,  windowOnClick() 함수 리스너 설정
    window.addEventListener("click", windowOnClick); 
}