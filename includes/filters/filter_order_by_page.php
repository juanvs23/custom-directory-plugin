<?php

if(!function_exists('filter_order_by_page')){
    
    function filter_order_by_page($query) {
        if (is_admin() || !$query->get('post_type') === 'coltman_addic_clinic') {
            return;
        }
        if (!is_admin() && $query->get('post_type') === 'coltman_addic_clinic' && $query->have_posts()) {
          //  echo '<h1>Hola mundo</h1>';
        }
    }
    add_action('pre_get_posts', 'filter_order_by_page');
}