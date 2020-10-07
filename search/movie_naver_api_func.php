<?php
/* url에서 movie부분만 바꾸면 여러가지 검색 가능함
블로그 검색 = "https://openapi.naver.com/v1/search/blog.json=".$encText;
뉴스 검색 = "https://openapi.naver.com/v1/search/news.json=".$encText;
책 검색 = "https://openapi.naver.com/v1/search/book.json=".$encText;
성인 검색어 판별 = "https://openapi.naver.com/v1/search/adult.json=".$encText;
백과사전 검색 = "https://openapi.naver.com/v1/search/encyc.json=".$encText;
영화 검색 = "https://openapi.naver.com/v1/search/movie.json=".$encText;
카페 검색 = "https://openapi.naver.com/v1/search/cafeatricle.json=".$encText;
지식인 검색 = "https://openapi.naver.com/v1/search/kin.json=".$encText;
지역 검색 = "https://openapi.naver.com/v1/search/local.json=".$encText;
오타변환 검색 = "https://openapi.naver.com/v1/search/errata.json=".$encText;
웹문서 검색 = "https://openapi.naver.com/v1/search/webkr.json=".$encText;
이미지 검색 = "https://openapi.naver.com/v1/search/image.json=".$encText;
쇼핑 검색 = "https://openapi.naver.com/v1/search/shop.json=".$encText;
전문자료 검색 = "https://openapi.naver.com/v1/search/doc.json=".$encText;

json 기반으로 작성됐으며 뒤에 .json을 .xml로 변경해주면 코드 그대로 변경사항 없이 사용가능하다.
*/

// 제목 검색으로 api에서 데이터 가져오는 함수
function search_movie_title($search, $country, $genre)
{
    // 한글깨짐 방지
    header("Content-Type: text/html; charset=UTF-8");
// 발급받은 클라이언트 아이디
    $client_id = "LJ1tkirwtG2udis4jmop";
// 발급받은 클라이언트 시크릿 값
    $client_secret = "jJeNAwWXja";

// 검색어 url 형식에 맞게 엔코딩
    $encTitle = urlencode($search);
    $encCountry = urlencode($country);
    $encGenre = urlencode($genre);

// JSON을 이용해서 검색
    $url = "https://openapi.naver.com/v1/search/movie.json?query=" . $encTitle."&country=".$encCountry."&genre=".$encGenre;

    $is_post = false;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, $is_post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $headers = array();
    $headers[] = "X-Naver-Client-Id: " . $client_id;
    $headers[] = "X-Naver-Client-Secret: " . $client_secret;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

// response 변수안에 검색결과 데이터가 json 방식의 문자열로 저장되어 있음 => 문자열을 배열로 변경하면 됨
    $response = curl_exec($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

// response 값을 배열로 변경
    $result = json_decode($response, TRUE);

    return $result;
}


// 영화 상세정보 가져오는 함수
function crawl_movie_detail($link)
{
// 웹 상에서 파일 가져올 수 있는 것을 막아논 것을 푸는 함수
    ini_set("allow_url_fopen", 1);

// 클롤링 라이브러리
    include $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/lib/simplehtmldom_1_9_1/simple_html_dom.php";

// html을 url상에서 가져올 수 있는 함수 simple_html_dom.php 여기에 정의되어 있는 함수임
    $data = file_get_html("$link");

// 영화 정보
    foreach ($data->find('div.mv_info > dl > dd:nth-child(2) > p > span') as $e) {
        $items[] = $e->plaintext;
    }

    //-------------------------------보완 필요
    $movie_info['genre'] = $items[0];
    $movie_info['nation'] = $items[1];
    $movie_info['running_time'] = $items[2];
    $movie_info['release_date'] = $items[3];


// 스토리
    foreach ($data->find('div.story_area') as $e) {
        $movie_stroy = $e->innertext;
    }

// 출연 배우
    foreach ($data->find('div.people > ul > li') as $e) {
        $movie_actor[] = $e->innertext;
    }

    $movie_detail = array('movie_info'=>$movie_info, 'movie_story'=>$movie_stroy, 'movie_actor'=>$movie_actor);

    return $movie_detail;
}
?>