

// SDK를 초기화 합니다. 사용할 앱의 JavaScript 키를 설정해 주세요.
Kakao.init('2b6afa1b53bec9c5c3161feff6ce8026');

// SDK 초기화 여부를 판단합니다.
console.log(Kakao.isInitialized());

function kakaoConn() {
  Kakao.Auth.logout();

  // 카카오 로그인 버튼 생성
  Kakao.Auth.loginForm({

    success: function(authObj) {

      // 로그인 성공 시, API 호출
      Kakao.API.request({

        url: '/v2/user/me',

        success: function(res) {
          // alert(res);
          // alert(JSON.stringify(res)); // kakao.api.request 에서 불러온 결과값 json형태로 출력
          // alert(JSON.stringify(authObj)); // Kakao.Auth.createLoginButton에서 불러온 결과값 json형태로 출력
          
          
          // 카카오 로그인해서 가져온 값 변수에 저장
          var kakao_no = res.id;
          var kakao_email = res.kakao_account.email;
          var kakao_nickname = res["kakao_account"]["profile"]["nickname"];
          var kakao_image = res["kakao_account"]["profile"]["profile_image_url"];

          console.log(1+". "+kakao_no); // id 정보 출력
          console.log(2+". "+kakao_email); // 이메일 정보 출력
          console.log(3+". "+kakao_nickname); // 토큰 값 출력
          console.log(4+". "+kakao_image); // 토큰 값 출력

          // DB에 같은 아이디가 있는지 검사
          var url = "user/user_signup_check.php";
          var get_data = "mode=kakao&email=" + kakao_email;
          $.ajax({

            url: url,
            type: "POST",
            data: get_data,
            dataType: "text",
            success: function(data) {

              // 이미 이메일이 가입되어 있을 때 --> 카카오 로그인
              if (data == 1) {
                location.href = "index.php";

                // 이메일이 가입되어 있지 않을 때 --> form 으로 이메일을 넘겨서 회원가입
              } else if(data == 0) {
                
                // 이메일
                var signup_email = document.getElementById("signup_email");
                signup_email.value = kakao_email;
                signup_email.readonly = true;
                // 비밀번호
                var signup_password = document.getElementById("signup_password");
                signup_password.value = kakao_no + "!k";
                signup_password.readonly = true;
                // 비밀번호 재입력
                var signup_password_re = document.getElementById("signup_password_re");
                signup_password_re.value = kakao_no + "!k";
                signup_password_re.readonly = true;
                // 이름
                var signup_name = document.getElementById("signup_name");
                signup_name.value = kakao_nickname;
                signup_name.readonly = true;
                // 닉네임
                var signup_nickname = document.getElementById("signup_nickname");
                signup_nickname.value = kakao_nickname;
                signup_nickname.readonly = true;
                // avatar
                var avatar = document.getElementsByName("avatar");
                for(var i = 1; i < avatar.length; i++){
                  avatar[i].style.display = "none";
                }
                var avatar_1_img = document.getElementById("avatar_1_img");
                var avatar_2_img = document.getElementById("avatar_2_img");
                var avatar_3_img = document.getElementById("avatar_3_img");
                var avatar_4_img = document.getElementById("avatar_4_img");
                avatar_2_img.style.display = "none";
                avatar_3_img.style.display = "none";
                avatar_4_img.style.display = "none";
                
                var avatar_1 = document.getElementById("avatar_1");
                avatar_1_img.src = kakao_image;
                avatar_1.value = kakao_image;

                var email_check_button = document.getElementById("email_check_button");
                email_check_button.style.display = "none";
              }
            },
            error: function() {
              alert("가입을 위해서는 모든 권한이 필요합니다.");
            }
          });
        },
        fail: function(error) {
          alert(JSON.stringify(error));
        }
      });
    },
    fail: function(err) {
      alert(JSON.stringify(err));
  }
});
} // end of kakaoConn();