<?php

if(!function_exists('addic_ajax_filter_fn')){
    function addic_ajax_filter_fn($atts){

        ob_start();
        ?>
        <div class="addic_ajax_filter">
            <form class="addic_ajax_form">
               <div class="form_content">
                <button type="submit" class="ajax_button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.4408 4C10.3339 4.00009 9.24311 4.26489 8.25939 4.77228C7.27567 5.27968 6.42755 6.01497 5.7858 6.91681C5.14404 7.81864 4.72726 8.86087 4.57022 9.95655C4.41318 11.0522 4.52044 12.1696 4.88305 13.2153C5.24565 14.2611 5.8531 15.205 6.65469 15.9683C7.45629 16.7316 8.4288 17.2921 9.49108 17.6031C10.5534 17.9141 11.6746 17.9666 12.7613 17.7561C13.848 17.5456 14.8685 17.0783 15.7379 16.3932L18.7202 19.3755C18.8742 19.5243 19.0805 19.6066 19.2947 19.6047C19.5088 19.6029 19.7136 19.517 19.865 19.3656C20.0164 19.2142 20.1023 19.0094 20.1042 18.7952C20.106 18.5811 20.0237 18.3748 19.8749 18.2208L16.8926 15.2385C17.6994 14.2149 18.2018 12.9849 18.3422 11.6892C18.4826 10.3934 18.2554 9.08436 17.6866 7.91174C17.1177 6.73912 16.2302 5.75033 15.1257 5.05854C14.0211 4.36675 12.7441 3.99991 11.4408 4ZM6.13267 10.9414C6.13267 9.53357 6.69192 8.18343 7.68738 7.18797C8.68284 6.19251 10.033 5.63326 11.4408 5.63326C12.8486 5.63326 14.1987 6.19251 15.1942 7.18797C16.1896 8.18343 16.7489 9.53357 16.7489 10.9414C16.7489 12.3492 16.1896 13.6993 15.1942 14.6948C14.1987 15.6902 12.8486 16.2495 11.4408 16.2495C10.033 16.2495 8.68284 15.6902 7.68738 14.6948C6.69192 13.6993 6.13267 12.3492 6.13267 10.9414Z" fill="#1A1A1A"/>
                        </svg>
                    </button>
                    <input type="hidden" name="action" class="ajax_action" value="addic_ajax_filter">
                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'addic_ajax_filter' ); ?>">
                    <input type="text" name="search" class="search" placeholder="Search a Rehab or Location">
                    <div class="loader"></div>
               </div>
            </form>
            <div class="addic_ajax_result">
                <div class="addic_ajax_content">
                   <!--  <div class="addic_ajax_items">
                        <div class="addic_ajax_item">
                           <a href="#" class="ajax_link_item">
                           <div class="addic_ajax_image">
                            <img decoding="async" src="https://amatesting.uk/directorio/wp-content/uploads/2024/11/los-angeles-scaled.webp" alt="Burbank Memorial" loading="lazy" async="">
                            </div>
                            <div class="addic_ajax_content">
                                <h2 class="addic_ajax_title">
                                    Lorem Ipsum testeaasd ress
                                </h2>
                                <p class="addic_ajax_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, ullam reprehenderit saepe iure assumenda quasi magnam obcaecati suscipit?</p>
                            </div>
    
                           </a>
                        </div>
                        <div class="addic_ajax_item">
                           <a href="#" class="ajax_link_item">
                           <div class="addic_ajax_image">
                            <img decoding="async" src="https://amatesting.uk/directorio/wp-content/uploads/2024/11/los-angeles-scaled.webp" alt="Burbank Memorial" loading="lazy" async="">
                            </div>
                            <div class="addic_ajax_content">
                                <h2 class="addic_ajax_title">
                                    Lorem Ipsum testeaasd ress
                                </h2>
                                <p class="addic_ajax_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, ullam reprehenderit saepe iure assumenda quasi magnam obcaecati suscipit?</p>
                            </div>
    
                           </a>
                        </div>
                        <div class="addic_ajax_item">
                           <a href="#" class="ajax_link_item">
                           <div class="addic_ajax_image">
                            <img decoding="async" src="https://amatesting.uk/directorio/wp-content/uploads/2024/11/los-angeles-scaled.webp" alt="Burbank Memorial" loading="lazy" async="">
                            </div>
                            <div class="addic_ajax_content">
                                <h2 class="addic_ajax_title">
                                    Lorem Ipsum testeaasd ress
                                </h2>
                                <p class="addic_ajax_description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, ullam reprehenderit saepe iure assumenda quasi magnam obcaecati suscipit?</p>
                            </div>
    
                           </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
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
        $args = array(
            'post_type' => 'coltman_addic_clinic',
            'posts_per_page' => -1,
            's' => $search
        );
        $primium_args = array(
            'post_type' => 'coltman_addic_clinic',
            'posts_per_page' => -1,
            's' => $search,
            'tax_query' => array(
                array(
                    'taxonomy' => 'coltman_luxuries',
                    'field' => 'slug',
                    'terms' => 'yes'
                )
            )
        );
        $posts = get_posts( $args );
        $primium_posts = get_posts( $primium_args );
        $post = array_merge($posts, $primium_posts);
        if(count($posts) > 0){
            $html .= '<div class="addic_ajax_section">';
            $html .= '<h2 class="addic_ajax_title">'.__('Rehabs', 'addic-clinic-directory').'</h2>';
            $html .= '<div class="addic_ajax_items">';
            $count =  count($posts)<=5 ? count($posts) : 5;
            for ($i=0; $i < count($posts); $i++) {
                $post_id = $posts[$i]->ID;
                $rehab_image_gallery = get_post_meta( $post_id, 'rehab_image_gallery', true );
                $first_image = is_iterable(json_decode($rehab_image_gallery)) && $rehab_image_gallery !="[]" ? json_decode($rehab_image_gallery)[0]->url : ADDIC_CLINIC_PLUGIN_URL.'assets/frontend/image/single-default.webp'; 
                $featured_image = get_the_post_thumbnail_url()?get_the_post_thumbnail_url():$first_image;
                $rehab_description = get_post_meta( $post_id, 'rehab_description', true );

                $html .= '<div class="addic_ajax_item">';
                $html .= '<a href="'. get_permalink($posts[$i]->ID) .'" class="ajax_link_item">';
                $html .= '<div class="addic_ajax_image">';
                $html .= '<img decoding="async" src="'.$featured_image.'" alt="'.get_the_title($posts[$i]->ID).'" loading="lazy" async="">';
                $html .= '</div>';
                $html .= '<div class="addic_ajax_content">';
                $html .= '<h2 class="addic_ajax_title">';
                $html .= get_the_title($posts[$i]->ID);
                $html .= '</h2>';
                $html .= '<p class="addic_ajax_description">';
                $html .= coltman_trim_by_chars_fn($rehab_description, 150);    
                $html .= '</p>';
                $html .= '</div>';
                $html .= '</a>';
                $html .= '</div>';
            }
            $html .='</div>';
            $html .='</div>';
        }
        /**
         * Get post by locations
         */
        $args = array(
            'taxonomy'      =>'coltman_locations', // taxonomy name
            'orderby'       => 'name', 
            'order'         => 'ASC',
            'hide_empty'    => true,
            'fields'        => 'all',
            'name__like'    => $search
        ); 
        $get_rehabs_by_locations = get_terms($args);

        if(count($get_rehabs_by_locations) > 0){
            $html .= '<div class="addic_ajax_section">';
            $html .= '<h2 class="addic_ajax_title">'.__('Rehabs by locations', 'addic-clinic-directory').'</h2>';
            foreach ($get_rehabs_by_locations as $rehabs_by_location) {
                $html .= '<div class="addic_ajax_list" data-term_id="'. $rehabs_by_location->term_id .'">';
                $html .= '<h2 class="addic_location_title">'. $rehabs_by_location->name .'</h2>';
                $html .= '<div class="addic_ajax_items">';
                $get_rehabs = get_posts(array(
                    'post_type' => 'coltman_addic_clinic',
                    'posts_per_page' => 5,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'coltman_locations',
                            'field' => 'term_id',
                            'terms' => $rehabs_by_location->term_id
                        )
                    ) 
                ));
                if(count($get_rehabs) > 0){
                    for ($i=0; $i < count($get_rehabs); $i++) {
                        $post_id = $posts[$i]->ID;
                        $rehab_image_gallery = get_post_meta( $post_id, 'rehab_image_gallery', true );
                        $first_image = is_iterable(json_decode($rehab_image_gallery)) && $rehab_image_gallery !="[]" ? json_decode($rehab_image_gallery)[0]->url : ADDIC_CLINIC_PLUGIN_URL.'assets/frontend/image/single-default.webp'; 
                        $featured_image = get_the_post_thumbnail_url()?get_the_post_thumbnail_url():$first_image;
                        $rehab_description = get_post_meta( $post_id, 'rehab_description', true );
                        $html .= '<div class="addic_ajax_item">';
                        $html .= '<a href="'. get_permalink($get_rehabs[$i]->ID) .'" class="ajax_link_item">';
                        $html .= '<div class="addic_ajax_image">';
                        $html .= '<img decoding="async" src="'.$featured_image.'" alt="'.get_the_title($posts[$i]->ID).'" loading="lazy" async="">';
                        $html .= '</div>';
                        $html .= '<div class="addic_ajax_content">';
                        $html .= '<h2 class="addic_ajax_title">';
                        $html .= get_the_title($posts[$i]->ID);
                        $html .= '</h2>';
                        $html .= '<p class="addic_ajax_description">';
                        $html .= coltman_trim_by_chars_fn($rehab_description, 150);    
                        $html .= '</p>';
                        $html .= '</div>';
                        $html .= '</a>';
                        $html .= '</div>';
                    }
                }
                $html .='</div>';
                $html .= '<a class="addic_ajax_load_more" href="'. get_term_link($rehabs_by_location->term_id, 'coltman_locations') .'">';
                $html .= '<span>'.__('Load more', 'addic-clinic-directory').'</span>';
                $html .= '</a>';
                $html .='</div>';
            }
            $html .='</div>';
        }

        
        /**
         * Filters
         */
        $location = display__filter_sections([ 'search' => $search, 'taxonomy' => 'coltman_locations', 'title' => 'Locations' ]);
        $clientele =  display__filter_sections([ 'search' => $search, 'taxonomy' => 'coltman_clients', 'title' => 'Clientele' ] );
        $coltman_treatments =  display__filter_sections([ 'search' => $search, 'taxonomy' => 'coltman_treatments', 'title' => 'Therapies' ]);
        $coltman_amenities =  display__filter_sections([ 'search' => $search, 'taxonomy' => 'coltman_amenities', 'title' => 'Amenities' ]);
        $coltman_conditions =  display__filter_sections([ 'search' => $search, 'taxonomy' => 'coltman_conditions', 'title' => 'Conditions' ]);
        
        $html .=   $location;
        $html .=   $clientele;
        $html .=   $coltman_treatments;
        $html .=   $coltman_amenities;
        $html .=   $coltman_conditions;
    

        
        if( empty($html) ){
            $html .= '<div class="addic_ajax_section">';
            $html .= '<h2 class="addic_ajax_title">'.__('No results', 'addic-clinic-directory').'</h2>';
            $html .= '</div>';
        }
        return wp_send_json_success($html);
    }
    add_shortcode('addic_ajax_filter', 'addic_ajax_filter_fn');
    add_action('wp_ajax_addic_ajax_filter', 'addic_ajax_filter_callback');
    add_action('wp_ajax_nopriv_addic_ajax_filter', 'addic_ajax_filter_callback');


    function display__filter_sections($parameters){
        $html = '';
        $search = $parameters['search'];
        $taxonomy = $parameters['taxonomy'];
        $title = $parameters['title'];
        $args = array(
            'taxonomy'      => $taxonomy, // taxonomy name
            'orderby'       => 'name', 
            'order'         => 'ASC',
            'hide_empty'    => true,
            'fields'        => 'all',
            'name__like'    => $search
        ); 
        $locations = get_terms($args);

        if(count($locations) > 0){
            $html .= '<div class="addic_ajax_section">';
            $html .= '<h2 class="addic_ajax_title">'.__($title, 'addic-clinic-directory').'</h2>';
            $html .= '<div class="addic_filters">';
            $count =  count($locations)<=5 ? count($locations) : 5;

            for ($i=0; $i < $count; $i++) {
                $html .= '<div class="addic_filter">';
                $html .= '<a href="'. get_term_link($locations[$i]->term_id, $taxonomy) .'" class="ajax_link_filter">';
                $html .= '<div class="addic_filter_content">';
                $html .= '<h3 class="addic_filter_title">';
                $html .= $locations[$i]->name;
                $html .= '</h3>';
                $html .= '</div>';
                $html .= '</a>';
                $html .= '</div>';
            }
            $html .='</div>';
            $html .='</div>';
        }else{
            $html = '';
        }
        return $html;
    }
    
}