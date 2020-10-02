<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wootcha</title>
        <style> 
     body{  
         /* display: block;  */
         /* margin: 0 auto;  */
         /* font-size: 16px;  */
         /* color: #999;  */
     } 
     .modal h1{ 
         font-family: 'Oswald', sans-serif; 
         font-size: 30px; 
         color: #216182; 
     } 

     .modal label { 
         display: block; 
         margin-top: 20px; 
         letter-spacing: 2px; 
     } 
     .modal form { 
         margin: 0 auto; 
         width: 459px; 
     } 
     .modal input, textarea { 
         width: 439px; 
         height: 27px; 
         background-color: #efefef; 
         border-radius: 6px; 
         border: 1px solid #dedede; 
         padding: 10px; 
         margin-top: 3px; 
         font-size: 0.9em; 
         color: #3a3a3a; 
     } 
         input:focus, textarea:focus{ 
             border: 1px solid #97d6eb; 
         } 
     
         .modal textarea{ 
         height: 60px; 
         background-color: #efefef; 
     } 
     .modal #submit{ 
         width: 127px; 
         height: 48px; 
         text-align: center; 
         border: none; 
         margin-top: 20px; 
         cursor: pointer; 
     } 
     .modal #submit:hover{ 
         color: #fff; 
         background-color: #216282; 
         opacity: 0.9; 
     } 
     .modal #cancel { 
         width: 127px; height: 48px; 
         text-align: center; 
         border: none; 
         margin-top: 20px; 
         cursor: pointer; 
     } 
     .modal #cancel:hover{ 
         color: #fff; 
         background-color: #216282; 
         opacity: 0.9; 
     }

    .modal { 
         position: fixed; 
         left: 0; 
         top: 0; 
         width: 100%; 
         height: 100%; 
         background-color: rgba(0, 0, 0, 0.5); 
         opacity: 0; 
         visibility: hidden; 
         transform: scale(1.1); 
         transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s; 
     } 
     .modal-content { 
         position: absolute; 
         top: 50%; 
         left: 50%; 
         transform: translate(-50%, -50%); 
         background-color: white; 
         padding: 1rem 1.5rem; 
         width: 500px; 
         height: 350px; 
         border-radius: 0.5rem; 
     } 
     .modal .close-button { 
         float: right; 
         width: 1.5rem; 
         line-height: 1.5rem; 
         text-align: center; 
         cursor: pointer; 
         border-radius: 0.25rem; 
         background-color: lightgray; 
     } 
     .modal .close-button:hover { 
         background-color: darkgray; 
     } 
     .show-modal { 
         opacity: 1; 
         visibility: visible; 
         transform: scale(1.0); 
         transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s; 
     } 
    
</style>

        
    </head>
    <body>

    <button class="trigger">버튼!!!!</button>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h1>asdfasdfas</h1>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h1>asdfasdfas</h1>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h1>asdfasdfas</h1>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h1>asdfasdfas</h1>
            <!-- ************** -->
            <!-- 모달 수정 창 -->
            <!-- ************** -->
            <div class="modal"> 
                <div class="modal-content"> 
                    <span class="close-button">&times;</span> 
                        <h1 class="title">메일 보내기</h1> 
                        <form action="#post.php" method="POST"> 
                            <label for="email">Email</label> 
                            <input type="email" name="email" placeholder="Your email" required="required"> 
                            <label></label> 
                            <textarea name="message" placeholder="Test Message" required="required"></textarea> 
                            <input type="button" id="cancel" value="취소"> 
                            <input type="submit" id="submit" value="보내기"> 
                        </form>
                </div> 
            </div>








            <script>
        // 모달창 및 버튼 객체 가져옴
        var modal = document.querySelector(".modal"); 
        var trigger = document.querySelector(".trigger"); 
        var closeButton = document.querySelector(".close-button"); 
        var cancelButton = document.querySelector("#cancel");

        //console.log(modal);

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
        cancel.addEventListener("click", toggleModal); 

        // 윈도우 화면이 켜졌을 때,  windowOnClick() 함수 리스너 설정
        window.addEventListener("click", windowOnClick); 




        </script>
    </body>
</html>