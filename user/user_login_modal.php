<!-- <button class="trigger_user_login" >로그인</button> -->

<!-- ****************** -->
<!-- css -->
<!-- ****************** -->

<style type="text/css"> 
    /* 빈공간을 어둡게 채우는 창 */
    .modal_container_login
 { position: fixed; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);  z-index: 1; 
        opacity: 1;  visibility: hidden; transform: scale(1.0); transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s; } 

    /* 흰 화면의 dialog 부분 */
    .modal_container_login 
 .modal_content_login {  position: absolute;   top: 50%;  left: 50%;  transform: translate(-50%, -50%); background-color: white; 
         padding: 1rem 1.5rem;   width: 400px;  height: 400px;   border-radius: 0.5rem; text-align:center; overflow:hidden;} 

    /* 끄기 버튼 */
    .modal_container_login .modal_close_btn_login { float: right; width: 1.5rem; line-height: 1.5rem; text-align: center; cursor: pointer; 
        border-radius: 0.25rem; background-color: lightgray; }
    .modal_container_login .modal_close_btn_login:hover { background-color: darkgray; } 

    /* 상단 닉네임 및 평점 부분 */
    .modal_container_login 
 .login_modal_content_header{height: 50px; width:95%; position:relative;}

    /* 프로필 이미지 */
    .modal_container_login 
 .small_img_box{ width: 45px; height: 45px; border-radius: 50%; overflow: hidden; display:inline-block;}
    .modal_container_login 
 .small_img_box img{width: 100%; height: 100%; object-fit: cover;}
    
    /* 로그인 폼 */
    .modal_content_login form{width:100%;text-align:center; margin-top:20px; margin-bottom:20px}  
    .modal_content_login form table{width:100%;margin-bottom:20px}
    .modal_content_login form table tr{height:60px; margin-top:20px;}
    .modal_content_login form table tr td{width:100%; line-height:60px; text-align:center;}

    .modal_content_login form table p{width:100%;height:15px; line-height:20px; text-align:center;}
    .modal_content_login form table td input[type=text],[type=password]{width:300px;height:50px; font-size:15px;text-align:center;}
    .modal_content_login form table td input{height:50px;}
    
    /* 로그인 버튼 */
    .modal_content_login form input[type=button]{width:90%; height: 50px; background-color:#679b9b; border-style:none;
        border-radius: 0.5rem;font-size:20px;font-weight: bold}

    /* 하단 버튼 */
    .modal_content_login button{width:40%; height:40px; font-size:15px;margin:10px }
</style>
<script src="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/user/js/login.js?after"></script>
<!-- ****************** -->
<!-- php -->
<!-- ****************** -->

<!-- 팝업 될 레이어 --> 
<div class="modal_container_login" name="modal_container_login"> 
    <div class="modal_content_login"> 
        <!-- 닫기 버튼 -->
        <span class="modal_close_btn_login">&times;</span>
        <!-- 상단 로고 -->
        <div class="login_modal_content_header">
            <!-- 로고 -->
            <!-- <div class="small_img_box">
                <img src="./img/profile_image< ?=$i?>.png" alt="프로필 이미지">
            </div>  -->
        </div>
        <hr width="99%" color="#e2e2e2" noshade/>
        
        <!-- 로그인 폼 -->
        <form action="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/user/user_login.php" id="login_form" name="login_form" method="post">
        <table>
            <!-- 아이디(이메일) -->
            <tr>
                <td>
                    <input type="text" id="login_email" name="login_email" placeholder="아이디(이메일)" >
                </td>
            </tr>
            <!-- 비밀번호 -->
            <tr>
                <td>
                    <input type="password" id="login_password" name="login_password" placeholder="비밀번호">
                </td>
            </tr>
        </table>
        <input type="button" value="로그인" onclick="check_input_login()">
        </form>
        <hr width="99%" color="#e2e2e2" noshade/><!-- 구분선 -->
        <button> api 로그인 </button>
        <button onclick="signupClick()"> 회원가입하기 </button>
        <button onclick=""> 계정찾기 </button>
    </div>
</div>


<!-- ****************** -->
<!-- javascript -->
<!-- ****************** -->
    <script type="text/javascript"> 
        // Modal을 가져옵니다.
        var modal_container_login = document.getElementsByClassName("modal_container_login");
        // Modal을 띄우는 클래스 이름을 가져옵니다.
        var trigger_user_login = document.getElementsByClassName("trigger_user_login");
        // Modal을 닫는 close 클래스를 가져옵니다.
        var modal_close_btn_login = document.getElementsByClassName("modal_close_btn_login");
        var funcs = [];

        // Modal을 띄우고 닫는 클릭 이벤트를 정의한 함수
        function Modal(num) {
          return function() {
            // 해당 클래스의 내용을 클릭하면 Modal을 띄움
            trigger_user_login[num].onclick =  function() {
                modal_container_login[num].style.visibility = "visible";
            };
        
            // <span> 태그(X 버튼)를 클릭하면 Modal이 닫습니다.
            modal_close_btn_login[num].onclick = function() {
                modal_container_login[num].style.visibility = "hidden";
            };
          };
        }

        // 원하는 Modal 수만큼 Modal 함수를 호출해서 funcs 함수에 정의합니다.
        for(var i = 0; i < trigger_user_login.length; i++) {
          funcs[i] = Modal(i);
        }

        // 원하는 Modal 수만큼 funcs 함수를 호출합니다.초기화 하는 역할
        for(var j = 0; j < trigger_user_login.length; j++) {
          funcs[j]();
        }

        function signupClick() {
            modal_close_btn_login[0].onclick();
            (document.getElementsByClassName('trigger_user_signup'))[0].onclick();
        }


     </script>

