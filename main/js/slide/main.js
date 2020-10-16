// 모든 문서가 로딩이 되면 자동으로 실행해주는 함수 => document.ready와 같음.
$(function () {
  // ========== 스크롤 최근 리뷰 컨테이너 ==========//

    //이전, 다음 버튼
    var prev = $(".css-BackwardButton-left");
    var next = $(".css-ForwardButton-right");
    var result_count = $('#result_count').val();

    var b_movie_index = 0;
    var b_review_index = 0;
    var r_review_index = 0;

    const VIEW_PAGE = 5;

    var totalIndex = Math.floor(result_count / VIEW_PAGE);
    const T_INDEX = 1;

    //좌우 네비게이션 버튼 함수
    function stateNavigationButton(index) {
        switch (index) {
            case 0:
                prev.hide();
                next.show();
                break;
            case 1:
            case 2:
                prev.show();
                next.show();
                break;
            case 3:
                prev.show();
                next.hide();
                break;
            default: break;
        }
    }
    
    // 이미지 전환
    function startAnimation(index, parent) {
        parent.css( {'transform' : "translateX("+ (-1255 * index) + "px )"} );
    }

    //이전 버튼
    prev.on("click", function(event){
        // if(currentIndex !== 0){
        //     currentIndex -= 1; 
        // }else{
        //     currentIndex = 0;
        // }
        // startAnimation(currentIndex);
        
    });

    //다음 버튼
    next.on("click", function(event){
        var parent = $(this).parents('.css-ScrollBarContainer').find('.css-ScrollingTaim');

        switch (parent[0].classList[1]) {
            case 'best_movie':
                if(b_movie_index !== T_INDEX){
                    b_movie_index += 1;
                }
                startAnimation(b_movie_index, parent);
                break;
            case 'best_review':
                if(b_review_index !== T_INDEX){
                    b_review_index += 1;
                }
                startAnimation(b_review_index, parent);
                break;
            case 'recent_review':
                if(r_review_index !== totalIndex){
                    r_review_index += 1;
                }
                startAnimation(r_review_index, parent);
                break;
        }
    });

  // // =========== 스크롤 서브1 리뷰 컨테이너 ===========//
  //   var container2 = $(".css-Sub1-ScrollingTaim");
  //
  //   //이전, 다음 버튼
  //   var prev2 = $(".css-Sub1-BackwardButton-left");
  //   var next2 = $(".css-Sub1-ForwardButton-right");
  //
  //   var currentIndex2 = 0;
  //
  //   //좌우 네비게이션 버튼 함수
  //   function stateNavigationButton(index) {
  //       switch (index) {
  //           case 0:
  //               prev2.hide();
  //               next2.show();
  //               break;
  //           case 1:
  //           case 2:
  //               prev2.show();
  //               next2.show();
  //               break;
  //           case 3:
  //               prev2.show();
  //               next2.hide();
  //               break;
  //           default: break;
  //       }
  //   }
  //
  //   // 이미지 및 인티케이터, nav 전환
  //   function startAnimation(index) {
  //     container2.css( {'transform' : "translateX("+ (-1255 * index) + "px )"} );
  //   }
  //
  //   //이전 버튼
  //   prev2.on("click", function(event){
  //       // if(currentIndex !== 0){
  //       //     currentIndex -= 1;
  //       // }else{
  //       //     currentIndex = 0;
  //       // }
  //       // startAnimation(currentIndex);
  //
  //   });
  //
  //   //다음 버튼
  //   next2.on("click", function(event){
  //       currentIndex2 += 1;
  //       startAnimation(currentIndex2);
  //   });
});
