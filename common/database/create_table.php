<?php
// 테이블 만드는 함수
function create_table($con, $table_name)
{
    $sql = "show tables from wootchadb;";
    $result = mysqli_query($con, $sql) or die("show tables Error" . mysqli_error($con));
    $flag = false;

    while ($row = mysqli_fetch_row($result)) {
        if ($row[0] === "$table_name") {
            $flag = true;
            break;
        }
    }

    if ($flag === false) {
        switch ($table_name) {
            case 'user':
                $sql = "CREATE TABLE user(
                        `user_num`         INT            NOT NULL    AUTO_INCREMENT COMMENT '등록 번호', 
                        `user_mail`        VARCHAR(45)    NOT NULL    COMMENT '이메일', 
                        `password`         VARCHAR(45)    NOT NULL    COMMENT '패스워드', 
                        `user_name`        VARCHAR(45)    NOT NULL    COMMENT '이름', 
                        `user_nickname`    VARCHAR(45)    NOT NULL    COMMENT '닉네임', 
                        `user_img`         VARCHAR(45)    NOT NULL    COMMENT '프로필 이미지', 
                        `user_age`         INT            NULL        DEFAULT 0 COMMENT '나이', 
                        `user_gender`      INT(1)         NULL        DEFAULT 0 COMMENT '성별', 
                        `user_phone`       VARCHAR(45)    NULL        DEFAULT null COMMENT '전화번호', 
                        `user_signup_day`  VARCHAR(45)    NULL        DEFAULT null COMMENT '가입날짜', 
                        PRIMARY KEY (user_num)
                    )ENGINE = InnoDB DEFAULT CHARSET = utf8;";
                break;

            case 'movie':
                $sql = "CREATE TABLE `movie` (
                         `mv_num`       INT            NOT NULL    AUTO_INCREMENT   COMMENT '영화 등록번호', 
                         `mv_title`     VARCHAR(45)    NOT NULL                     COMMENT '제목', 
                         `mv_rating`    FLOAT(2,1)     NULL                         COMMENT '영화 별점', 
                         `mv_img_path`  VARCHAR(100)   NULL        DEFAULT null     COMMENT '이미지 경로', 
                         PRIMARY KEY (mv_num)
                        ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8";
                break;

            case 'fav_movie' :
                $sql = "CREATE TABLE `fav_movie` (
                        `fav_num`   INT    NOT NULL    AUTO_INCREMENT COMMENT '번호', 
                        `user_num`  INT    NOT NULL    COMMENT '작성자', 
                        `mv_num`    INT    NOT NULL    COMMENT '영화 등록번호', 
                        PRIMARY KEY (fav_num)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;

            case 'review':
                $sql = "CREATE TABLE `review` (
                         `review_num`      INT            NOT NULL    AUTO_INCREMENT COMMENT '리뷰 등록번호', 
                         `user_num`        INT            NOT NULL    COMMENT '작성자', 
                         `mv_num`          INT            NOT NULL    COMMENT '영화 등록번호', 
                         `review_rating`   FLOAT(2,1)     NOT NULL    COMMENT '별점', 
                         `review_short`    VARCHAR(45)    NOT NULL    COMMENT '한줄평', 
                         `review_long`     TEXT           NULL        DEFAULT null COMMENT '장문 리뷰', 
                         `review_like`     INT            NULL        DEFAULT 0 COMMENT '좋아요', 
                         `review_hit`      INT            NOT NULL    COMMENT '조회수', 
                         `review_regtime`  VARCHAR(45)    NOT NULL    COMMENT '등록 시간', 
                         PRIMARY KEY (review_num)
                        ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8";
                break;

            case 'review_reply' :
                $sql = "CREATE TABLE `review_reply` (
                         `review_reply_num`       INT             NOT NULL    AUTO_INCREMENT COMMENT '댓글 등록번호', 
                         `review_num`             INT             NOT NULL    COMMENT '리뷰 등록번호', 
                         `user_num`               INT             NOT NULL    COMMENT '작성자', 
                         `review_reply_contents`  VARCHAR(200)    NOT NULL    COMMENT '댓글 내용', 
                         `review_reply_regtime`   VARCHAR(45)     NOT NULL    COMMENT '등록 시간', 
                         PRIMARY KEY (review_reply_num)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;

            case 'qna_board' :
                $sql = "CREATE TABLE `qna_board` (
                         `qna_num`          INT            NOT NULL    AUTO_INCREMENT COMMENT '등록 번호', 
                         `user_num`         INT            NOT NULL    COMMENT '작성자', 
                         `qna_title`        VARCHAR(45)    NOT NULL    COMMENT '제목', 
                         `qna_contents`     TEXT           NOT NULL    COMMENT '내용', 
                         `qna_hit`          INT            NOT NULL    COMMENT '조회수', 
                         `qna_regtime`      VARCHAR(45)    NOT NULL    COMMENT '등록 시간', 
                         `qna_file_name`    VARCHAR(45)    NULL        DEFAULT null COMMENT '파일이름', 
                         `qna_file_copied`  VARCHAR(45)    NULL        DEFAULT null COMMENT '파일카피', 
                         `qna_file_type`    VARCHAR(45)    NULL        DEFAULT null COMMENT '파일타입', 
                         PRIMARY KEY (qna_num)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;

            case 'qna_reply' :
                $sql = "CREATE TABLE `qna_reply` (
                         `qna_reply_num`        INT             NOT NULL    AUTO_INCREMENT COMMENT '댓글 등록번호', 
                         `user_num`             INT             NOT NULL    COMMENT '작성자', 
                         `qna_num`              INT             NOT NULL    COMMENT '게시글 등록번호', 
                         `qna_reply_contnents`  VARCHAR(200)    NOT NULL    COMMENT '댓글 내용', 
                         `qna_reply_regtime`    VARCHAR(45)     NOT NULL    COMMENT '등록 시간', 
                         PRIMARY KEY (qna_reply_num)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;

            case 'notice_board' :
                $sql = "CREATE TABLE `notice_board` (
                        `notice_num`          INT             NOT NULL    AUTO_INCREMENT COMMENT '공지 등록번호', 
                        `notice_title`        VARCHAR(100)    NOT NULL    COMMENT '제목', 
                        `notice_contents`     TEXT            NOT NULL    COMMENT '내용', 
                        `notice_hit`          INT             NOT NULL    COMMENT '조회수', 
                        `notice_regtime`      VARCHAR(45)     NOT NULL    COMMENT '등록 시간', 
                        `notice_file_name`    VARCHAR(45)     NULL        DEFAULT null COMMENT '파일이름', 
                        `notice_file_copied`  VARCHAR(45)     NULL        DEFAULT null COMMENT '파일카피', 
                        `notice_file_type`    VARCHAR(45)     NULL        DEFAULT null COMMENT '파일타입', 
                        PRIMARY KEY (notice_num)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;

            case 'faq_board' :
                $sql = "CREATE TABLE `faq_board` (
                         `faq_num`          INT             NOT NULL    AUTO_INCREMENT COMMENT 'FAQ 등록번호', 
                         `faq_title`        VARCHAR(100)    NOT NULL    COMMENT '제목', 
                         `faq_contents`     TEXT            NOT NULL    COMMENT '내용', 
                         `faq_hit`          INT             NOT NULL    COMMENT '조회수', 
                         `faq_regtime`      VARCHAR(45)     NOT NULL    COMMENT '등록 시간', 
                         `faq_file_name`    VARCHAR(45)     NULL        DEFAULT null COMMENT '파일이름', 
                         `faq_file_copied`  VARCHAR(45)     NULL        DEFAULT null COMMENT '파일카피', 
                         `faq_file_type`    VARCHAR(45)     NULL        DEFAULT null COMMENT '파일타입', 
                         PRIMARY KEY (faq_num)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;
                
            case 'review_like' :
                $sql = "CREATE TABLE `review_like` (
                        `review_num`        int(11)         NOT NULL    COMMENT '좋아요를 누른 리뷰 등록번호',
                        `user_num`          int(11)         NOT NULL    COMMENT '좋아요를 누른 유저 번호',
                        `like_state`        int(11)         NOT NULL    COMMENT '좋아요 상태 0 또는 1'
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                    break;
            default:
                echo "<script>alert('해당 테이블명이 없습니다. 점검요청');</script>";
        }
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('{$table_name}테이블이 생성되었습니다.');</script>";
        } else {
            echo "테이블 생성 실패원인" . mysqli_error($con);
        }
    }
}