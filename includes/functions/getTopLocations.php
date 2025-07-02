<?php

if(!function_exists('getTopLocations')){
    function getTopLocations(string $currentLocation){
        global $wpdb;
        $prefix = $wpdb->prefix;
        $topLocations = ADDIC_CLINIC_LOCATIONS;

        $topLocation_list = [];


        // lower case all locations
        $topLocations = array_map('strtolower', $topLocations);

        
        // lower case current location
        $currentLocation = strtolower($currentLocation);
        

        
        // Check if the current location is in the top locations array
        if(in_array($currentLocation, $topLocations)){
            $topLocations = array_filter($topLocations, function($location) use ($currentLocation) {
                return $location !== $currentLocation;
            });
        }
        
        foreach($topLocations as $topLocation){
            // get term from database
            
            $sql = "SELECT t.term_id, t.name, 
                    tt.count FROM {$prefix}terms t
                    INNER JOIN {$prefix}term_taxonomy tt ON t.term_id = tt.term_id
                    WHERE tt.taxonomy = 'coltman_locations'
                    AND t.name LIKE '%{$topLocation}%'
                    ORDER BY t.name;";
            
            $term = $wpdb->get_results($sql);

            if(count($term) > 0){
                $term = $term[0];
            }
            $get_term = get_term($term->term_id, 'coltman_locations');
            $get_link_term = get_term_link($get_term, 'coltman_locations'); 
            
            //var_dump($get_link_term,'topLocation <br>');

            $topLocation_list[] = [
                'name' => $get_term->name,
                'term_id' => $get_term->term_id,
                'link' => $get_link_term
            ];

        };

        return $topLocation_list;

    }
}