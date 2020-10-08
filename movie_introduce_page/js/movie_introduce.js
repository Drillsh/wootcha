    function good_click() {
    
    $(document).ready(function(){
            
 
            /*img1을 클릭했을 때 img2를 보여줌*/
            $("#favorite_movie").click(function(){
                $("#favorite_movie").hide();
                $("#img2").show();
            });
 
            /*img2를 클릭했을 때 img1을 보여줌*/
            $("#img2").click(function(){
                $("#favorite_movie").show();
                $("#img2").hide();
            });
        });
};