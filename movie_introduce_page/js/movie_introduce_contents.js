$(function () {
    // 객체참조변수선언
    var container = $(".slideShow");
    var slideGroup = container.find(".slideShow_slides");
    var slides = slideGroup.find("a");
    var slideCount = slides.length; //배열길이: 4개
    var nav = container.find(".slideShow_nav");
    var prev = nav.find(".prev");
    var next = nav.find(".next");
    var indicator = container.find(".slideShow_indicator");
    var aIndicator = indicator.find("a");
    var aIndicatorCount = aIndicator.length; //배열길이 4개
    var currentIndex = -1;
    var setIntervalObject;
  
    // 1. 슬라이드를 자동으로 움직이는 기능을 구현하겠다.
    //    이미지를 가로로 배치시켜야한다.
    // for(var index =0; index<slides.length; index++){
    //   var indexLeft = index*100+"%";
    //   slides.eq(index).css("left", indexLeft);
    // }
    slides.each(function (i) {
      var indexLeft = i * 100 + "%";
      $(this).css({ left : indexLeft });
    });
  
    //  자동으로 애니메이션으로 보이는 방법구현
    function gotoSlide(index) {
      // 애니메이션주는방법 객체.animate(구현내용, 걸리는시간, 보여주는방법)
      // 구현내용 : left : 0%, -100%, -200%, -300%
      // 걸리는시간 : 1초를 진행하고
      // 보여주는방법 : 한칸씩.. 움직이는데. 절도있게 움직인다
      slideGroup.animate({ left: -100 * index + '%' }, 500, 'swing');
      // index : 0번일때 왼쪽은 안보이고 ,오른쪽은 보이고
      // index : 3번일때 왼쪽은 보이고, 오른쪽은 안보이고
      indexDisplay(index);
    }
  
    function indexDisplay(index) {
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
  
        default:
          break;
      }
      // indicator를 배경화면을 셋팅한다.
      aIndicator.removeClass('active');
      aIndicator.eq(index).addClass('active');
    }
  
    function startTimer() {
      setIntervalObject = setInterval(function () {
        var nextIndex = (currentIndex + 1) % slideCount;
        currentIndex = nextIndex;
        gotoSlide(nextIndex)
      }, 2500);
    }
  
    function stopTimer() {
      clearInterval(setIntervalObject);
    }
  
    //=====마우스 올렸을때 이벤트======
    container.mouseenter(function () {
      stopTimer();
    });
  
    container.mouseleave(function () {
      startTimer();
    });
  
    //======이전 다음 버튼 이벤트======
    prev.on("click", function (e) {
      // e.preventDefault(); 원래 anker 기능을 하지못하도록 막는다.
      if (currentIndex !== 0) {
        currentIndex -= 1;
      } else {
        currentIndex = 0;
      }
      gotoSlide(currentIndex);
    });
  
    next.on("click", function (e) {
      if (currentIndex !== slideCount - 1) {
        currentIndex += 1;
      } else {
        currentIndex = slideCount - 1;
      }
      gotoSlide(currentIndex);
    });
  
    aIndicator.on("click", function (e) {
      // e.preventDefault();
      var index = $(this).index();
      gotoSlide(index);
    });
  
    // 맨처음진행시 초기화시킨 함수
    startTimer();
    indexDisplay(0);
  
  });