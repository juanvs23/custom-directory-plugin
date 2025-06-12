<?php

if(!function_exists('coltman_addic_clinic_directory_cron')){

    function coltman_addic_clinic_directory_update_reviews(){
        $lot_size = 20;
        // check if
        $offset = get_option('google_reviews_offset', 0);
        $proceso_mensual_activo = get_option('proceso_mensual_activo', false);
        
        // if $proceso_mensual_activo is false, then we need to start the process
        if(!$proceso_mensual_activo){

            $proceso_mensual_activo = true;
            $offset = 0;
            
            update_option('proceso_mensual_activo', $proceso_mensual_activo);
            update_option('google_reviews_offset', $offset);
        }


        $args = array(
            'post_type' => 'coltman_addic_clinic',
            'posts_per_page' => $lot_size,
            'offset' => $offset,
        );

        $rehabs = get_posts($args);
        $count = $offset;
        if(empty($rehabs)){
            foreach ($rehabs as $rehab) {
                $rehab_id = $rehab->ID;
                $title = get_post_meta($rehab_id, 'google_review_title', true) && get_post_meta($rehab_id, 'google_review_title', true) !=''? get_post_meta($rehab_id, 'google_review_title', true) : $rehab->post_title;
                $google_place_id = get_post_meta($rehab_id, 'google_place_id', true);

                if(isset($google_place_id) && $google_place_id != ''){
                    //get news googles reviews
                    $reviews = coltman_get_google_reviews_widget($google_place_id);
                    $rating = $reviews['rating'];
                    $reviews_array = coltman_get_save_reviews($reviews['reviews']);
                    $user_ratings_total = $reviews['user_ratings_total'];

                    // Save data
                    update_post_meta($rehab_id, 'rehab_rating', $rating);
                    update_post_meta($rehab_id, 'user_ratings_total', $user_ratings_total);
                    update_post_meta($rehab_id, 'coltman_google_reviews', $reviews_array);

                }else{
                    $get_google_place_id = coltman_get_google_place_id($title);

                    update_post_meta($rehab_id, 'google_place_id', $get_google_place_id);

                    $reviews = coltman_get_google_reviews_widget($get_google_place_id);
                    $rating = $reviews['rating'];
                    $reviews_array = coltman_get_save_reviews($reviews['reviews']);
                    $user_ratings_total = $reviews['user_ratings_total'];

                    // Save data
                    update_post_meta($rehab_id, 'rehab_rating', $rating);
                    update_post_meta($rehab_id, 'user_ratings_total', $user_ratings_total);
                    update_post_meta($rehab_id, 'coltman_google_reviews', $reviews_array);

                }
                $count++;
            }
            update_option('google_reviews_offset', $offset);


        }


    };


    function coltman_addic_clinic_directory_cron(){
        if(!wp_next_scheduled('coltman_addic_clinic_directory_cron')){
            wp_schedule_event(time(), 'daily', 'coltman_addic_clinic_directory_update_reviews');
        }
    }
    add_action('wp', 'coltman_addic_clinic_directory_cron');
}

if(!function_exists('coltman_addic_clinic_directory_restart_update_reviews')){
    function reiniciar_proceso_mensual() {
        update_option('google_reviews_offset', 0);
        update_option('proceso_mensual_activo', false);
    }
    add_action('reiniciar_proceso_mensual', 'reiniciar_proceso_mensual');

    function coltman_addic_clinic_directory_restart_update_reviews(){
        if(!wp_next_scheduled('reiniciar_proceso_mensual')){
            wp_schedule_single_event(time() + 30*24*60*60, 'reiniciar_proceso_mensual');
        }
    }
    add_action('wp', 'coltman_addic_clinic_directory_restart_update_reviews');
}