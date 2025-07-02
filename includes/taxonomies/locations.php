<?php

if (class_exists('ColtmanRegisterTaxonomy') && !function_exists('coltman_add_locations_taxonomy')) {
    
    function coltman_add_locations_taxonomy() {
        new ColtmanRegisterTaxonomy(
            [
                'plural_name' => __('Locations', 'addic-clinic-directory'),
                'singular_name' => __('Location', 'addic-clinic-directory'),
                'item' => __('Location', 'addic-clinic-directory'),
                'text_domain' => 'addic-clinic-directory',
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud' => true,
                'show_in_rest' => true,
                'has_archive' => 'locations',
                'rest_base' => 'location',
            ],
            'coltman_locations',
            [
                'coltman_addic_clinic'
            ],
            [
                'slug' => __('location', 'addic-clinic-directory'),
                'with_front' => true,
                'hierarchical' => true,
            ]
        );
    }
}
if (function_exists('coltman_add_locations_taxonomy')) {
    coltman_add_locations_taxonomy();
}