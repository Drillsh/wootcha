<?php
ini_set("allow_url_fopen", 1);
include $_SERVER["DOCUMENT_ROOT"]."/wootcha/common/crawling/simplehtmldom_1_9_1/simple_html_dom.php";

// 영화 코드 따기
//$link = 'https://movie.naver.com/movie/bi/mi/basic.nhn?code=195442';
//
//list(,$code) = explode('code=', $link);
//echo $code;

// 포스터 가져오기
//$data = file_get_html("https://movie.naver.com/movie/bi/mi/photoView.nhn?code=136900");
//$image = $data->find('#content > div.article > div.mv_info_area > div.poster > a > img');
//echo $image[0]->src;

// 스틸컷 가져오기
//$data = file_get_html("https://movie.naver.com/movie/bi/mi/photoView.nhn?code=195430");
//$image = $data->find('#photo_area > div > div.list_area._list_area > div > ul > li');
//
//foreach ($image as $item) {
//    $img = $item->attr['data-json'];
//    $img = json_decode($img);
//    $still_cut[] = $img->fullImageUrl665px;
//    echo "<img src={$img->fullImageUrl665px}>";
//}
