var check = true;
var count = 4;

$(document).ready(function() {
   $(window).scroll(function(){

     let $window = $(this);
     let scrollTop = $window.scrollTop();
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
             url: "infinite_sub.php?count="+count+"&user_num="+user_num.value,
             
             success: function(html){
                  if (html != "") {
                    loading_box.style.display = "block";
                    setTimeout(() => {
                      loading_box.style.display = "none";
                      $('.section_container').append(html);
                      init_modal_script();
                      count += 4;
                    }, 1000);
                    
                  }
             }
           }); // end of ajax
           setTimeout(function(){check = true;},1000);
         }

      }


    });
  });
