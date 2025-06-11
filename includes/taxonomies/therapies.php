<?php
if ( class_exists('ColtmanRegisterTaxonomy') && ! function_exists( 'coltman_add_therapies_taxonomy' ) ) {
    function coltman_add_therapies_taxonomy() {
        new ColtmanRegisterTaxonomy(
            [
                'plural_name' => __( 'Therapies', 'addic-clinic-directory' ),
                'singular_name' => __( 'Therapy', 'addic-clinic-directory' ),
                'item' => __( 'therapies', 'addic-clinic-directory' ),
                'text_domain' => 'addic-clinic-directory',
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud' => true,
                'show_in_rest' => true,
                'has_archive' => true,
                'rest_base' => 'therapies',
            ],
            'coltman_treatments',
            [
                'coltman_addic_clinic'
            ],
            [
                'slug' => __( 'therapies', 'addic-clinic-directory' ),
                'with_front' => true,
                'hierarchical' => true,
            ]
        );
    }
}
if ( function_exists( 'coltman_add_therapies_taxonomy' ) ) {
    coltman_add_therapies_taxonomy();
}