<?php
    // 웹 상에서 파일 가져올 수 있는 것을 막아논 것을 푸는 함수 
    ini_set("allow_url_fopen", 1);

    // 클롤링 라이브러리
    include "./simplehtmldom_1_9_1/simple_html_dom.php";
    $search_text = "대부";
    // html을 url상에서 가져올 수 있는 함수 simple_html_dom.php 여기에 정의되어 있는 함수임
    $data = file_get_html("http://www.cgv.co.kr/search/?query=".$search_text);

    // 이런 형식으로 크롤링 하고 싶은 내용을 적으면 가져옴
    $a = $data->find('div.box-image>a');
    // $img = $a[0]->find('img');
    // div 안에 있는 box-image 클래스를 사용하는 것이 여러개 있을 경우 배열로 넘어옴
    // 0번이 내가 가져오려던 큰 이미지
    // echo $a[0];
    // echo "<img src='$img[0]' alt=''>";
    // echo $a[0];
    // print_r($a[0]);

     echo $aa = preg_replace('/<a href="([^"]+)">.+/', '$1',$a[0]);

    


    // simple_html_dom_node Object ( 
    //     [nodetype] => 1 
    //     [tag] => a 
    //     [attr] => Array ( [href] => http://img.cgv.co.kr/Movie/Thumbnail/Poster/000069/69600/69600_1000.jpg

    



?> 