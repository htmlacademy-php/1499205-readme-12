<?php

function text_limiter($text, $limit = 300) {
    $length = 0; //счетчик длины поста
    $content = "<a class='post-text__more-link' href='#'>Читать далее</a>"; // ссылка на полный текст
    $formatted_text = ''; // аккумулятор поста
    $pieces = explode(" " , $text);
    foreach ($pieces as $piece) {
        $length += mb_strlen($piece, "utf-8"); //накапливаем счетчик длины
        if ($length < $limit) {
            $formatted_text .= " " . $piece;
        } else {
            return $formatted_text . '...' . $content; //при превышении лимита возвращаем сокращенный пост
        }
    }
    return $formatted_text;
}

function date_count($cur_date, $posts) {
    
}
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
