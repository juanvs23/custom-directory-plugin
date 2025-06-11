<?php

if(!function_exists('coltman_add_post_format')){

    function coltman_add_post_format(){
        remove_theme_support('post-formats');
        add_theme_support('post-formats',array('chat','audio','free'));
    }
    add_action ('after_setup_theme', 'coltman_add_post_format', 11);
}