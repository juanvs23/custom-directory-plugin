<?php

if(!function_exists('coltman_get_rehab_card')){
    function coltman_get_rehab_card($rehab){
        $html = "";
        set_query_var('card_info', [ 'post'=>$rehab,'have_category'=>'true', 'have_gallery'=>'false','words'=>25,'limit'=>3]);
        //  $html .=  htmlspecialchars(json_encode(coltman_get_template_slug_part('components/rehab','card')));
          $card_info = get_query_var('card_info');
          $post = $card_info['post'];
          $post_id = $post->ID;
          $limit = $card_info['limit']?$card_info['limit']:3;
          $have_category = $card_info['have_category'];
          $have_gallery = $card_info['have_gallery'];
          $words = $card_info['words']?$card_info['words']:25;
         

          $rehab_price_range = get_post_meta( $post_id, 'rehab_price_range', true ); 
          $rehab_rating = get_post_meta( $post_id, 'rehab_rating', true );
          $rehab_verified = get_post_meta( $post_id, 'rehab_verified', true );
          $rehab_claimed = get_post_meta( $post_id, 'rehab_claimed', true );
          $rehab_description = get_post_meta( $post_id, 'rehab_description', true );
          $rehab_city = get_post_meta( $post_id, 'rehab_city', true );
          $rehab_state = get_post_meta( $post_id, 'rehab_state', true );
          $rehab_phone = get_post_meta( $post_id, 'rehab_phone', true );
          $rehab_email = get_post_meta( $post_id, 'rehab_email', true );
          $rehab_website = get_post_meta( $post_id, 'rehab_website', true );
          $rehab_image_gallery = json_decode(get_post_meta( $post_id, 'rehab_image_gallery', true ));
          $first_image = is_iterable($rehab_image_gallery) && count($rehab_image_gallery)!=0 ? $rehab_image_gallery[0]->url : ADDIC_CLINIC_PLUGIN_URL.'assets/frontend/image/single-default.webp'; 

            $image = get_the_post_thumbnail_url( $post->ID, 'full' )?get_the_post_thumbnail_url( $post->ID, 'full'):$first_image;


          $html .='<article class="rehab-card rehab-hidden"><div class="rehab-content"><div class="rehab-image">';
     
        
              $html .= '<div class="rehab-iamge">';
              $html .= '<img src="'.$image.'" alt="'.$post->post_title.'" loading="lazy" async />';
              $html .= '</div>';
      $html .= '</div>';
      $html .= '<div class="rehab-info">';
      $html .= '<div class="rehab-card-title"><div class="top-info"><div class="info-city">';
      $html .= '<address class="info-city-name">'.$rehab_city.', '.$rehab_state.'</address>
              </div>
              <div class="rating-badget">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M5.825 21L7.45 13.975L2 9.25L9.2 8.625L12 2L14.8 8.625L22 9.25L16.55 13.975L18.175 21L12 17.275L5.825 21Z" fill="white"/>
                  </svg>';
      $html .= '<span class="rating">'.$rehab_rating.'</span>';
      $html .= '</div>';

      $html .= '</div>';
      $html .= '<div class="middle-info">';
      $html .= '<div class="info-site-title">';
      $html .= '<a href="'.get_the_permalink($post_id ).'">';
      $html .= '<h2>'.get_the_title($post_id ).'</h2>';
      $html .= '</a>';
      $html .= '</div><div class="info-rehab-symbols">';
          if(isset($rehab_verified ) && $rehab_verified  !== ''):
          $html .= '<div class="verified">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                          <rect y="0.5" width="20" height="20" rx="10" fill="#52776C"/>
                          <path d="M8.24675 15.0833L4.16699 10.7382L5.18693 9.65194L8.24675 12.9108L14.8137 5.91666L15.8337 7.00294L8.24675 15.0833Z" fill="white"/>
                      </svg> 
                  </div>';
          endif;
          if(isset($rehab_claimed ) && $rehab_claimed  !== ''):
          $html .= '<div class="rehab_claimed">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                          <rect y="0.5" width="20" height="20" rx="10" fill="#A9E2D1"/>
                          <path d="M7.37548 14.5208L10.0005 12.9375L12.6255 14.5417L11.938 11.5417L14.2505 9.54167L11.2088 9.27083L10.0005 6.4375L8.79215 9.25L5.75048 9.52083L8.06298 11.5417L7.37548 14.5208ZM6.10465 16.2692L7.13798 11.8417L3.70215 8.865L8.22798 8.47333L10.0005 4.2975L11.773 8.4725L16.298 8.86417L12.8621 11.8408L13.8963 16.2683L10.0005 13.9183L6.10465 16.2692Z" fill="#52776C" stroke="#52776C" stroke-width="0.5"/>
                      </svg>
                  </div>'; 
          endif;

              $html.='</div></div><div class="bottom-info">';
          if(isset($rehab_price_range) && $rehab_price_range !== ''):
              $html .= '<div class="price"><p>'.$rehab_price_range.'</p></div>';
          endif;
          $html .= '</div>';
          $html .= '<div class="description-info">'.coltman_trim_content_text_fn($rehab_description, $words).'</div>';
          if($have_category == 'true'):
          $html .= '<div class="rehab-card-tax">';
              
            //   $highlights = wp_get_post_terms( $post_id, 'coltman_highlights',array( 'order' => 'ASC', 'orderby' => 'name' ) );
            //   $html .=  coltman_get_terms_list([
            //       'taxonomy_title'=>'', 
            //       'terms'=>$highlights,
            //       'link'=> true, 
            //       'imit'=> $limit, 
            //       'toolip'=> false,
            //       'have_button'=>true
            //   ] );
  
              $html .= '<div class="rehab_amenities">';
            //   $amenities = wp_get_post_terms( $post_id, 'coltman_amenities',array( 'order' => 'ASC', 'orderby' => 'name' ) );
            //   $html .= coltman_get_terms_list([
            //       'taxonomy_title'=>'', 
            //       'terms'=>$amenities,
            //       'link'=> false, 
            //       'imit'=> $limit, 
            //       'toolip'=> false,
            //       'have_button'=>true
            //   ] );
              $html .= '</div>';
              
              $html .= '</div> </div>
  </div>
</div>';
          endif;
      $html .= '<div class="rehab-card-button">';
      $html .= '<a href="'.get_the_permalink($post_id ).'" class="button"><span>Discover</span>';
      $html .= '        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="15" viewBox="0 0 9 15" fill="none">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M8.6564 6.68963C8.87641 6.9009 9 7.18741 9 7.48616C9 7.7849 8.87641 8.07141 8.6564 8.28268L2.01766 14.6561C1.90941 14.7637 1.77991 14.8495 1.63673 14.9085C1.49356 14.9676 1.33956 14.9987 1.18374 15C1.02792 15.0013 0.873388 14.9728 0.729164 14.9161C0.58494 14.8595 0.45391 14.7758 0.343723 14.67C0.233536 14.5642 0.146396 14.4384 0.0873895 14.3C0.0283827 14.1615 -0.00130979 14.0132 4.42599e-05 13.8636C0.00139831 13.714 0.033772 13.5661 0.0952763 13.4287C0.156781 13.2912 0.246183 13.1669 0.358269 13.063L6.16732 7.48616L0.358268 1.90932C0.144498 1.69683 0.0262111 1.41224 0.028885 1.11684C0.0315588 0.821445 0.154979 0.53887 0.372564 0.329983C0.590148 0.121096 0.884488 0.00260826 1.19219 4.09559e-05C1.49989 -0.0025254 1.79633 0.111032 2.01766 0.316258L8.6564 6.68963Z" fill="white"/>
              </svg>
          </a>
      </div>
     
</article>';
        return $html;
    }
}