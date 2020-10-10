<?php
// 영화정보 클래스
class Movie_info
{
    public $title;              //제목
    public $subTitle;           //영제
    public $small_poster_img;         //포스터 경로
    public $naver_star;        //네이버 별점
    public $naver_link;         //네이버 영화 페이지 링크

    public $genre;              //장르
    public $nation;             //국가
    public $running_time;       //러닝타임
    public $release_date;       //개봉일
    public $synopsis;           //시놉시스
    public $actor;              //출연배우

    // 생성자
    public function __construct()
    {
//        $data = $this->crawl_movie_detail($this->naver_link);
//
//        $this->genre = $data['movie_info']['genre'];
//        $this->nation = $data['movie_info']['nation'];
//        $this->running_time = $data['movie_info']['running_time'];
//        $this->release_date = $data['movie_info']['release_date'];
//
//        $this->synopsis = $data['movie_story'];
//        $this->actor = $data['movie_actor'];
    }

    // 생성자 대신 인스턴스
    public static function create(){
        $instance = new self();
        return $instance;
    }

    // 검색-선택영화로 정보 세팅
    public function setMovie_API_Info($selected_movie){
        $this->title = $selected_movie['title'];
        $this->subTitle = $selected_movie['subtitle'];
        $this->small_poster_img = $selected_movie['image'];
        $this->naver_star = $selected_movie['userRating'];
        $this->naver_link = $selected_movie['link'];
    }

    public function setMovie_crawling($movie_code){

    }

// --------------제목 검색으로 api에서 데이터 가져오는 함수---------------
// 동명 영화 다가져옴
    public static function search_movie_title($search, $country, $genre)
    {
// 발급받은 클라이언트 아이디
        $client_id = "LJ1tkirwtG2udis4jmop";
// 발급받은 클라이언트 시크릿 값
        $client_secret = "jJeNAwWXja";

// 검색어 url 형식에 맞게 엔코딩
        $encTitle = urlencode($search);
        $encCountry = urlencode($country);
        $encGenre = urlencode($genre);

// JSON을 이용해서 검색
        $url = "https://openapi.naver.com/v1/search/movie.json?query=" . $encTitle . "&country=" . $encCountry . "&genre=" . $encGenre . "&display=100";

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

        return $result['items'];
    }


    //------------ 영화 상세정보 가져오는 함수------------------
    public function crawl_movie_detail($link)
    {
// 웹 상에서 파일 가져올 수 있는 것을 막아논 것을 푸는 함수
        ini_set("allow_url_fopen", 1);

// 클롤링 라이브러리
        include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/lib/simplehtmldom_1_9_1/simple_html_dom.php";

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

        // 한곳에 담아 리턴
        $movie_detail = array('movie_info' => $movie_info, 'movie_story' => $movie_stroy,
            'movie_actor' => $movie_actor);

        return $movie_detail;
    }
}