<?php

// Функция ограничения длины поста

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

// Функция расчета относительной даты

function count_post_age($post, $i) {
    $cur_date = date_format(date_create('now'), 'Y-m-d H:i:s'); //текущая дата и время
    $post['date'] = date_format(date_create(generate_random_date($i)), 'Y-m-d H:i:s');
    $cur_date_stamp = strtotime($cur_date);
    $post_date_stamp = strtotime($post['date']);
    $diff = $cur_date_stamp - $post_date_stamp;

    if ($diff < 60) {
        $post['date'] = 'только что';
    } else if ($diff >= 60 && $diff < 3600) {
        $date = intval(floor($diff / 60));
        $post['date'] = $date . ' ' . get_noun_plural_form($date, 'минута', 'минуты', 'минут') . ' назад';
    } else if ($diff >= 3600 && $diff < 86400 ) {
        $date = intval(floor($diff / 3600));
        $post['date'] = $date . ' ' . get_noun_plural_form($date, 'час', 'часа', 'часов') . ' назад';
    } else if ($diff >= 86400 && $diff < 604800) {
        $date = intval(floor($diff / 86400));
        $post['date'] = $date . ' ' . get_noun_plural_form($date, 'день', 'дня', 'дней') . ' назад';
    } else if ($diff >= 604800 && $diff < 3024000) {
        $date = intval(floor($diff / 604800));
        $post['date'] = $date . ' ' . get_noun_plural_form($date, 'неделя', 'недели', 'недель') . ' назад';
    } else if ($diff >= 3024000) {
        $date = intval(floor($diff / 3024000));
        $post['date'] = $date . ' ' . get_noun_plural_form($date, 'месяц', 'месяца', 'месяцев') . ' назад';
    }
    return $post['date'];
}

// функция расчета даты в заданном формате

function post_formatted_date($i) {
    return date_format(date_create(generate_random_date($i)), 'd-m-y H:i');
}

// функция показа даты без изменений

function post_original_date($i) {
    return generate_random_date($i);
}
