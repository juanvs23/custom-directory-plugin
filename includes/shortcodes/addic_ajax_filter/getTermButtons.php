<?php

if(!function_exists('getTermButtons')){
    function getTermButtons($text_buttom, $taxonomy = 'coltman_locations') {
        global $wpdb;

        // Get the terms from the database by name
        $sql = "";
        $sql .= "SELECT term_id, name FROM " . $wpdb->prefix . "terms WHERE name like '%{$text_buttom}%'
                 AND term_id IN (SELECT term_id FROM " . $wpdb->prefix . "term_taxonomy WHERE taxonomy = 'coltman_locations') 
                 ORDER BY name ASC";
        //echo $sql;
        $results = $wpdb->get_results($sql);
        // Check if any terms were found
        if (is_wp_error($results)) {
            // Handle the error
            return null;
        }
        if (count($results) > 0) {
           // Loop through the terms and display them
            foreach ($results as $term) {
                //var_dump($term);
                $term_object = get_term($term->term_id, $taxonomy);
                $link =  !is_wp_error(get_term_link($term_object)) ? get_term_link($term_object) : false;
                return  gettype($link) == 'string'  ? '<div class="addic_filter">
                            <a href="'.$link.'" class="ajax_link_filter">
                                <div class="addic_filter_content">
                                    <h3 class="addic_filter_title">'.$term->name.'</h3>
                                </div>
                            </a>
                        </div>' : null;
            }
        }
        return null;  
    }
}