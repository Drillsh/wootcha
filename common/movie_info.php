<?php

// 영화정보 클래스
// 클롤링 라이브러리
include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/lib/simplehtmldom_1_9_1/simple_html_dom.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/wootcha/common/database/db_connector.php";

class Movie_info
{
    public $title;              //제목
    public $subTitle;           //영제
    public $poster_img;   //포스터 경로
    public $naver_star;         //네이버 별점
    public $naver_link;         //네이버 영화 페이지 링크

    public $movie_code;         //영화 코드
    public $genre;              //장르
    public $nation;             //국가
    public $running_time;       //러닝타임
    public $release_date;       //개봉일
    public $synopsis;           //시놉시스
    public $actor;              //출연배우

    // 생성자
    public function __construct($selected_movie, $con)
    {
        $this->naver_link = $selected_movie['link'];
        $this->movie_code = $this->explode_code($this->naver_link);

        // DB에 존재하는지 체크
        if ($this->check_exist_movie($this->movie_code, $con)) {
            $sql = "SELECT * FROM `movie` WHERE mv_num= {$this->movie_code}";
            $res = mysqli_query($con, $sql) or die("Select movie Error: " . mysqli_error($con));
            $row = mysqli_fetch_array($res);

            $this->title = $row['mv_title'];
            $this->poster_img = $row['mv_img_path'];
            $this->genre = $row['mv_genre'];
            $this->nation = $row['mv_nation'];
            $this->running_time = $row['mv_running_time'];
            $this->release_date = $row['mv_release_date'];

        } else {
            $this->title = str_replace("<b>", "", $selected_movie['title']);            //태그제거
            $this->title = str_replace("</b>", "", $this->title);

            // 네이버 영화 크롤링
            $data = $this->crawl_movie_detail($this->naver_link);

            $this->poster_img = $data['poster_img'];
            $this->genre = $this->trim_array($data['movie_info']['genre']);
            $this->nation = $this->trim_array($data['movie_info']['nation']);
            $this->running_time = $this->trim_array($data['movie_info']['running_time']);
            $this->release_date = str_replace(" ", "",$data['movie_info']['release_date']);    //공백제거

            $sql = "INSERT INTO `movie`(mv_num, mv_title, mv_img_path, mv_genre, mv_nation, mv_release_date, mv_running_time) 
                VALUES({$this->movie_code}, '{$this->title}', '{$this->poster_img}', '{$this->genre}', '{$this->nation}', '{$this->release_date}', '{$this->running_time}');";
            mysqli_query($con, $sql) or die("Movie Insert Error: " . mysqli_error($con));
        }

        // 네이버 영화 크롤링
        $data = $this->crawl_movie_detail($this->naver_link);

        $this->subTitle = $selected_movie['subtitle'];
        $this->naver_star = $selected_movie['userRating'];
        $this->synopsis = $data['movie_story'];
        $this->actor = $data['movie_actor'];
    }
    //DB에 저장돼있는지 체크
    public function check_exist_movie($movie_code, $con)
    {
        $sql = "select exists(select mv_num from movie where mv_num = {$movie_code}) as exist";

        $res = mysqli_query($con, $sql);

        $row = mysqli_fetch_array($res);

        //없다면 insert
        if ($row['exist'] == 0) {
            return false;
        }

        return true;
    }

    // 영화 코드 따기
    public function explode_code($link)
    {
        list(, $code) = explode('code=', $link);
        return $code;
    }

    // 공백제거
    function trim_array($text)
    {
        $text = explode(",", $text);

        for ($i = 0; $i < count($text); ++$i) {
            $text[$i] = trim($text[$i]);
        }

        return implode(",", $text);
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
            $movie_story = $e->innertext;
        }

        // 출연 배우
        foreach ($data->find('div.people > ul > li') as $e) {
            $movie_actor[] = $e->innertext;
        }

        $res = $data->find('#content > div.article > div.mv_info_area > div.poster > a > img');
        $poster_img = $res[0]->src;

        // 한곳에 담아 리턴
        $movie_detail = array('movie_info' => $movie_info, 'movie_story' => $movie_story,
            'movie_actor' => $movie_actor, 'poster_img' => $poster_img);

        return $movie_detail;
    }
}
