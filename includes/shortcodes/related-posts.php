<?php

if(!function_exists('coltman_related_posts_fn')){
    function coltman_related_posts_fn($atts){
        $atts = shortcode_atts(array(
        ),$atts,'coltman_related_posts');
        ob_start();
        echo '<div class="shortcode-item">';
        echo coltman_get_template_slug_part('loops/related','posts'); 
        echo '</div>';
        return ob_get_clean();
    }
    add_shortcode('coltman_related_posts', 'coltman_related_posts_fn');
}