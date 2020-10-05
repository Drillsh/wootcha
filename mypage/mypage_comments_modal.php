<!-- <button class="review_dialog_trigger" >1영화 코멘트 클릭했을 때 화면</button>
<button class="review_dialog_trigger" >2영화 코멘트 클릭했을 때 화면</button>
<button class="review_dialog_trigger" >3영화 코멘트 클릭했을 때 화면</button> -->

<!-- ****************** -->
<!-- css -->
<!-- ****************** -->

<style type="text/css"> 
    /* 빈공간을 어둡게 채우는 창 */
    .modal_container { position: fixed; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);  z-index: 1; 
        opacity: 1;  visibility: hidden; transform: scale(1.0); transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s; } 

    /* 흰 화면의 dialog 부분 */
    .modal_container .modal_content {  position: absolute;   top: 50%;  left: 50%;  transform: translate(-50%, -50%); background-color: white; 
         padding: 1rem 1.5rem;   width: 700px;  height: 600px;   border-radius: 0.5rem;  } 

    /* 상단 닉네임 및 평점 부분 */
    .modal_container .modal_content_header{height: 50px; width:95%; position:relative;}

    /* 프로필 이미지 */
    .modal_container .small_img_box{ width: 45px; height: 45px; border-radius: 50%; overflow: hidden; display:inline-block;}
    .modal_container .small_img_box img{width: 100%; height: 100%; object-fit: cover;}
    
    /* 닉네임 */
    .modal_container .modal_content_header div:nth-child(2){display:inline; margin-left:20px; margin-right:300px; 
        position:absolute; left:40px; top:15px}
    
    /* 평점 */
    .modal_container .modal_content_header div:nth-child(3){display:inline; margin-right:50px;position:absolute; right:60px; top:15px}

    /* 닫기 버튼 */
    .modal_container .modal_close_btn { float: right; width: 1.5rem; line-height: 1.5rem; text-align: center; cursor: pointer; 
         border-radius: 0.25rem;  background-color: lightgray;  } 
    .modal_container .modal_close_btn:hover { background-color: darkgray; } 

    /* 영화제목 */
    .modal_container .title{ font-family: 'Oswald', sans-serif; color: #216182; margin-top:30px; margin-bottom:50px} 

    /* 한줄평 및 장문평 제목 */
    .modal_container h3{margin-top:20px; font-family: 'Oswald', sans-serif; color: #216182;}

    /* 한줄평 */
    .line_review{word-break:break-all; font-family: 'Oswald', sans-serif; font-size: 20px; width:90%; margin:0 auto; margin-bottom:30px}
    
    /* 장문평 */
    .long_review{word-break:break-all; font-family: 'Oswald', sans-serif; font-size: 20px; width:90%; margin:0 auto; margin-bottom:30px;
        max-height:200px; overflow-y:auto; }

    /* 좋아요 및 댓글 icon */
    .modal_content_bottom {width:99%; height:30px;}
    .modal_content_bottom input{display:none;}

    .modal_content_bottom img{width:20px; height:20px; display:inline-block; line-height:30px}
    .modal_content_bottom p{display:inline-block; line-height:30px; margin-right:20px}
    
    /* 등록일자 */
    .modal_content_bottom .review_regist_day{float:right;}

    /* ************** */
    /* 댓글 창 */
    /* ************** */
    .modal_container .comments_container{position: absolute;   top: 50%;  left: 80%;  transform: translate(-70%, -50%); background-color: white; 
         padding: 1rem 1.5rem;   width: 400px;  height: 600px;   border-radius: 0.5rem;}
    .modal_container .comments_container .comments_list{width: 100%;  height: 440px; overflow-y:auto }
    .modal_container .comments_container .comments_register{width: 100%;  height: 140px; }
    
    /* comments item */
    .modal_container .comments_container .comments_item{position:relative;}
    
    
    /* profile image  및 닉네임*/
    .modal_container .comments_container .profile_box{display:inline-block; margin-right:15px; width:100px;text-align:center;}
    .modal_container .comments_container .profile_box p{font-size:13px; }
    .modal_container .comments_container .profile_box a{text-decoration:none;}
    
    /* 댓글 내용 */
    .modal_container .comments_container .comment_content p{word-break:break-all;}
    .modal_container .comments_container .comment_content {display:inline-block; width:250px; vertical-align:middle;
        position:absolute; top: 50%; left: 60%; transform:translate(-50%, -50%);}

    /* 댓글 작성 창 */
    .modal_container .comments_container .comments_register textarea{width:100%; height:100px; resize:none; margin-top:10px;}
    .modal_container .comments_container .comments_register .submit_btn_box{margin-top:10px; float:right;}



    /* .modal_container label { display: block; margin-top: 20px; letter-spacing: 2px; } 
    .modal_container form {  margin: 0 auto; width: 459px; } 
    .modal_container input, .modal_container textarea {  width: 439px; height: 27px; background-color: #efefef; border-radius: 6px; 
        border: 1px solid #dedede;  padding: 10px; margin-top: 3px; font-size: 0.9em; color: #3a3a3a; } 
    .modal_container input:focus, .modal_container textarea:focus{ border: 1px solid #97d6eb; } 
    .modal_container textarea{ height: 60px; background-color: #efefef; } 
    .modal_container #submit{ width: 127px; height: 48px; text-align: center; border: none; margin-top: 20px; cursor: pointer;} 
    .modal_container #submit:hover{ color: #fff; background-color: #216282; opacity: 0.9; } 
    .modal_container #cancel { width: 127px; height: 48px; text-align: center; border: none; margin-top: 20px; cursor: pointer; } 
    .modal_container #cancel:hover{ color: #fff; background-color: #216282; opacity: 0.9; }
    
    .modal_container #like, .modal_container #review{float:left; background-color:yellow; width:100px; height:40px;}  */
</style>

<!-- ****************** -->
<!-- php -->
<!-- ****************** -->
<?php
    for($i=0; $i < $row_num; $i++){
?>
<!-- 팝업 될 레이어 --> 
<div class="modal_container" name="modal_container"> 
    <div class="modal_content"> 
        <span class="modal_close_btn">&times;</span>
        <!-- 상단 프로필 및 평점 -->
        <div class="modal_content_header">
            <!-- profile img -->
            <div class="small_img_box">
                <img src="./img/profile_image<?=$i?>.png" alt="프로필 이미지">
            </div> 

            <!-- 닉네임 -->
            <div>
                닉네임<?=$i?>
            </div>
        
            <!-- 평점 -->
            <div>
                평점<?=$i?>
            </div>
        </div>
        <hr width="99%" color="#e2e2e2" noshade/>
        
        <h3 class="title">영화제목<?=$i?></h3>
        <h3>한 줄 평</h3>
        <p class="line_review"><?=$i?>한줄평한줄평한줄평한줄평한줄평한줄평한줄평</p>
        <h3>장 문 평</h3>
        <p class="long_review"><?=$i?>장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.장문평입니다.</p>
        <hr width="99%" color="#e2e2e2" noshade/>

        <!-- 좋아요 및 댓글 icon -->
        <div class="modal_content_bottom">
            <!-- 좋아요 -->
            <span>
                <img src="./img/like.png" alt="">
                <p><?=$i?></p>
            </span>
            <!-- 댓글 -->
            <span>
                <input type="checkbox" id="checkbox<?=$i?>">
                <label for="checkbox<?=$i?>"><img src="./img/comments.png" alt="">&nbsp;<p><?=$i?></p></label>
                <!-- <img src="./img/comments.png" alt=""> -->
                
            </span>
            <!-- 등록일자 -->
            <p class="review_regist_day">등록일자<?=$i?></p>
        </div>
        <!-- <form action="#" method="POST">
            <label for="line_review">한 줄 평</label>
            <input type="text" name="line_review" placeholder="a line review">
            <label for="long_review">장 문 평</label> 
            <textarea name="long_review" placeholder="Test Message"></textarea> 
            <label></label> 
            <input type="button" id="like" value="좋아요"> 
            <input type="button" id="review" value="댓글"> 
            <br>
            <div>-</div>
            <br>
            
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
        </form>  -->
    </div>
    <div class="comments_container">
        <div class="comments_list">

            <!-- 여기서부터 db에서 가져올 내용 -->
            <div class="comments_item">
                <!-- profile image -->
                <div class="profile_box">
                    <a href="#">
                        <div class="small_img_box">
                            <img src="./img/profile_image.png" alt="프로필 이미지 수정">
                        </div>
                        <p>닉네임</p>
                    </a>
                </div>
                <div class="comment_content">
                    <!-- 댓글 내용 -->
                    <p>ㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋ</p>
                </div>
            </div><!-- 여기서부터 db에서 가져올 내용 -->
            <div class="comments_item">
                <!-- profile image -->
                <div class="profile_box">
                    <a href="#">
                        <div class="small_img_box">
                            <img src="./img/profile_image.png" alt="프로필 이미지 수정">
                        </div>
                        <p>닉네임</p>
                    </a>
                </div>
                <div class="comment_content">
                    <!-- 댓글 내용 -->
                    <p>ㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋ</p>
                </div>
            </div><!-- 여기서부터 db에서 가져올 내용 -->
            <div class="comments_item">
                <!-- profile image -->
                <div class="profile_box">
                    <a href="#">
                        <div class="small_img_box">
                            <img src="./img/profile_image.png" alt="프로필 이미지 수정">
                        </div>
                        <p>닉네임</p>
                    </a>
                </div>
                <div class="comment_content">
                    <!-- 댓글 내용 -->
                    <p>ㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋ</p>
                </div>
            </div><!-- 여기서부터 db에서 가져올 내용 -->
            <div class="comments_item">
                <!-- profile image -->
                <div class="profile_box">
                    <a href="#">
                        <div class="small_img_box">
                            <img src="./img/profile_image.png" alt="프로필 이미지 수정">
                        </div>
                        <p>닉네임</p>
                    </a>
                </div>
                <div class="comment_content">
                    <!-- 댓글 내용 -->
                    <p>ㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋ</p>
                </div>
            </div><!-- 여기서부터 db에서 가져올 내용 -->
            <div class="comments_item">
                <!-- profile image -->
                <div class="profile_box">
                    <a href="#">
                        <div class="small_img_box">
                            <img src="./img/profile_image.png" alt="프로필 이미지 수정">
                        </div>
                        <p>닉네임</p>
                    </a>
                </div>
                <div class="comment_content">
                    <!-- 댓글 내용 -->
                    <p>ㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzㅋㅋㅋㅋ</p>
                </div>
            </div>



        </div>
        
        <hr width="99%" color="#e2e2e2" noshade/>
        <form action="#">
            <div class="comments_register">
                <textarea name="" id="" cols="30" rows="10"></textarea>
                <div class="submit_btn_box">
                    <input type="submit" value="보내기">
                </div>
            </div>
        </form>
    </div> 
</div>

<?php
    }
?>


<!-- ****************** -->
<!-- javascript -->
<!-- ****************** -->
    <script type="text/javascript"> 
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

        
     </script>

