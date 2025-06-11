<?php

if(!function_exists('get_template_rating_badget')){
    function get_template_rating_badget($rating,$url,$extra_class){
        $index = get_the_ID();
        $get_google_place_id = get_post_meta($index, 'google_place_id', true);
        $user_ratings_total = get_post_meta($index, 'user_ratings_total', true);
        $html = '';
        if($user_ratings_total=='' || $user_ratings_total == 0){
            return $html;
        }
        $html .= '<div data-post="'.$index.'" class="rating-badget '.$extra_class.'">';
        $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">';
        $html .= '<path d="M5.825 21L7.45 13.975L2 9.25L9.2 8.625L12 2L14.8 8.625L22 9.25L16.55 13.975L18.175 21L12 17.275L5.825 21Z" fill="white"/>';
        $html .= '</svg>';
        $html .= ' <span class="rating">'.$rating.' '.'('.$user_ratings_total.')'.'</span>';
        if(isset($get_google_place_id) && $get_google_place_id != ''):
        $html .= '<div class="terms-lists-toolip">';
        $html .= '<p class="terms-lists-toolip-content">';
        $html .= 'The ratings for the centers are directly reflected from Google reviews.';
        $html .='</p>';
        $html .= '<div class="terms-lists-toolip-link">';
        $html .= '<a href="'.$url.'#google-review-section">';
        $html .= 'View More';
        $html .= '</a></div></div>';
        endif;
        $html .= '</div>';

        return $html;
    }
};