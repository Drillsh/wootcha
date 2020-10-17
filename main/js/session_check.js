window.onload = function () {
    var session_value_flag = document.getElementById('session_value_flag').value;
    var session_check = document.getElementsByClassName('session_check');

    session_check.each(function(index){
      $(this).on("click", function(){
        alert();
        if (session_value_flag == "false") {
          alert("로그인 후 이용하세요.");
          location.href = "http://"+ location.host +"/wootcha/index.php";
        }
    
      });
    });
  }
