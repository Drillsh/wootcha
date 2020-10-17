$(function () {
    const VIEW_PAGE = 5;
    const T_INDEX = 1;

    //이전, 다음 버튼
    var prev = $(".css-BackwardButton-left");
    var next = $(".css-ForwardButton-right");

    var result_count = $('#result_count').val();

    var totalIndex = Math.floor(result_count / VIEW_PAGE);

    var b_movie_index = 0;
    var b_review_index = 0;
    var r_review_index = 0;

    // 좌우 내비게이션 버튼 노출
    function stateNavigationButton(index, obj) {
        var parent = obj.parents('.css-ScrollBarContainer').find('.css-ScrollingTaim');
        var left_arrow = obj.parents('.css-ScrollBarContainer').find('.css-BackwardButton-left');
        var right_arrow = obj.parents('.css-ScrollBarContainer').find('.css-ForwardButton-right');

        switch (parent[0].classList[1]) {
            case 'best_movie':
            case 'best_review':
                if(index == 0){
                    left_arrow.hide();
                    right_arrow.show();
                }else if(index == T_INDEX){
                    left_arrow.show();
                    right_arrow.hide();
                }
                break;
            case 'recent_review':
                if(index == 0){
                    left_arrow.hide();
                    right_arrow.show();
                }else if(index == totalIndex){
                    left_arrow.show();
                    right_arrow.hide();
                }else {
                    left_arrow.show();
                    right_arrow.show();
                }
                break;
        }

    }
    
    // 이미지 전환
    function startAnimation(index, parent) {
        parent.css( {'transform' : "translateX("+ (-1255 * index) + "px )"} );
    }

    //이전 버튼
    prev.on("click", function(event){
        var parent = $(this).parents('.css-ScrollBarContainer').find('.css-ScrollingTaim');
        var index = 0;

        switch (parent[0].classList[1]) {
            case 'best_movie':
                if(b_movie_index !== 0){
                    b_movie_index -= 1;
                }
                index = b_movie_index;
                break;
            case 'best_review':
                if(b_review_index !== 0){
                    b_review_index -= 1;
                }
                index = b_review_index;
                break;
            case 'recent_review':
                if(r_review_index !== 0){
                    r_review_index -= 1;
                }
                index = r_review_index;
                break;
        }
        startAnimation(index, parent);
        stateNavigationButton(index, $(this));
    });

    //다음 버튼
    next.on("click", function(event){
        var parent = $(this).parents('.css-ScrollBarContainer').find('.css-ScrollingTaim');
        var index = 0;

        switch (parent[0].classList[1]) {
            case 'best_movie':
                if(b_movie_index !== T_INDEX){
                    b_movie_index += 1;
                }
                index = b_movie_index;
                break;
            case 'best_review':
                if(b_review_index !== T_INDEX){
                    b_review_index += 1;
                }
                index = b_review_index;
                break;
            case 'recent_review':
                if(r_review_index !== totalIndex){
                    r_review_index += 1;
                }
                index = r_review_index;
                break;
        }
        startAnimation(index, parent);
        stateNavigationButton(index, $(this));
    });
});
