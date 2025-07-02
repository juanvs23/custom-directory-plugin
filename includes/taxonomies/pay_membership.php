<?php

if(class_exists('ColtmanRegisterTaxonomy') &&  !function_exists('coltman_add_pay_membership_taxonomy')){
    function coltman_add_pay_membership_taxonomy(){
        new ColtmanRegisterTaxonomy(
            [
                'plural_name' => __('Type Of Memberships', 'addic-clinic-directory'),
                'singular_name' => __('Type Of Membership', 'addic-clinic-directory'),
                'item' => __('Type Of Membership', 'addic-clinic-directory'),
                'text_domain' => 'addic-clinic-directory',
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'capabilities' =>[
                    'manage_terms'  => '',
			        'edit_terms'    => '',
			        'delete_terms'  => '',
			        'assign_terms'  => 'edit_posts'
                ],
                'show_admin_column' => false,
                'show_in_nav_menus' => false,
                'show_tagcloud' => false,
                'show_in_rest' => false,
                'has_archive' => false,
                'rest_base' => 'locations',
                
            ],
            'coltman_type_membership',
            [
                'coltman_addic_clinic'
            ],
            false
        );
    }
}
if (function_exists('coltman_add_pay_membership_taxonomy')) {
    // create 
    coltman_add_pay_membership_taxonomy();
    function coltman_payment_membership() {
        wp_insert_term(
            'Payment Membership',
            'coltman_type_membership',
            [
                'slug' => 'payment-membership',
                'description' => 'Payment Membership',
            ]
        );
    }
    function coltman_free_membership(){
        wp_insert_term(
            'Free Membership',
            'coltman_type_membership',
            [
                'slug' => 'free-membership',
                'description' => 'Free Membership',
            ]
        );

    }

    if(function_exists('coltman_payment_membership')){
        add_action( 'init', 'coltman_payment_membership' );
    }
    if(function_exists('coltman_free_membership')){
        add_action( 'init', 'coltman_free_membership' );
    }
    if(function_exists('coltman_payment_membership') && function_exists('coltman_free_membership')){
       /*  function coltman_membership_default_format_term( $post_id, $post  ) {
            if ( 'publish' === $post->post_status && 'coltman_addic_clinic' === $post->post_type ) {
                $defaults = array(
                    'coltman_type_membership' => 'free-membership' // default value
                );
                foreach ( (array) $taxonomies as $taxonomy ) {
                    $terms = wp_get_post_terms( $post_id, $taxonomy );
                    if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
                        wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
                    }
                }
            }
        }
        add_action( 'save_post', 'coltman_membership_default_format_term', 100, 2 );
 */

        function wpse_139269_term_radio_checklist( $args ) {
            if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'layout' ) {
                if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
                    if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
                        class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                            function walk( $elements, $max_depth, $args = array() ) {
                                $output = parent::walk( $elements, $max_depth, $args );
                                $output = str_replace(
                                    array( 'type="checkbox"', "type='checkbox'" ),
                                    array( 'type="radio"', "type='radio'" ),
                                    $output
                                );
                                return $output;
                            }
                        }
                    }
                    $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
                }
            }
            return $args;
        }
        add_filter( 'wp_terms_checklist_args', 'wpse_139269_term_radio_checklist' );
    }

}