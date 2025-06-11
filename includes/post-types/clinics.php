<?php
if(!function_exists('coltman_add_clinic_post_type')){

    function coltman_add_clinic_post_type(){
        new ColtmanRegisterPost(
            [
                'name' => __('Rehabs', 'addic-clinic-directory'),
                'item' => __('Rehab', 'addic-clinic-directory'),
                'domain' => 'addic-clinic-directory',
    
            ],
            'coltman_addic_clinic',
            [
                'description' => __('Addic Rehabs Directory', 'addic-clinic-directory'),
                'hierarchical' => false,
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'show_in_nav_menus' => true,
                'show_in_admin_bar' => true,
                'menu_position' => 5,
                'menu_icon' => ADDIC_CLINIC_PLUGIN_URL.'/assets/admin/img/hospitales.svg',
                'can_export' => true,
                'has_archive' => __('rehabs', 'addic-clinic-directory'),
                'exclude_from_search' => false,
                'capability_type' => 'post',
                'publicly_queryable' => true,
                'show_in_rest' => false,
                
                'map_meta_cap' => true,
                'rest_base' => 'rehabs',
            ],
            [
                'thumbnail',
                'excerpt',
                'custom-fields',
                'revisions',
                'title'
            ],
            ADDIC_CLINIC_FILTERS,
            [
                'slug' => __('rehabs', 'addic-clinic-directory'),
                'with_front' => true,
                'pages' => true,
                'feeds' => true,
            ]
    
        );
    }
   
}