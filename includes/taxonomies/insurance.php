<?php
if (class_exists('ColtmanRegisterTaxonomy') && !function_exists('coltman_add_insurance_taxonomy')) {
    
    function coltman_add_insurance_taxonomy() {
        new ColtmanRegisterTaxonomy(
            [
                'plural_name' => __('Insurances', 'addic-clinic-directory'),
                'singular_name' => __('Insurance', 'addic-clinic-directory'),
                'item' => __('Insurance', 'addic-clinic-directory'),
                'text_domain' => 'addic-clinic-directory',
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud' => true,
                'show_in_rest' => true,
                'has_archive' => true,
                'rest_base' => 'insurances',
            ],
            'coltman_insurance_method',
            [
                'coltman_addic_clinic'
            ],
            [
                'slug' => __('insurances', 'addic-clinic-directory'),
                'with_front' => true,
                'hierarchical' => true,
            ]
        );
    }
}
if (function_exists('coltman_add_insurance_taxonomy')) {
    coltman_add_insurance_taxonomy();
}
