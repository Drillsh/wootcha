<button class="review_dialog_trigger" >1영화 코멘트 클릭했을 때 화면</button>

<!-- ****************** -->
<!-- css -->
<!-- ****************** -->

<style type="text/css"> 
    /* 빈공간을 어둡게 채우는 창 */
    .modal_container { position: fixed; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);  z-index: 1; 
        opacity: 1;  visibility: hidden; transform: scale(1.0); transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s; } 

    /* 흰 화면의 dialog 부분 */
    .modal_container .modal_content {  position: absolute;   top: 50%;  left: 50%;  transform: translate(-50%, -50%); background-color: white; 
         padding: 1rem 1.5rem;   width: 400px;  height: 800px;   border-radius: 0.5rem; text-align:center; } 

    /* 상단 닉네임 및 평점 부분 */
    .modal_container .modal_content_header{height: 50px; width:95%; position:relative;}

    /* 프로필 이미지 */
    .modal_container .small_img_box{ width: 45px; height: 45px; border-radius: 50%; overflow: hidden; display:inline-block;}
    .modal_container .small_img_box img{width: 100%; height: 100%; object-fit: cover;}
    
    /* 회원가입 폼 */
    .modal_content form{width:100%;text-align:center;}
    .modal_content form table{width:100%;}
    .modal_content form table tr{height:60px}
    .modal_content form table td{width:100%; line-height:60px; text-align:center;}
    .modal_content form table td input[type=text],[type=password],[type=tel],[type=date]{width:300px;height:50px; font-size:15px;text-align:center;}
    .modal_content form table td input{height:50px;}
    /* .modal_content form table td input[type=date]::before {content:attr(data-placeholder); width:100%;}
    .modal_content form table td input[type=date]:focus::before{display:none;}
    .modal_content form table td input[type=date]:valid ::before{display:none;} */
    .modal_content form table td p{display:none;}
    .modal_content form table tr:nth-child(6) td{position:relative;}
    .modal_content form table tr:nth-child(6) label{position:absolute; left:0; right:0; top:0; bottom:0; color:gray;}
    .modal_content form table tr:nth-child(6) input:focus ~ label,
    .modal_content form table tr:nth-child(6) input:valid ~ label {display:none;}
    .modal_content form table tr:nth-child(6) input[type=date]{text-align:left;}
    /* date 힌트 가리기 */
    /* .modal_content form table tr:nth-child(6) input[type=date]::-webkit-datetime-edit-text { -webkit-appearance: none; display: none; }
    .modal_content form table tr:nth-child(6) input[type=date]::-webkit-datetime-edit-month-field{ -webkit-appearance: none; display: none; } 
    .modal_content form table tr:nth-child(6) input[type=date]::-webkit-datetime-edit-day-field { -webkit-appearance: none; display: none; } 
    .modal_content form table tr:nth-child(6) input[type=date]::-webkit-datetime-edit-year-field { -webkit-appearance: none; display: none; } */

    


    

    
</style>
<script src="../user/js/sign_up.js"></script>
<!-- ****************** -->
<!-- php -->
<!-- ****************** -->
<?php
    for($i=0; $i < 4; $i++){
?>
<!-- 팝업 될 레이어 --> 
<div class="modal_container" name="modal_container"> 
    <div class="modal_content"> 
        <!-- 상단 로고 -->
        <div class="modal_content_header">
            <!-- 로고 -->
            <div class="small_img_box">
                <img src="./img/profile_image<?=$i?>.png" alt="프로필 이미지">
            </div> 
        </div>
        <hr width="99%" color="#e2e2e2" noshade/>
        
        <!-- 회원가입 폼 -->
        <form action="#">
        <table>
            <tr>
                <td>
                    <input type="text" id="signup_email" name="signup_email" placeholder="아이디(이메일)" onblur="check('email')">
                    <p id="signup_email_ck">AAA</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" id="signup_password" name="signup_password" placeholder="비밀번호">
                    <p>AA</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" id="signup_password_re" name="signup_password_re" placeholder="비밀번호 확인">
                    <p>DDD</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" id="signup_name" name="signup_name" placeholder="이름">
                    <p>FFF</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" id="signup_nickname" name="signup_nickname" placeholder="닉네임">
                    <p>DDD</p>
                </td>
            </tr>
            <tr>
                <td>
                    <!-- data-placeholder="생년월일" -->
                    <input type="date" id="signup_birth_day" name="signup_birth_day" required aria-required="true">
                    <label for="date_input">생년월일</label>
                    <p>DDD</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" id="radio_male" name="gender" value="male" checked>
                    <label for="radio_male">male</label>
                    <input type="radio" id="radio_female" name="gender" value="female">
                    <label for="radio_female">female</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="tel" placeholder="전화번호 '-' 없이 입력. ex) 01012345678 ">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" id="avatar_1" name="avatar" value="user_robot_avatar0" checked>
                    <label for="avatar_1">1</label>
                    <input type="radio" id="avatar_2" name="avatar" value="user_robot_avatar1">
                    <label for="avatar_2">2</label>
                    <input type="radio" id="avatar_3" name="avatar" value="user_robot_avatar2">
                    <label for="avatar_3">3</label>
                    <input type="radio" id="avatar_4" name="avatar" value="user_robot_avatar3">
                    <label for="avatar_4">4</label>
                </td>
            </tr>
        </table>
        <input type="button" value="회원가입">
        </form>
        <hr width="99%" color="#e2e2e2" noshade/><!-- 구분선 -->
        <button> api 가입하기 </button>
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

