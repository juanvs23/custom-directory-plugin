<?php

if(!function_exists('addic_clinic_register_assets')){
    function addic_clinic_register_assets(){
        wp_enqueue_style( 'addic-swiper', trailingslashit(ADDIC_CLINIC_PLUGIN_URL).'assets/libs/swiper/swiper-bundle.css', [], ADDIC_CLINIC_VERSION );
        wp_enqueue_style( 'addic-clinic-general', trailingslashit(ADDIC_CLINIC_PLUGIN_URL).'assets/frontend/css/style.css', ['addic-swiper'], ADDIC_CLINIC_VERSION );

        wp_enqueue_script( 'addic-swiper', trailingslashit(ADDIC_CLINIC_PLUGIN_URL).'assets/libs/swiper/swiper-bundle.min.js', [], ADDIC_CLINIC_VERSION, array(
            'in_footer' => true,
            'strategy'  => 'defer',
        ) );

        wp_enqueue_script( 'addic-clinic-script', trailingslashit(ADDIC_CLINIC_PLUGIN_URL).'assets/frontend/js/script.js', ['addic-swiper'], ADDIC_CLINIC_VERSION, array(
            'in_footer' => true,
            'strategy'  => 'defer',
        )  );
        wp_localize_script( 'addic-clinic-script', 'addic_clinic_ajax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'addic_ajax_filter' ),
            "video" =>ADDIC_CLINIC_GOOGLE_API_KEY
        ) );
 
        if(is_singular('coltman_addic_clinic')){
            wp_enqueue_style( 'addic-clinic-single', trailingslashit(ADDIC_CLINIC_PLUGIN_URL).'assets/frontend/css/single.css', ['addic-clinic-general'], ADDIC_CLINIC_VERSION );
            wp_enqueue_script( 'youtube_handler', 'https://www.youtube.com/iframe_api', ['addic-clinic-script'], ADDIC_CLINIC_VERSION,true);
            wp_enqueue_script( 'addic-clinic-single', trailingslashit(ADDIC_CLINIC_PLUGIN_URL).'assets/frontend/js/single.js', ['addic-clinic-script','youtube_handler'], ADDIC_CLINIC_VERSION,array(
                'in_footer' => true,
                'strategy'  => 'defer',
            ) );

        }
    }
    add_action('wp_enqueue_scripts', 'addic_clinic_register_assets');
}