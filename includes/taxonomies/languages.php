<?php
if( class_exists( 'ColtmanRegisterTaxonomy' ) && ! function_exists( 'coltman_add_languages_taxonomy' ) ){
    function coltman_add_languages_taxonomy(){
        new ColtmanRegisterTaxonomy(
            [
                'plural_name' => __('Languages', 'addic-clinic-directory'),
                'singular_name' => __('Language', 'addic-clinic-directory'),
                'item' => __('language', 'addic-clinic-directory'),
                'text_domain' => 'addic-clinic-directory',
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud' => true,
                'show_in_rest' => true,
                'has_archive' => true,
                'rest_base' => 'languages',
            ],
            'coltman_languages',
            [
                'coltman_addic_clinic'
            ],
            false
        );
    }
}
if ( function_exists( 'coltman_add_languages_taxonomy' ) ) {
    coltman_add_languages_taxonomy();
}