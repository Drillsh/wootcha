window.onload = function(){
    // input text, textarea 등 태그
    var review_short = document.getElementsByClassName('review_short');
    // count 해주는 태그
    var counter = document.getElementById('counter');

    review_short[0].onkeyup = function(){
        var count = review_short[0].value;
        if (count.length > 40){
            review_short[0].value = review_short[0].value.substring(0, 39);
            counter.innerHTML = "(40 / 최대 40자) 최대 40자까지만 입력 가능합니다.";
            counter.style.color = "RED";
        }else{
            counter.innerHTML = "("+ count.length+" / 최대 40자)";
            counter.style.color = "GREEN";
        }
    }
}