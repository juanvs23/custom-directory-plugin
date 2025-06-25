<?php

if(!function_exists('addic_get_ajax_rehabs')){
    function  addic_get_ajax_rehabs( string $search){
        global $wpdb;
        $prefix = $wpdb->prefix;

        // get post ID by search text
        $sql = "SELECT ID FROM {$prefix}posts WHERE post_title LIKE '%{$search}%' AND post_type = 'coltman_addic_clinic' AND post_status = 'publish'";
        $html = '';
        $results = $wpdb->get_results($sql);
        if (is_wp_error($results) ) {
            $html .= '<div class="addic_ajax_section">';
            $html .= '<h2 class="addic_ajax_title">'.__('No results', 'addic-clinic-directory').'</h2>';
            $html .= '</div>';
            return $html;
        }

        $html = '';
        $html .=    '<div class="addic_ajax_section">';
        $html .=        '<h2 class="addic_ajax_title">Rehabs by: '.$search.'</h2>';
        $html .=        '<div class="addic_ajax_items">';
        foreach( $results as $post_id ){
            $post = get_post($post_id);
            if($post){
                $html .= addic_ajax_rehab_ajax_item([
                                'link' => get_permalink($post->ID),
                                'title' => get_the_title($post->ID),
                                'description' => get_post_meta($post->ID, 'rehab_description', true),
                                'rehab_id' => $post->ID
                            ]);
            }

        }
        if(empty($results)){
            $html .= '<div class="addic_ajax_section">';
            $html .= '<h3 class="addic_ajax_title">'.__('No results', 'addic-clinic-directory').'</h3>';
            $html .= '</div>';
        }
        $html .=        '</div>';
        $html .=    '</div>';
        return $html;
    }
}