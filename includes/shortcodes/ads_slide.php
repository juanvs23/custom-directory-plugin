<?php

if(!function_exists('ads_slide_fn')){
    function ads_slide_fn(){
        ob_start();
        echo coltman_get_template_slug_part('components/ads','slider');
        return ob_get_clean();
    }
    add_shortcode('ads_slide', 'ads_slide_fn');
}