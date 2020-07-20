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
    $post['date'] = generate_random_date($i);
    $diff = time() - strtotime($post['date']);

    if ($diff < MINUTE_STAMP) {
        $post['date'] = 'только что';
    } else if ($diff >= MINUTE_STAMP && $diff < HOUR_STAMP) {
        $date = intval(floor($diff / MINUTE_STAMP));
        $post['date'] = $date . ' ' . get_noun_plural_form($date, 'минута', 'минуты', 'минут') . ' назад';
    } else if ($diff >= HOUR_STAMP && $diff < DAY_STAMP ) {
        $date = intval(floor($diff / HOUR_STAMP));
        $post['date'] = $date . ' ' . get_noun_plural_form($date, 'час', 'часа', 'часов') . ' назад';
    } else if ($diff >= DAY_STAMP && $diff < WEEK_STAMP) {
        $date = intval(floor($diff / DAY_STAMP));
        $post['date'] = $date . ' ' . get_noun_plural_form($date, 'день', 'дня', 'дней') . ' назад';
    } else if ($diff >= WEEK_STAMP && $diff < MONTH_STAMP) {
        $date = intval(floor($diff / WEEK_STAMP));
        $post['date'] = $date . ' ' . get_noun_plural_form($date, 'неделя', 'недели', 'недель') . ' назад';
    } else if ($diff >= MONTH_STAMP) {
        $date = intval(floor($diff / MONTH_STAMP));
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
