
window.onload = function () {
  var follow_checkbox = document.getElementById("follow_checkbox");
  var follow_user_num = document.getElementById("follow_user_num");
  var follow_checkbox_label = document.getElementById("follow_checkbox_label");
  var follow_ckeckbox_class = document.getElementsByClassName("follow_ckeckbox_class");
  
  follow_checkbox.onclick = function () {
        // document.getElementById("follow_form").submit();
        
        // ajax 사용
        var data = "";
        var httpRequest = new XMLHttpRequest();
        // 데이터 받아왔을 때 실행되는 함수
        httpRequest.onreadystatechange = function() {
          if (httpRequest.readyState == XMLHttpRequest.DONE && httpRequest.status == 200 ) {
            follow_checkbox_label.innerHTML = httpRequest.responseText;
          }
        };
        
        // icon 변경 함수
        if(follow_checkbox.checked == true){
          follow_ckeckbox_class[0].src = "http://"+ location.host +"/wootcha/mypage/img/follow_color.png"; 
          data = "follow_user_num=" + follow_user_num.value + "&checked=check";
        }else{
          follow_ckeckbox_class[0].src = "http://"+ location.host +"/wootcha/mypage/img/follow.png"; 
          data = "follow_user_num=" + follow_user_num.value + "&checked=";
        }
        httpRequest.open("POST", "http://"+ location.host +"/wootcha/mypage/mypage_follow_d_m_i.php", true);
        httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        httpRequest.send(data);
  }
}
