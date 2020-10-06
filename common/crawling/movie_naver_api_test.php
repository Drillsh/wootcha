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



// 한글깨짐 방지
header("Content-Type: text/html; charset=UTF-8");
// 발급받은 클라이언트 아이디
$client_id = "LJ1tkirwtG2udis4jmop";
// 발급받은 클라이언트 시크릿 값
$client_secret = "jJeNAwWXja";
// 검색어 url 형식에 맞게 엔코딩
$encText = urlencode("어벤져스");
// JSON을 이용해서 검색
$url = "https://openapi.naver.com/v1/search/movie.json?query=".$encText;

$is_post = false; 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_POST, $is_post); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$headers = array(); 
$headers[] = "X-Naver-Client-Id: ".$client_id; 
$headers[] = "X-Naver-Client-Secret: ".$client_secret; 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 

// response 변수안에 검색결과 데이터가 json 방식의 문자열로 저장되어 있음 => 문자열을 배열로 변경하면 됨
$response = curl_exec ($ch); 
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
curl_close ($ch);

$json_string = $response; 

// 다차원 배열 반복처리
$R = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($json_string, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);
// $R : array data
// json_decode : JSON 문자열을 PHP 배열로 바꾼다
// json_decode 함수의 두번째 인자를 true 로 설정하면 무조건 array로 변환된다.

foreach ($R as $key => $val) {
    if(is_array($val)) { // val 이 배열이면
        echo "$key:<br/>";
        

        //echo $key.' (key), value : (array)<br />';
    } else { // 배열이 아니면
        echo "$key => $val <br/>";
        if($key == 'image'){
            $img = $val;
            echo "<img src='$img' alt=''><br/>";
        }
    }
}
// 크롤링을 왜 하는지 알겠다. 네이버 api 화질이 구리다. 앱에서는 작으니까 별 문제를 못느끼겠지만 웹은 화면이 크니까..
// 그리고 네이버 api의 평점은 10점 만점으로 구성되어 있음
// 넘어오는 값은
// items:
// 1. 인덱스
// 2. 제목
// 3. link
// 4. image url
// 5. 부제목 : 영어제목?
// 6. 감독
// 7. 배우
// 8. 별점
// 총 이렇게 8개 정보가 넘어옴

// *****
// 예시
// *****

// 0:
// title => 어벤져스: 엔드게임
// link => https://movie.naver.com/movie/bi/mi/basic.nhn?code=136900
// image => https://ssl.pstatic.net/imgmovie/mdi/mit110/1369/136900_P57_104126.jpg
// subtitle => Avengers: Endgame
// pubDate => 2019
// director => 안소니 루소|조 루소|
// actor => 로버트 다우니 주니어|크리스 에반스|크리스 헴스워스|마크 러팔로|스칼렛 요한슨|제레미 레너|돈 치들|폴 러드|브리 라슨|카렌 길런|브래들리 쿠퍼|조슈 브롤린|
// userRating => 9.38
?>