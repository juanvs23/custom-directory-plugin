<?php

if(!function_exists('display__filter_sections')){
       function display__filter_sections($parameters){
        global $wpdb;
        $prefix = $wpdb->prefix;
        $html = '';
        $search = $parameters['search'];
        $taxonomy = $parameters['taxonomy'];
        $title = $parameters['title'];
        $sql = "SELECT term_id, name FROM " . $prefix . "terms WHERE name like '%{$search}%'
                 AND term_id IN (SELECT term_id FROM " . $prefix . "term_taxonomy WHERE taxonomy = 'coltman_locations') 
                 ORDER BY name ASC";
        //echo $sql;
        $results = $wpdb->get_results($sql);
        if( is_wp_error($results) ) {
            // Handle the error
            return null;
        };
       

        //var_dump($locations);
        $html .= '<div class="addic_ajax_section">';
        $html .= '<h2 class="addic_ajax_title">'.__($title. ' by: '. $search, 'addic-clinic-directory').'</h2>';
        $html .= '<div class="addic_filters">';
        if(empty($results)){
            $html .= '<div class="addic_filter">';
            $html .= '<h3 class="addic_ajax_title">'.__('No results', 'addic-clinic-directory').'</h3>';
            $html .= '</div>';
        } else {
            foreach ( $results  as $term) {
                
                $location = get_term($term->term_id, $taxonomy);
                if (is_wp_error($location)) {
                    continue; // Skip this term if there's an error
                }
                $link = !is_wp_error(get_term_link($location->term_id, $taxonomy)) ? get_term_link($location->term_id, $taxonomy) : '#';
                $html .= '<div class="addic_filter">';
                $html .= '<a href="'. $link .'" class="ajax_link_filter">';
                $html .= '<div class="addic_filter_content">';
                $html .= '<h3 class="addic_filter_title">';
                $html .= $location->name;
                $html .= '</h3>';
                $html .= '</div>';
                $html .= '</a>';
                $html .= '</div>';
            }
        }
            $html .='</div>';
            $html .='</div>';
        return $html;
    }
}