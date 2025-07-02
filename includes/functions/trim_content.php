<?php

if (!function_exists('coltman_trim_by_chars_fn')) {
    
    function coltman_trim_by_chars_fn($content, $length = 250) {
        # que corte en base a caracteres y no a palabras
        $content = strip_tags($content);
        if (mb_strlen($content) > $length) {
            $content = mb_substr($content, 0, $length) . '...';
        }
        return $content;
    }
}