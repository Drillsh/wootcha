<button class="trigger">영화 코멘트 클릭했을 때 화면</button>

<style type="text/css"> 
     .modal_container .small_img_box{ width: 50px; height: 50px; margin: 0px auto; border-radius: 50%; overflow: hidden;}
     .modal_container .small_img_box img{width: 100%; height: 100%; object-fit: cover;}

     .modal_container h3{ 
         font-family: 'Oswald', sans-serif; 
         font-size: 20px; 
         color: #216182; 
     } 
     .modal_container label { 
         display: block; 
         margin-top: 20px; 
         letter-spacing: 2px; 
     } 
     .modal_container form { 
         margin: 0 auto; 
         width: 459px; 
     } 
     .modal_container input, .modal_container textarea { 
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
     .modal_container input:focus, .modal_container textarea:focus{ 
             border: 1px solid #97d6eb; 
         } 
     
    .modal_container textarea{ 
         height: 60px; 
         background-color: #efefef; 
     } 
     .modal_container #submit{ 
         width: 127px; 
         height: 48px; 
         text-align: center; 
         border: none; 
         margin-top: 20px; 
         cursor: pointer; 
     } 
     .modal_container #submit:hover{ 
         color: #fff; 
         background-color: #216282; 
         opacity: 0.9; 
     } 
     .modal_container #cancel { 
         width: 127px; height: 48px; 
         text-align: center; 
         border: none; 
         margin-top: 20px; 
         cursor: pointer; 
     } 
     .modal_container #cancel:hover{ 
         color: #fff; 
         background-color: #216282; 
         opacity: 0.9; 
     }

      .modal_container { 
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
     .modal_container .modal_content { 
         position: absolute; 
         top: 50%; 
         left: 50%; 
         transform: translate(-50%, -50%); 
         background-color: white; 
         padding: 1rem 1.5rem; 
         width: 500px; 
         height: 700px; 
         border-radius: 0.5rem; 
     } 
     .modal_container .modal_close_btn { 
         float: right; 
         width: 1.5rem; 
         line-height: 1.5rem; 
         text-align: center; 
         cursor: pointer; 
         border-radius: 0.25rem; 
         background-color: lightgray; 
     } 
     .modal_container .modal_close_btn:hover { 
         background-color: darkgray; 
     } 
     .show-modal { 
         opacity: 1; 
         visibility: visible; 
         transform: scale(1.0); 
         transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s; 
     }
     .modal_container #like, .modal_container #review{float:left; background-color:yellow; width:100px; height:40px;} 
</style>


<!-- 팝업 될 레이어 --> 
<div class="modal_container"> 
         <div class="modal_content"> 
             <span class="modal_close_btn">&times;</span>
             <div class="small_img_box">
                <img src="./img/profile_image.png" alt="프로필 이미지">
            </div> 
             <h3 class="title">영화제목</h3> 

             <form action="#" method="POST"> 
               <label for="line_review">한줄평</label> 
               <input type="text" name="line_review" placeholder="a line review"> 
               <label for="long_review">장문평</label> 
               <textarea name="long_review" placeholder="Test Message"></textarea> 
               <label></label> 
               <input type="button" id="like" value="좋아요"> 
               <input type="button" id="review" value="댓글"> 
               <br>
               <div>-</div>
               <br>
               <div>평점</div>
                <br>
                <div>-------</div>
                <br>
                <div class="comments_container">
                    <ul>
                        <li>
                            닉네임 | 등록일자<br>
                            이 영화 별로 재미 없었음.....장난?
                        </li>
                        <li>
                            닉네임 | 등록일자<br>
                            이 영화 별로 재미 없었음.....장난?
                        </li>
                        <li>
                            닉네임 | 등록일자<br>
                            이 영화 별로 재미 없었음.....장난?
                        </li>
                        <li>
                            닉네임 | 등록일자<br>
                            이 영화 별로 재미 없었음.....장난?
                        </li>
                        <li>
                            닉네임 | 등록일자<br>
                            이 영화 별로 재미 없었음.....장난?
                        </li>
                    </ul>
                </div>
               <input type="button" id="cancel" value="나가기"> 
               <input type="submit" id="submit" value="보내기"> 
             </form> 
         </div> 
     </div>

    <script type="text/javascript"> 
         var modal_container = document.querySelector(".modal_container"); 
         var trigger = document.querySelector(".trigger"); 
         var closeButton = document.querySelector(".modal_close_btn"); 
         var cancelButton = document.querySelector("#cancel");

        //console.log(modal);

        function toggleModal() { 
            modal_container.classList.toggle("show-modal"); 
         }

        function windowOnClick(event) { 
             if (event.target === modal_container) { 
                 toggleModal(); 
             } 
         }

        trigger.addEventListener("click", toggleModal); 
         closeButton.addEventListener("click", toggleModal); 
         cancel.addEventListener("click", toggleModal); 
         window.addEventListener("click", windowOnClick); 
     </script>

