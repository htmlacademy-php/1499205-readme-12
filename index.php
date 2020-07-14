<?php

include_once ('functions.php');
include_once ('variables.php');
include_once ('helpers.php');

date_default_timezone_set('Europe/Moscow');
$cur_date = date_format(date_create('now'), 'Y-m-d H:i:s');

for ($i = 0; $i < count($posts); $i++) {
    $posts[$i]['date'] = date_format(date_create(generate_random_date($i)), 'Y-m-d H:i:s');
    $cur_date_stamp = strtotime($cur_date);
    $post_date_stamp = strtotime($posts[$i]['date']);
    $diff = $cur_date_stamp - $post_date_stamp;

    if ($diff < 60) {
        $posts[$i]['date'] = 'только что';
    } else if ($diff > 60 && $diff < 3600) {
        $posts[$i]['date'] = floor($diff / 60) . ' минут назад';
    } else if ($diff > 3600 && $diff < 86400 ) {
        $posts[$i]['date'] = floor($diff / 3600) . ' часов назад';
    } else if ($diff > 86400 && $diff < 604800) {
        $posts[$i]['date'] = floor($diff / 86400) . ' дней назад';
    } else if ($diff > 604800 && $diff < 3024000) {
        $posts[$i]['date'] = floor($diff / 604800) . ' недель назад';
    } else if ($diff > 3024000) {
        $posts[$i]['date'] = floor($diff / 604800) . ' месяцев назад';
    }

}


$title = "Популярное";

$page_content = include_template("main.php", ['posts' => $posts]);

$layout_content = include_template("layout.php",
    ['page_content' => $page_content,
    'title' => $title,
    'is_auth' => $is_auth,
    'user_name' => $user_name]);

print($layout_content);
