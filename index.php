<?php

include_once ('functions.php');
include_once ('variables.php');
include_once ('helpers.php');

date_default_timezone_set('Europe/Moscow');

$title = "Популярное";

$page_content = include_template("main.php", [
    'posts' => $posts,
    ]
);

$layout_content = include_template("layout.php",
    ['page_content' => $page_content,
    'title' => $title,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    ]
);

print($layout_content);
