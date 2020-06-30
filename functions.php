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

