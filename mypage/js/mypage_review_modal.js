
function init_modal_script(){
     // Modal을 가져옵니다.
     var modal_container_review = document.getElementsByClassName("modal_container_review");
     // Modal을 띄우는 클래스 이름을 가져옵니다.
     var review_dialog_trigger = document.getElementsByClassName("review_dialog_trigger");
     // Modal을 닫는 close 클래스를 가져옵니다.
     var modal_close_btn_review = document.getElementsByClassName("modal_close_btn_review");
     // 댓글창을 가져온다.
     var comments_container = document.getElementsByClassName("comments_container");
     // 좋아요 버튼 가져온다
     var like_ckeckbox_class = document.getElementsByClassName("like_ckeckbox_class");
     // 댓글 리스트가 담기는 공간 가져온다
     var comments_list = document.getElementsByClassName("comments_list");
     var funcs = [];

     // Modal을 띄우고 닫는 클릭 이벤트를 정의한 함수
     function Modal(num) {
       return function() {
         // ********************
         // 해당 클래스의 내용을 클릭하면 Modal을 띄움
         // ********************
         review_dialog_trigger[num].onclick =  function() {
          modal_container_review[num].style.visibility = "visible";
         };
     
         // ********************
         // <span> 태그(X 버튼)를 클릭하면 Modal이 닫습니다.
         // ********************
         modal_close_btn_review[num].onclick = function() {
          modal_container_review[num].style.visibility = "hidden";
         };

        // ********************
        //  댓글 icon 클릭시 댓글 리스트 창 노출
        // ********************
        var checkbox = document.getElementById("checkbox" + num);
        checkbox.onclick = function () {
          if(checkbox.checked == true){
            comments_container[num].style.display = "inline-block";
          }else{
            comments_container[num].style.display = "none";
          }
        };

        // ********************
        // 좋아요 icon 클릭 시 폼 전송 및 icon 변경
        // ********************
        var like_checkbox = document.getElementById("like_checkbox" + num);
        var review_num = document.getElementById("review_num" + num);
        like_checkbox.onclick = function () {
          // ajax 사용
          var data = "";
          var httpRequest = new XMLHttpRequest();

          // 데이터 받아왔을 때 실행되는 함수
			    httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState == XMLHttpRequest.DONE && httpRequest.status == 200 ) {
					    document.getElementById("like_checkbox_label" + num).innerHTML = httpRequest.responseText;
				    }
          };
          // icon 변경 함수
          if(like_checkbox.checked == true){
            like_ckeckbox_class[num].src = "./img/like_color.png"; 
          }else{
            like_ckeckbox_class[num].src = "./img/like.png"; 
          }
          data = "review_num=" + review_num.value;
          httpRequest.open("POST", "../review/review_like_ajax_request.php", true);
          httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          httpRequest.send(data);
        };
        
        // ********************
        // 댓글 보내기 버튼
        // ********************
        var reply_input_button = document.getElementById("reply_input_button" + num);
        var reply_count = document.getElementById("reply_count" + num);
        var review_reply_contents = document.getElementById("review_reply_contents" + num);
        var mode = document.getElementById("mode" + num);
        // 위에 선언 먼저 되어 있음
        // var review_num = document.getElementById("review_num" + num);
        var userpage_user_num = document.getElementById("userpage_user_num" + num);
        
        reply_input_button.onclick = function () {
          // 댓글 내용 입력 확인
          if (!review_reply_contents.value.trim()){
            alert("내용을 입력하세요!");
            review_reply_contents.focus();
            return;
          }

          var httpRequest = new XMLHttpRequest();

          // 데이터 받아왔을 때 실행되는 함수
			    httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState == XMLHttpRequest.DONE && httpRequest.status == 200 ) {
              comments_list[num].innerHTML = httpRequest.responseText;
              var value = httpRequest.getResponseHeader("replycount");
              reply_count.innerHTML = "<p>" + value + "</p>";
              review_reply_contents.value = "";
				    }
          };

          data = "mode="+ mode.value +"&review_num=" + review_num.value + "&userpage_user_num="+userpage_user_num.value + "&review_reply_contents=" + review_reply_contents.value;
          httpRequest.open("POST", "../review/review_d_m_i.php", true);
          httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          httpRequest.send(data);
        }

      };
     }

    // ********************
    // 초기화 함수
    // ********************
     // 원하는 Modal 수만큼 Modal 함수를 호출해서 funcs 함수에 정의합니다.
     for(var i = 0; i < review_dialog_trigger.length; i++) {
       funcs[i] = Modal(i);
     }

     // 원하는 Modal 수만큼 funcs 함수를 호출합니다.초기화 하는 역할
     for(var j = 0; j < review_dialog_trigger.length; j++) {
       funcs[j]();
     }

    //  페이지 상단으로 올리기
    $(function() {
      $(window).scroll(function() {
          if ($(this).scrollTop() > 200) {
              $('#btn_top').fadeIn();
          } else {
              $('#btn_top').fadeOut();
          }
      });
      
      $("#btn_top").click(function() {
          $('html, body').animate({
              scrollTop : 0
          }, 400);
          return false;
      });
  });
}

window.onload = init_modal_script();