<?php
if (class_exists('ColtmanRegisterTaxonomy') && !function_exists('coltman_add_level_care_taxonomy')) {
    
    function coltman_add_level_care_taxonomy() {
        new ColtmanRegisterTaxonomy(
            [
                'plural_name' => __('Levels Of Care', 'addic-clinic-directory'),
                'singular_name' => __('Level Of Care', 'addic-clinic-directory'),
                'item' => __('Level Of Care', 'addic-clinic-directory'),
                'text_domain' => 'addic-clinic-directory',
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud' => true,
                'show_in_rest' => true,
                'rest_base' => 'level-care',
            ],
            'coltman_level_care',
            [
                'coltman_addic_clinic'
            ],
            [
                'slug' => __('levels-of-care', 'addic-clinic-directory'),
                'with_front' => true,
                'hierarchical' => true,
                  'ep_mask' => EP_NONE // Evita endpoints
            ]
        );
    }
}
if (function_exists('coltman_add_level_care_taxonomy')) {
    coltman_add_level_care_taxonomy();
}
