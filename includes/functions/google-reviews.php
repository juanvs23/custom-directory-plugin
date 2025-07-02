<?php

if(!function_exists('coltman_get_google_place_id')){
    function coltman_get_google_place_id($local ){
        //var_dump($api_key);
        $url = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json";
        $params =[
            'input' => $local,
            'inputtype' => 'textquery',
            'fields' => 'place_id',
            'key' => ADDIC_CLINIC_GOOGLE_API_KEY
        ];
        $url .= '?' . http_build_query($params);
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        if($data['status'] =="OK"){
            return $data['candidates'][0]['place_id']; ;
        }else{
            return 'Not found';
        }

    }
    
}

if(!function_exists('coltman_get_google_reviews_widget')){
    function coltman_get_google_reviews_widget($google_place_id){
        $url = "https://maps.googleapis.com/maps/api/place/details/json";
        $params =[
            'placeid' => $google_place_id,
            'fields' => 'reviews,rating,user_ratings_total,geometry,formatted_address',
            'language' => 'en',
            'key' => ADDIC_CLINIC_GOOGLE_API_KEY
        ];
        $url .= '?' . http_build_query($params);
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        if($data['status'] == "OK"){
            return $data['result'];
        }else{
            return 'Not found';
        }
    }
}
if(!function_exists('coltman_get_save_reviews')){
    function coltman_get_save_reviews($reviews){
       //var_dump( gettype($reviews));
        if(!is_iterable($reviews) || count($reviews) == 0){
            return [];
        }
        return  array_map(function($review){
           return [
               'author_name' => $review['author_name'],
               'language' => $review['language'],
               'profile_photo_url' => $review['profile_photo_url'],
               'rating' => floatval($review['rating']),
               'relative_time_description' => sanitize_text_field($review['relative_time_description']),
               'text' => sanitize_text_field($review['text']),
               'time' => $review['time'],
           ];
        },$reviews);
        
    }
}

if(!function_exists('ama_save_googlePlaceId')){
    add_action('save_post', 'ama_save_googlePlaceId', 13, 2);
    function ama_save_googlePlaceId($post_id, $post){

        if ($post->post_type !== 'coltman_addic_clinic') {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Evitar ejecuciones en bucle
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        //var_dump(coltman_get_google_place_id($post->post_title));
       // die();
        if(isset($_POST['google_place_id']) && $_POST['google_place_id'] == '' ){
            $title = isset($_POST['google_review_title']) && $_POST['google_review_title'] != '' ? $_POST['google_review_title'] : $post->post_title;
            $place_id = coltman_get_google_place_id($title);
            update_post_meta($post_id, 'google_place_id', $place_id);
            if($place_id != 'Not found' && $place_id != ''){
                $reviews =  coltman_get_google_reviews_widget($place_id);
                $rating = $reviews['rating'];
                $reviews_array = coltman_get_save_reviews($reviews['reviews']);
                if(isset($_POST['rehab_rating']) && $_POST['rehab_rating'] == ''){
                    update_post_meta($post_id, 'rehab_rating', $rating);
                    update_post_meta($post_id, 'user_ratings_total', $reviews['user_ratings_total']);
                }
                if(isset($_POST['rehab_google_maps']) && $_POST['rehab_google_maps'] == '' ){
                 $urlMap =   "https://www.google.com/maps/embed/v1/place?key=".ADDIC_CLINIC_GOOGLE_API_KEY."&q=". urlencode($title);
                 update_post_meta($post_id, 'rehab_google_maps', $urlMap);
                }
                if($place_id != 'Not found' && $reviews !=''){
                    update_post_meta($post_id, 'coltman_google_reviews', $reviews_array);
                }
            }
        }
        
        if(isset($_POST['rehab_rating']) && $_POST['rehab_rating'] == ''){
            $google_place_id = get_post_meta($post_id, 'google_place_id', true);
            if($google_place_id != 'Not found' && $google_place_id != ''){
                $reviews = coltman_get_google_reviews_widget($google_place_id);
                $rating = isset( $reviews['rating'])? $reviews['rating'] : 0;
    
                $reviews_array = coltman_get_save_reviews($reviews['reviews']);
                update_post_meta($post_id, 'user_ratings_total', $reviews['user_ratings_total']);
                update_post_meta($post_id, 'rehab_rating', $rating);
                update_post_meta($post_id, 'coltman_google_reviews', $reviews_array);
                if(isset($_POST['rehab_google_maps']) && $_POST['rehab_google_maps'] == '' ){
                    $urlMap =   "https://www.google.com/maps/embed/v1/place?key=".ADDIC_CLINIC_GOOGLE_API_KEY."&q=". urlencode($title);
                    update_post_meta($post_id, 'rehab_google_maps', $urlMap);
                }
            }
        }
        //die();
    }
}