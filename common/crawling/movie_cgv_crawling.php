<?php
    // 웹 상에서 파일 가져올 수 있는 것을 막아논 것을 푸는 함수 
    ini_set("allow_url_fopen", 1);

    // 클롤링 라이브러리
    include $_SERVER["DOCUMENT_ROOT"]."/wootcha/common/crawling/simplehtmldom_1_9_1/simple_html_dom.php";
    // $search_text = "비긴어게인";
    // html을 url상에서 가져올 수 있는 함수 simple_html_dom.php 여기에 정의되어 있는 함수임
    // $data = file_get_html("http://www.cgv.co.kr/search/?query=".$search_text);

    // 이런 형식으로 크롤링 하고 싶은 내용을 적으면 가져옴
    // ->의 의미는 객체 내부로 접근한다는 의미인듯, 즉 find()는 data안에 들어있는 객체의 멤버 함수인듯
    // $a = $data->find('div.box-image>a');

    // a를 print_r로 확인하면 아래와 같은 구조, 즉 객에 안에 attr이라는 속성 값 안에 배열이 있고, 그 속에 이미지 주소가 있음
    // simple_html_dom_node Object ( 
    //     [nodetype] => 1 
    //     [tag] => a 
    //     [attr] => Array ( [href] => http://img.cgv.co.kr/Movie/Thumbnail/Poster/000069/69600/69600_1000.jpg
    
    // 객체에 접근할 때는 ->를 하면 되고, 배열의 인덱스로 접근할 때는 []를 사용함
    // $anchor = $a[0]->attr;

    // attr 속성에 들어있는 배열값의 href 인덱스로 접근함
    // 출력 결과 : http://img.cgv.co.kr/Movie/Thumbnail/Poster/000069/69600/69600_1000.jpg
    // $img_link = $anchor['href'];
    // echo $img_link;
    
    // // img 태그를 만들어서 추출한 정보를 src로 사용
    // echo "<img src='$img_link' alt=''>";
    
    // 고화질 이미지 url
    function get_cgv_movie_Big_poster_url($movie_name){
        $data = file_get_html("http://www.cgv.co.kr/search/?query=".$movie_name);
        $a = $data->find('div.box-image>a');
        $anchor = $a[0]->attr;
        $img_link = $anchor['href'];
        return $img_link;
    }

    // 중간화질 이미지 url
    function get_cgv_movie_middle_poster_url($movie_name){
        $data = file_get_html("http://www.cgv.co.kr/search/movie.aspx?query=".$movie_name);
        $a = $data->find('span.thumb-image>img');
        $anchor = $a[0]->attr;
        $img_link = $anchor['src'];
        return $img_link;
    }
    
    // 개봉일
    function get_movie_release_date($movie_name){
        $data = file_get_html("http://www.cgv.co.kr/search/movie.aspx?query=".$movie_name);
        $a = $data->find('div.box-contents>a');
        $anchor = $a[0]->attr;
        $img_link = $anchor['href'];
        $data = file_get_html("http://www.cgv.co.kr/$img_link");
        $a = $data->find('div.spec>dl>dd.on');
        print_r($val = $a[2]->nodes[0]->parent);
        // $anchor = $a[0]->attr;
        // $img_link = $anchor['src'];
        return $val;
    }
    
        // simple_html_dom_node Object ( 
        //         [nodetype] => 3 
        //         [tag] => text 
        //         [attr] => Array ( ) 
        //         [children] => Array ( ) 
        //         [nodes] => Array ( ) 
        //         [parent] => simple_html_dom_node Object *RECURSION* [_] => Array ( [4] => 2020.07.22(재개봉) )

        // simple_html_dom_node Object ( 
        //     [nodetype] => 1 
        //     [tag] => dd 
        //     [attr] => Array ( [class] => on ) 
        //     [children] => Array ( ) 
        //     [nodes] => Array ( 
        //         [0] => simple_html_dom_node Object ( 
        //             [nodetype] => 3 
        //             [tag] => text 
        //             [attr] => Array ( ) 
        //             [children] => Array ( ) 
        //             [nodes] => Array ( ) 
        //             [parent] => simple_html_dom_node Object *RECURSION* [_] => Array ( [4] => 2020.07.22(재개봉) )
    // echo get_movie_release_date("알라딘");



?> 