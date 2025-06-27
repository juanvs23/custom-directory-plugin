<?php

if(!function_exists('add_schma_rehab_fn')){
    function add_schma_rehab_fn(){
        global $post;
        if(is_singular('coltman_addic_clinic')){
            $post = get_post($post->ID);

            $post_id = $post->ID;
            //fields:
            $rehab_price_range = get_post_meta( $post_id, 'rehab_price_range', true ); 
            $rehab_address = get_post_meta( $post_id, 'rehab_address', true );
            $rehab_description = get_post_meta( $post_id, 'rehab_description', true );
            $rehab_city = get_post_meta( $post_id, 'rehab_city', true );
            $rehab_state = get_post_meta( $post_id, 'rehab_state', true );
            $rehab_phone = get_post_meta( $post_id, 'rehab_phone', true );
            $rehab_email = get_post_meta( $post_id, 'rehab_email', true );
            $rehab_website = get_post_meta( $post_id, 'rehab_website', true );
            $rehab_google_maps = get_post_meta( $post_id, 'rehab_google_maps', true );
            $rehab_faq = get_post_meta( $post_id, 'rehab_faq', true );
            $rehab_image_gallery = get_post_meta( $post_id, 'rehab_image_gallery', true );
            $first_image = is_iterable(json_decode($rehab_image_gallery)) && $rehab_image_gallery !="[]" ? json_decode($rehab_image_gallery)[0]->url : ADDIC_CLINIC_PLUGIN_URL.'assets/frontend/image/single-default.webp'; 
            $featured_image = get_the_post_thumbnail_url()?get_the_post_thumbnail_url():$first_image;
            //var_dump($rehab_image_gallery);
            $coltman_type_membership = get_the_terms( $post_id, 'coltman_type_membership' )[0]; // "free-membership" or "premium-membership"
            $google_review_title = get_post_meta( $post_id, 'google_review_title', true );

            $schema = [
                "@context" => "https://schema.org",
                "@type" => "MedicalBusiness",
                "@id" => get_permalink($post->ID) . '#medicalbusiness',
                "name" => $post->post_title,
                "legalName"=> $google_review_title ? $google_review_title : $post->post_title,
                "url" => get_permalink($post->ID),
                "description" => wp_strip_all_tags($rehab_description),
                "priceRange" => $rehab_price_range,
                "image" => $featured_image,
                "telephone" => $rehab_phone,
                "sameAs" => [$rehab_website],
                "email" => $rehab_email,
                "hasMap" => $rehab_google_maps,
                "address" => [
                    "@type" => "PostalAddress",
                    "streetAddress" => $rehab_address,
                    "addressLocality" =>$rehab_state ,
                    "addressRegion" => $rehab_city,
                    "postalCode" => "",
                    "addressCountry" => "US"
                ],
                // "mainEntityOfPage" => [
                //     "@type" => "WebPage",
                //     "@id" => get_permalink($post->ID)
                // ],
            ];

            echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
            //var_dump($post);
        }
    }
    add_action('wp_head', 'add_schma_rehab_fn');
}