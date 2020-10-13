<style type="text/css">
    /* 빈공간을 어둡게 채우는 창 */
    .modal_container_find_account {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 3;
        opacity: 1;
        visibility: hidden;
        transform: scale(1.0);
        transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
    }

    /* 흰 화면의 dialog 부분 */
    .modal_container_find_account .modal_content_find_account {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 1rem 1.5rem;
        width: 400px;
        height: 400px;
        border-radius: 0.5rem;
        text-align: center;
        overflow: hidden;
    }

    /* 끄기 버튼 */
    .modal_container_find_account .modal_close_btn_find_account {
        float: right;
        width: 1.5rem;
        line-height: 1.5rem;
        text-align: center;
        cursor: pointer;
        border-radius: 0.25rem;
        background-color: lightgray;
    }
    .modal_container_find_account .modal_close_btn_find_account:hover {
        background-color: darkgray;
    }

    /* 상단 닉네임 및 평점 부분 */
    .modal_container_find_account .find_account_modal_content_header {
        height: 50px;
        width: 95%;
        position: relative;
    }

    /* 프로필 이미지 */
    .modal_container_find_account .small_img_box {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        overflow: hidden;
        display: inline-block;
    }
    .modal_container_find_account .small_img_box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* 로그인 폼 */
    .modal_content_find_account form {
        width: 100%;
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .modal_content_find_account form table {
        width: 100%;
        margin-bottom: 20px;
    }
    .modal_content_find_account form table tr {
        /* height: 60px; */
        margin-top: 20px;
    }
    .modal_content_find_account form table tr td {
        width: 100%;
        line-height: 60px;
        text-align: center;
    }

    .modal_content_find_account form table tr td#find_account_password_tr {
        display:table-cell;
    }
    .modal_content_find_account form table tr td#find_account_email_tr {
        display:none;
    }

    .modal_content_find_account form table p {
        width: 100%;
        height: 15px;
        line-height: 20px;
        text-align: center;
    }
    .modal_content_find_account form table td input[type=text],
    [type=password] {
        width: 300px;
        height: 50px;
        font-size: 15px;
        text-align: center;
    }
    .modal_content_find_account form table td input {
        height: 50px;
    }

    /* 로그인 버튼 */
    .modal_content_find_account form input[type=button] {
        width: 90%;
        height: 50px;
        background-color: #679b9b;
        border-style: none;
        border-radius: 0.5rem;
        font-size: 20px;
        font-weight: bold;
    }

    /* 하단 버튼 */
    .modal_content_find_account button {
        width: 40%;
        height: 40px;
        font-size: 15px;
        margin: 10px;
    }
</style >

<!-- 팝업 될 레이어 -->
<div class="modal_container_find_account" name="modal_container_find_account">
    <div class="modal_content_find_account">
        <!-- 닫기 버튼 -->
        <span class="modal_close_btn_find_account">&times;</span>
        <!-- 상단 로고 -->
        <div class="find_account_modal_content_header">
            <!-- 로고 -->
            <!-- <div class="small_img_box"> <img src="./img/profile_image< ?=$i?>.png"
            alt="프로필 이미지"> </div> -->
        </div>
        <hr width="99%" color="#e2e2e2" noshade="noshade"/>

        <!-- 로그인 폼 -->
        <form
            action="http://<?=$_SERVER['HTTP_HOST']?>/wootcha/user/user_find_account_check.php"
            id="find_account_form"
            name="find_account_form"
            method="post">
            <table>
                <tr>
                    <td>
                        <input type="radio" id="find_mode_email" name="find_mode" value="email" onclick="find_mode_email()" checked>
                        <label for="find_mode_email">이메일(ID) 찾기</label>
                        <input type="radio" id="find_mode_password" name="find_mode" value="password" onclick="find_mode_password()" >
                        <label for="find_mode_password">비밀번호 찾기</label>
                    </td>
                </tr>
                <!-- 이름 -->
                <tr>
                    <td>
                        <input
                            type="text"
                            id="find_account_name"
                            name="find_account_name"
                            placeholder="이름"
                            onblur="">
                    </td>
                </tr>
                <!-- 전화번호 -->
                <tr>
                    <td>
                        <input
                            type="tel"
                            id="find_account_phone"
                            name="find_account_phone"
                            placeholder="전화번호 ex) 010-1234-5678 "
                            onblur="">
                        </td>
                    </tr>
                <!-- 비밀번호 -->
                <tr>
                    <td id="find_account_password_tr">
                        <input
                            type="password"
                            id="find_account_password"
                            name="find_account_password"
                            placeholder="비밀번호">
                    </td>
                </tr>
                <!-- 아이디 -->
                <tr>
                    <td  id="find_account_email_tr">
                        <input
                            type="text"
                            id="find_account_email"
                            name="find_account_email"
                            placeholder="이메일(ID)을 입력하세요">
                    </td>
                </tr>
            </table>
            
            <input type="button" value="계정찾기" onclick="check_input_find_account()">
        </form>

    </div>
</div>

<script>
    // ****************
    // 모달 관련 스크립트
    // ****************
    // Modal을 가져옵니다.
    var modal_container_find_account = document.getElementsByClassName(
        "modal_container_find_account"
    );
    // Modal을 띄우는 클래스 이름을 가져옵니다.
    var trigger_user_find_account = document.getElementsByClassName(
        "trigger_user_find_account"
    );
    // Modal을 닫는 close 클래스를 가져옵니다.
    var modal_close_btn_find_account = document.getElementsByClassName(
        "modal_close_btn_find_account"
    );

    var find_mode_email = document.getElementById('find_mode_email');
    var find_mode_password = document.getElementById('find_mode_password');
    var find_account_name = document.getElementById('find_account_name');
    var find_account_phone = document.getElementById('find_account_phone');
    var find_account_password = document.getElementById('find_account_password');
    var find_account_email = document.getElementById('find_account_email');
    var find_account_password_tr = document.getElementById('find_account_password_tr');
    var find_account_email_tr = document.getElementById('find_account_email_tr');

    // 해당 클래스의 내용을 클릭하면 Modal을 띄움
    trigger_user_find_account[0].onclick = function () {
        (document.getElementsByClassName("modal_close_btn_login"))[0].onclick();
        modal_container_find_account[0].style.visibility = "visible";
    };
    
    // <span> 태그(X 버튼)를 클릭하면 Modal이 닫습니다.
    modal_close_btn_find_account[0].onclick = function () {
        find_account_name.value = "";
        find_account_phone.value = "";
        find_account_email.value = "";
        find_account_password.value = "";
        find_mode_email.checked = 'checked';
        modal_container_find_account[0].style.visibility = "hidden";
    };
    
    // ****************
    // 계정 찾기 관련 스크립트
    // ****************
    find_mode_email.onclick = function () {
        find_account_email_tr.style.display ="none";
        find_account_password_tr.style.display ="table-cell";
    }
    find_mode_password.onclick = function () {
        find_account_password_tr.style.display = 'none';
        find_account_email_tr.style.display = 'table-cell';
    }
    
    function check_input_find_account(){
        if (!document.find_account_form.find_account_name.value) {
            alert("이름을 입력하세요");    
            document.find_account_form.find_account_name.focus();
            return;
        }
    
        if (!document.find_account_form.find_account_phone.value){
            alert("전화번호를 입력하세요");    
            document.find_account_form.find_account_phone.focus();
            return;
        }
        if(find_mode_email.checked == true){
            flag = "email";
            if (!document.find_account_form.find_account_password.value){
            alert("비밀번호를 입력하세요");    
            document.find_account_form.find_account_password.focus();
            return;
            }
        }else if(find_mode_password.checked == true){
            flag = "password";
            if (!document.find_account_form.find_account_email.value){
            alert("이메일(ID)을 입력하세요");    
            document.find_account_form.find_account_email.focus();
            return;
            }
        }
        var httpRequest = new XMLHttpRequest();

          // 데이터 받아왔을 때 실행되는 함수
		httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == XMLHttpRequest.DONE && httpRequest.status == 200 ) {
            alert(httpRequest.responseText);
            modal_close_btn_find_account[0].onclick();
            document.getElementsByClassName("trigger_user_login")[0].onclick();
			}
        };

        data = "find_mode="+ flag +"&find_account_name=" + find_account_name.value + "&find_account_phone="+find_account_phone.value + "&find_account_password=" + find_account_password.value + "&find_account_email=" + find_account_email.value;
        httpRequest.open("POST", "./user/user_find_account_check.php", true);
        httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        httpRequest.send(data);
    }
    find_mode_email.onclick();
</script>