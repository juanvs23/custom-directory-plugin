<?php

if(!function_exists('addic_ajax_rehab_ajax_item')){
    function addic_ajax_rehab_ajax_item($rehab_item){
        
        if(empty($rehab_item)){
            return '';
        }
        
        $rehab_id = $rehab_item['rehab_id'];
        $image_gallery = get_post_meta( $rehab_id, 'rehab_image_gallery', true );
        $first_image = is_iterable(json_decode($image_gallery)) && $image_gallery !="[]" ? json_decode($image_gallery)[0]->url : ADDIC_CLINIC_PLUGIN_URL.'assets/frontend/image/single-default.webp';
        $image = get_the_post_thumbnail_url($post->ID) ?get_the_post_thumbnail_url($post->ID) : $first_image;
        $link = $rehab_item['link'] ?? '';
        $title = $rehab_item['title'] ?? '';
        $description = coltman_trim_by_chars_fn($rehab_item['description'],120) ?? '';
        $html = '';

        $html .= '<div class="addic_ajax_item">';
            $html .= '<a href="'. esc_url($link) .'" class="ajax_link_item">';
            $html .= '<div class="addic_ajax_image">';
            $html .= '<img decoding="async" src="'. esc_url($image) .'" alt="'. esc_attr($title) .'" loading="lazy" async="">';
            $html .= '</div>';
            $html .= '<div class="addic_ajax_content">';
            $html .= '<h2 class="addic_ajax_title">'. esc_html($title) .'</h2>';
            $html .= '<p class="addic_ajax_description">';
            $html .= esc_html($description);
            $html .= '</p>';
            $html .= '</div>';
            $html .= '</a>';
        $html .= '</div>';

        return $html;
    }
}