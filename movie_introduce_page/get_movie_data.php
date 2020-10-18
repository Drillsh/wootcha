<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";

if (isset($_GET["item"])) {
    $item = $_GET['item'];
    $item = json_decode($item, true);

    $movie_info = new Movie_info();
    $movie_info->setMovieInfo($item, $con);
} elseif (isset($_GET["mv_num"])) {

    $movie_info = Movie_info::getMovieInfo_ByCode($_GET['mv_num'], $con);
}
$mv_code = $movie_info->movie_code;                 // 영화 코드
$title = $movie_info->title;                        // 영화 제목
$subtitle = $movie_info->subTitle;                  // 부제
$poster_img = $movie_info->poster_img;              // 포스터
$naver_star = $movie_info->naver_star;              // 네이버 평점
$naver_star = sprintf('%0.1f', $naver_star);        // 형식 수정
$naverLink = $movie_info->naver_link;               // 네이버 영화 링크

$genre = $movie_info->genre;                        // 장르
$nation = $movie_info->nation;                      // 국가
$running_time = $movie_info->running_time;          // 러닝타임
$release_date = $movie_info->release_date;          // 개봉일
$actor = $movie_info->actor;                        // 배우
$synopsis = $movie_info->synopsis;                  // 시놉시스
$stillcut = $movie_info->stillcut;                  // 스틸컷

?>