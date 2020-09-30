<?php
include_once "./common/database/db_connector.php";
include_once "./common/database/create_table.php";

create_table($con, "user");
create_table($con, "movie");
create_table($con, "fav_movie");
create_table($con, "comment");
create_table($con, "comment_reply");
create_table($con, "qna_board");
create_table($con, "qna_reply");
create_table($con, "notice_board");
create_table($con, "faq_board");

echo "it works!";