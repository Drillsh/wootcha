var check = true;
var count = 8;

$(document).ready(function() {
   $(window).scroll(function(){

     let $window = $(this);
    //  스크롤 바 위치 가져옴
     let scrollTop = $window.scrollTop();
     //  화면 높이를 가져옴
     let windowHeight = $window.height();
     let documentHeight = $(document).height();
     var user_num = document.getElementById('userpage_user_num');
    //  로딩 박스
      var loading_box = document.getElementById('loading_box');
       if (scrollTop + windowHeight + 10 > documentHeight) {
         if(check){
           check = false;
           $.ajax({

             type: "GET",
             url: "mypage_auto_add_like_movie.php?count="+count+"&user_num="+user_num.value,
             
             success: function(html){
                  if (html != "") {
                    loading_box.style.display = "block";
                    setTimeout(() => {
                      loading_box.style.display = "none";
                      $('#fav_movie_list_container').append(html);
                      count += 8;
                    }, 1000);
                    
                  }
             }
           }); // end of ajax
           
           console.log(count);
           setTimeout(function(){check = true;},1000);
         }

      }


    });
  });
