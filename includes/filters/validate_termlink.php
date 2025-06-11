<?php

if(!function_exists('validate_custom_taxonomy_term')){
    add_filter('term_link', 'validate_custom_taxonomy_term', 10, 3);
function validate_custom_taxonomy_term($url, $term, $taxonomy) {
         
        // Verificar si el término realmente existe
        $actual_term = get_term_by('slug', $term->slug, $taxonomy);
        if (!$actual_term || is_wp_error($actual_term)) {
            return home_url(); // Redirige a home si no existe
       
    }
    return $url;
}
}

add_action('template_redirect', 'redirect_wrong_taxonomy_urls');
function redirect_wrong_taxonomy_urls() {
    foreach(ADDIC_CLINIC_FILTERS as $tax) {
        if (is_tax($tax)) { // Reemplaza 'tu_taxonomia' con tu taxonomía
            $term = get_queried_object();
            //var_dump($term);
            if ($term->parent != 0) {
                $correct_url = get_term_link($term);

                $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                
                if ($correct_url !== $current_url) {
                    wp_redirect($correct_url, 301);
                    exit;
                }
            }
        }
    }
}