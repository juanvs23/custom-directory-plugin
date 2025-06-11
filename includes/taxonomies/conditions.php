<?php
if ( class_exists('ColtmanRegisterTaxonomy') && ! function_exists( 'coltman_add_conditions_taxonomy' ) ) {
    function coltman_add_conditions_taxonomy() {
        new ColtmanRegisterTaxonomy(
            [
                'plural_name' => __( 'Conditions', 'addic-clinic-directory' ),
                'singular_name' => __( 'Condition', 'addic-clinic-directory' ),
                'item' => __( 'condition', 'addic-clinic-directory' ),
                'text_domain' => 'addic-clinic-directory',
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud' => true,
                'show_in_rest' => true,
                'has_archive' => true,
                'rest_base' => 'conditions',
            ],
            'coltman_conditions',
            [
                'coltman_addic_clinic'
            ],
            [
                'slug' => __( 'conditions', 'addic-clinic-directory' ),
                'with_front' => true,
                'hierarchical' => false,
                
            ]
        );
    }
}
if ( function_exists( 'coltman_add_conditions_taxonomy' ) ) {
    coltman_add_conditions_taxonomy();
}