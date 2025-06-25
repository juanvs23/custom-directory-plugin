<?php

if(!function_exists('addic_ajax_filter_callback')){
      function addic_ajax_filter_callback(){
        global $wpdb;
        $prefix = $wpdb->prefix;
        $nonce = $_POST['nonce'];
        $html = "";
        //Get all post by name
        $search = $_POST['search'];
        if ( ! wp_verify_nonce( $nonce, 'addic_ajax_filter' ) ) {
            $html .='<div class="addic_ajax_nonce">';
            $html .= '<h2 class="addic_ajax_title">'.__('Nonce not verified', 'addic-clinic-directory').'</h2>';
            $html .= '<p> Your access token is not valid </p>';
            $html .='</div>'; 
            return wp_send_json_error( $html );
        }
        if(strlen($search) < 1  ){
            $html .= addic_ajax_base_content();
            return wp_send_json_success( $html );
        }
        if(strlen($search) > 2){
            /**
             * Rehabs
             */
            $rehabs = addic_get_ajax_rehabs($search);
            $html .= $rehabs;
            /**
             * Filters
             */
            $location = display__filter_sections([ 'search' => $search, 'taxonomy' => 'coltman_locations', 'title' => 'Locations' ]);
            $html .=   $location;
        }
        

        
    

        
        if( empty($html) ){
            $html .= addic_ajax_base_content();
        }
        return wp_send_json_success($html);
    }
    add_action('wp_ajax_addic_ajax_filter', 'addic_ajax_filter_callback');
    add_action('wp_ajax_nopriv_addic_ajax_filter', 'addic_ajax_filter_callback');
}