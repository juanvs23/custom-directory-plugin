<?php
if ( class_exists( 'ColtmanRegisterTaxonomy' ) && ! function_exists( 'coltman_add_highlights_taxonomy' ) ) {

    function coltman_add_highlights_taxonomy() {
        new ColtmanRegisterTaxonomy(
            [
                'plural_name' => __( 'Highlights', 'addic-clinic-directory' ),
                'singular_name' => __( 'Highlight', 'addic-clinic-directory' ),
                'item' => __( 'highlight', 'addic-clinic-directory' ),
                'text_domain' => 'addic-clinic-directory',
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud' => true,
                'show_in_rest' => true,
                'has_archive' => true,
                'rest_base' => 'highlights',
            ],
            'coltman_highlights',
            [
                'coltman_addic_clinic'
            ],
            [
                'slug' => __( 'highlights', 'addic-clinic-directory' ),
                'with_front' => true,
                'hierarchical' => true,
            ]
        );
    }
}
if(function_exists( 'coltman_add_highlights_taxonomy' )){
    coltman_add_highlights_taxonomy();
}