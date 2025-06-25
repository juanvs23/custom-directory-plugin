<?php

if(!function_exists('addic_ajax_base_content')){
    function addic_ajax_base_content() {
        $html = '';
       
        $html .=    '<div class="addic_ajax_section">';
        $html .=        '<h2 class="addic_ajax_title">Top Rehabs</h2>';
        $html .=        '<div class="addic_ajax_items">';
        
                            //var_dump(ADDIC_CLINIC_REHABS);
                            $args = [
                                        'post_type' => 'coltman_addic_clinic',
                                        'post_status' => 'publish',
                                        'posts_per_page' => -1,
                                        'orderby' => 'date',
                                        'order' => 'DESC',
                                        'tax_query' => [
                                            [
                                                'taxonomy' => 'coltman_type_membership',
                                                'field' => 'slug',
                                                'terms' => 'payment-membership'
                                            ]
                                        ]
                                    ];
                                    $get_rehab = get_posts($args);
                            foreach ($get_rehab as $rehab_id){
                                
                                $html .= addic_ajax_rehab_ajax_item([
                                    'link' => get_permalink($rehab_id->ID),
                                    'title' => get_the_title($rehab_id->ID),
                                    'description' => get_post_meta($rehab_id->ID, 'rehab_description', true),
                                    'rehab_id' => $rehab_id->ID
                                ]); 
                            }
                           
        $html .=        '</div>';
        $html .=    '</div>';
        $html .=    '<div class="addic_ajax_section">';
        $html .=        '<h2 class="addic_ajax_title">Top Locations</h2>';
        $html .=        '<div class="addic_filters">';
                             foreach (ADDIC_CLINIC_LOCATIONS as $location): 
                                $html .= getTermButtons($location);    
                            endforeach;
        $html .=        '</div>';
        $html .=    '</div>';
        return $html;
    }
}