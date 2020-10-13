    var cnt = 1;
    
    function imgToggle() {
    var img1 = document.getElementById("img1");
    var img2= document.getElementById("img2");
    if(cnt%2==1){
        img1.src="./img/good_after.png";
        img2.src="./img/good_before.png";
    } else {
        img1.src="./img/good_before.png";
        img2.src="./img/good_after.png";
    }
    
    cnt++;

}

