<?php
if( class_exists( 'ColtmanRegisterTaxonomy' ) && ! function_exists( 'coltman_add_amenities_taxonomy' ) ){
    function coltman_add_amenities_taxonomy(){
        new ColtmanRegisterTaxonomy(
            [
                'plural_name' => __('Amenities', 'addic-clinic-directory'),
                'singular_name' => __('Amenity', 'addic-clinic-directory'),
                'item' => __('amenity', 'addic-clinic-directory'),
                'text_domain' => 'addic-clinic-directory',
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud' => true,
                'show_in_rest' => true,
                'rest_base' => 'amenities',
            ],
            'coltman_amenities',
            [
                'coltman_addic_clinic'
            ],
            false
        );
    }
}
if ( function_exists( 'coltman_add_amenities_taxonomy' ) ) {
    coltman_add_amenities_taxonomy();
}