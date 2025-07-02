<?php

if (class_exists('ColtmanRegisterTaxonomy') && !function_exists('coltman_add_luxury_taxonomy')) {
    
    function coltman_add_luxury_taxonomy() {
        new ColtmanRegisterTaxonomy(
            [
                'plural_name' => __('Luxury Rehab', 'addic-clinic-directory'),
                'singular_name' => __('Luxury Rehab', 'addic-clinic-directory'),
                'item' => __('Luxury Rehab', 'addic-clinic-directory'),
                'text_domain' => 'addic-clinic-directory',
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'show_admin_column' => false,
                'show_in_nav_menus' => false,
                'show_tagcloud' => true,
                'show_in_rest' => false,
                'has_archive' => false,
                'rest_base' => 'luxuries',
                'capabilities' =>[
                    'manage_terms'  => '',
			        'edit_terms'    => '',
			        'delete_terms'  => '',
			        'assign_terms'  => 'edit_posts'
                ],
            ],
            'coltman_luxuries',
            [
                'coltman_addic_clinic'
            ],
           false
        );
    }
}
if (function_exists('coltman_add_luxury_taxonomy')) {
    coltman_add_luxury_taxonomy();
    function coltman_add_true_luxury() {
        wp_insert_term(
            'Yes',
            'coltman_luxuries',
            [
                'slug' => 'yes',
                'description' => 'Luxury rehab'
            ]
        );
    };

    function coltman_add_false_luxury() {
        wp_insert_term(
            'No',
            'coltman_luxuries',
            [
                'slug' => 'no',
                'description' => 'No Luxury rehab'
            ]
        );
    };
    if(function_exists('coltman_add_true_luxury')){
        add_action( 'init', 'coltman_add_true_luxury' );
    }
    if(function_exists('coltman_add_false_luxury')){
        add_action( 'init', 'coltman_add_false_luxury' );
    }

    if(function_exists('coltman_add_true_luxury') && function_exists('coltman_add_false_luxury')) {
      /*   function coltman_luxury_default_format_term( $post_id, $post  ) {
            if ( 'publish' === $post->post_status && 'coltman_addic_clinic' === $post->post_type ) {
                $defaults = array(
                    'coltman_luxuries' => 'no' // default value
                );
                foreach ( (array) $taxonomies as $taxonomy ) {
                    $terms = wp_get_post_terms( $post_id, $taxonomy );
                    if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
                        wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
                    }
                }
            }
        }
        add_action( 'save_post', 'coltman_luxury_default_format_term', 100, 2 ); */
    }
}