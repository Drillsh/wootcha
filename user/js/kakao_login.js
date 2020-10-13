
//   <?php
//   include_once $_SERVER["DOCUMENT_ROOT"] . "/eduplanet/lib/db_connector.php";

//   $mode = isset($_GET['mode']) ? $_GET['mode'] : "gm";
//   $action = "/eduplanet/login_join/join_form.php?mode=" . $mode;
//   ?>

//   <!-- 카카오 로그인 정보를 담는 form (회원가입)-->
//   <form name="kakao_form" action=<?= $action ?> method="POST">
//     <input id="kakao_id" name="kakao_id" type="hidden">
//     <input id="kakao_email" name="kakao_email" type="hidden">
//   </form>

//   <!-- 카카오 로그인 정보를 담는 form (로그인)-->
//   <form name="kakao_login_form" action="/eduplanet/login_join/kakao_login.php?mode=<?= $mode ?>" method="POST">
//     <input id="kakao_id_login" name="kakao_id_login" type="hidden">
//     <input id="kakao_email_login" name="kakao_email_login" type="hidden">
//   </form>

//   <script>
    // 사용할 앱의 JavaScript 키 설정
    Kakao.init('2b6afa1b53bec9c5c3161feff6ce8026');

    function kakaoConn() {

      Kakao.Auth.logout();

    // 카카오 로그인 버튼 생성
    Kakao.Auth.loginForm({

      success: function(authObj) {

        // 로그인 성공 시, API 호출
        Kakao.API.request({

          url: '/v2/user/me',

          success: function(res) {

            //alert(JSON.stringify(res)); // kakao.api.request 에서 불러온 결과값 json형태로 출력
            //alert(JSON.stringify(authObj)); // Kakao.Auth.createLoginButton에서 불러온 결과값 json형태로 출력
            console.log(res.id); // id 정보 출력
            console.log(res.kakao_account.email); // 이메일 정보 출력
            console.log(authObj.access_token); // 토큰 값 출력

            // 카카오 로그인해서 가져온 값 변수에 저장
            var kakao_no = res.id;
            var kakao_email = res.kakao_account.email;

            // DB에 같은 아이디가 있는지 검사
            var url = "members_checkId.php?id=" + kakao_email + "&mode=" + mode;

            $.ajax({

              url: url,
              type: "GET",
              success: function(data) {

                // 이미 이메일이 가입되어 있을 때 --> 카카오 로그인
                if (data == 1) {

                  document.getElementById("kakao_id_login").value = kakao_no;
                  document.getElementById("kakao_email_login").value = kakao_email;

                  document.kakao_login_form.submit();

                  // 이메일이 가입되어 있지 않을 때 --> form 으로 이메일을 넘겨서 회원가입
                } else {
                  document.getElementById("kakao_id").value = kakao_no;
                  document.getElementById("kakao_email").value = kakao_email;

                  document.kakao_form.submit();
                  alert("아이디가 등록되어 있지 않아, 회원가입 페이지로 이동합니다.");
                }
              },
              error: function() {
                console.log("이메일 가입확인 ajax 실패");
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