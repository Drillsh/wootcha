window.onload = function(){
    // 모달창 및 버튼 객체 가져옴
    var modal = document.querySelector(".modal"); 
    var modal_phone = document.querySelector(".modal_phone"); 
    var modal_password = document.querySelector(".modal_password"); 
    var trigger = document.querySelector(".trigger"); 
    var trigger_phone = document.querySelector(".trigger_phone"); 
    var trigger_password = document.querySelector(".trigger_password"); 
    var closeButton = document.querySelector(".close-button"); 
    var cancelButton = document.querySelector("#cancel");


    // 모달화면을 가렸다가 나타냈다가 하는 함수 
    function toggleModal() { 
         modal.classList.toggle("show-modal"); 
     }
    function toggleModal_phone() { 
        modal_phone.classList.toggle("show-modal"); 
     }
    function toggleModal_password() { 
        modal_password.classList.toggle("show-modal"); 
     }

    // 화면에서 이벤트가 발생했을 때 이벤트의 대상이 modal 이라면 toggleModal() 실행
    function windowOnClick(event) { 
         if (event.target === modal) { 
             toggleModal(); 
         }else if(event.target === modal_phone){
            toggleModal_phone(); 
         }else if(event.target === modal_password){
            toggleModal_password(); 
         }
     }

    // 버튼들에 togglemodal 함수 리스너 설정
    trigger.addEventListener("click", toggleModal); 
    trigger_phone.addEventListener("click", toggleModal_phone); 
    trigger_password.addEventListener("click", toggleModal_password); 
    closeButton.addEventListener("click", toggleModal); 
    cancelButton.addEventListener("click", toggleModal); 

    // 윈도우 화면이 켜졌을 때,  windowOnClick() 함수 리스너 설정
    window.addEventListener("click", windowOnClick); 
}