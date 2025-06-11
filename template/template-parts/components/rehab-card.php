<?php
$card_info = get_query_var('card_info');
$post = $card_info['post'];
$post_id = $post->ID;
$limit = $card_info['limit']?$card_info['limit']:3;
$extra_class = isset($card_info['extra_class'])?$card_info['extra_class']:'';
$have_category = $card_info['have_category'];
$have_gallery = $card_info['have_gallery'];
$words =isset( $card_info['words'])?$card_info['words']:25;
$have_button = isset($card_info['have_button'])?$card_info['have_button']:'false';
$rehab_price_range = get_post_meta( $post_id, 'rehab_price_range', true ); 
$rehab_rating = get_post_meta( $post_id, 'rehab_rating', true );
$rehab_verified = get_post_meta( $post_id, 'rehab_verified', true );
$rehab_claimed = get_post_meta( $post_id, 'rehab_claimed', true );
$rehab_description = get_post_meta( $post_id, 'rehab_description', true );
$rehab_city = get_post_meta( $post_id, 'rehab_city', true ) =='Not found'?'N/A':get_post_meta( $post_id, 'rehab_city', true );
$rehab_state = get_post_meta( $post_id, 'rehab_state', true ) =='Not found'?'N/A':get_post_meta( $post_id, 'rehab_state', true );
$rehab_phone = get_post_meta( $post_id, 'rehab_phone', true );
$rehab_email = get_post_meta( $post_id, 'rehab_email', true );
$rehab_website = get_post_meta( $post_id, 'rehab_website', true );

$rehab_image_gallery = json_decode(get_post_meta( $post_id, 'rehab_image_gallery', true ));
$have_button = $have_button!='false'?true:false;
$first_image = is_iterable($rehab_image_gallery) && count($rehab_image_gallery)!=0? $rehab_image_gallery[0]->url : ADDIC_CLINIC_PLUGIN_URL.'assets/frontend/image/single-default.webp'; 

$image = get_the_post_thumbnail_url( $post->ID, 'full' )?get_the_post_thumbnail_url( $post->ID, 'full'):$first_image;
?>
<article class="rehab-card <?php echo $extra_class;?>">
    <div class="rehab-content">
        <div class="rehab-image">
            <?php
            if($have_gallery == 'true'):
            ?>
            <div class="rehab-card-gallery">
                <div class="swiper-wrapper">
                    <div class="swiper-slide rehab-card-image">
                        <a href="<?php echo get_the_permalink(); ?>">
                        <img src="<?php echo $image;?>" alt="<?php echo $post->post_title;?>" loading="lazy" async />
                        </a>
                    </div>
                    <?php foreach($rehab_image_gallery as $image):  ?>
                       <?php 
                            $image_url = $image->url;
                            $image_id = $image->id;
                            $image_title = $image->title;
                            $image_alt = $image->alt;

                            $alternative = $image_alt !=''?? $image_alt ?? $image_title ?? $image_is;
                       ?>
                        <div class="swiper-slide rehab-card-image">
                            <a href="<?php echo get_the_permalink(); ?>">
                            <img src="<?php echo $image_url;?>" alt="<?php echo $alternative;?>" loading="lazy" async />
                            </a>
                        </div>
                    <?php  endforeach; ?>
                </div>
                <div class="rehab-card-gallery-pagination"></div>
            </div>
            <?php else: ?>
                <div class="rehab-iamge">
                    <a href="<?php echo get_the_permalink(); ?>">
                    <img src="<?php echo $image;?>" alt="<?php echo $post->post_title;?>" loading="lazy" async />
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="rehab-info">
            <div class="rehab-card-title">
                <div class="top-info">
                    <div class="info-city">
                        <a href="<?php echo get_the_permalink(); ?>">
                            <address class="info-city-name"><?php echo $rehab_city; ?>, <?php echo $rehab_state; ?></address>
                        </a>
                    </div>
                    <?php
                    echo get_template_rating_badget($rehab_rating,get_the_permalink(),'');
                    ?>

                </div>
                <div class="middle-info">
                <div class="info-site-title">
                    <a href="<?php echo get_the_permalink(); ?>">
                        <h2><?php echo get_the_title(); ?></h2>
                    </a>
                </div>
                <div class="info-rehab-symbols">
                    <?php if(isset($rehab_verified ) && $rehab_verified  !== ''):?>
                        <div class="verified">
                            <a href="<?php echo get_the_permalink(); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                <rect y="0.5" width="20" height="20" rx="10" fill="#52776C"/>
                                <path d="M8.24675 15.0833L4.16699 10.7382L5.18693 9.65194L8.24675 12.9108L14.8137 5.91666L15.8337 7.00294L8.24675 15.0833Z" fill="white"/>
                            </svg>
                            </a>
                        </div>
                    <?php endif;?>
                    <?php if(isset($rehab_claimed ) && $rehab_claimed  !== ''):?>
                        <div class="rehab_claimed">
                            <a href="<?php echo get_the_permalink(); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                <rect y="0.5" width="20" height="20" rx="10" fill="#A9E2D1"/>
                                <path d="M7.37548 14.5208L10.0005 12.9375L12.6255 14.5417L11.938 11.5417L14.2505 9.54167L11.2088 9.27083L10.0005 6.4375L8.79215 9.25L5.75048 9.52083L8.06298 11.5417L7.37548 14.5208ZM6.10465 16.2692L7.13798 11.8417L3.70215 8.865L8.22798 8.47333L10.0005 4.2975L11.773 8.4725L16.298 8.86417L12.8621 11.8408L13.8963 16.2683L10.0005 13.9183L6.10465 16.2692Z" fill="#52776C" stroke="#52776C" stroke-width="0.5"/>
                            </svg>
                            </a>
                        </div> 
                    <?php endif;?>

                </div>
                </div>
                <div class="bottom-info">
                <?php if(isset($rehab_price_range) && $rehab_price_range !== '' ):?>
                    <div class="price">
                        <p>
                            <a href="<?php echo get_the_permalink(); ?>">
                            <?php echo $rehab_price_range != 'Not found'? $rehab_price_range : "N/A" ; ?>
                            </a>
                        </p>
                    </div>
                <?php endif;?>
            </div>
            <div class="description-info">
                <a href="<?php echo get_the_permalink(); ?>">
                    
                <?php echo coltman_trim_by_chars_fn($rehab_description, 150); ?>
                </a>
            </div>
            <?php if(false):?>
                <div class="rehab-card-tax">
                    <?php
                    $highlights = wp_get_post_terms( $post_id, 'coltman_highlights',array( 'order' => 'ASC', 'orderby' => 'name' ) );
                    echo coltman_get_terms_list([
                        'taxonomy_title'=>'', 
                        'terms'=>$highlights,
                        'link'=> true, 
                        'imit'=> $limit, 
                        'toolip'=> false,
                        'have_button'=>$have_button
                    ] );
        
                    echo '<div class="rehab_amenities">';
                    $amenities = wp_get_post_terms( $post_id, 'coltman_amenities',array( 'order' => 'ASC', 'orderby' => 'name' ) );
                    echo coltman_get_terms_list([
                        'taxonomy_title'=>'', 
                        'terms'=>$amenities,
                        'link'=> false, 
                        'imit'=> $limit, 
                        'toolip'=> false,
                        'have_button'=>$have_button
                    ] );
                    echo '</div>';
                    ?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>
<div class="rehab-card-button">
    <a href="<?php echo get_the_permalink(); ?>" class="button">
        <span>Discover</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="15" viewBox="0 0 9 15" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.6564 6.68963C8.87641 6.9009 9 7.18741 9 7.48616C9 7.7849 8.87641 8.07141 8.6564 8.28268L2.01766 14.6561C1.90941 14.7637 1.77991 14.8495 1.63673 14.9085C1.49356 14.9676 1.33956 14.9987 1.18374 15C1.02792 15.0013 0.873388 14.9728 0.729164 14.9161C0.58494 14.8595 0.45391 14.7758 0.343723 14.67C0.233536 14.5642 0.146396 14.4384 0.0873895 14.3C0.0283827 14.1615 -0.00130979 14.0132 4.42599e-05 13.8636C0.00139831 13.714 0.033772 13.5661 0.0952763 13.4287C0.156781 13.2912 0.246183 13.1669 0.358269 13.063L6.16732 7.48616L0.358268 1.90932C0.144498 1.69683 0.0262111 1.41224 0.028885 1.11684C0.0315588 0.821445 0.154979 0.53887 0.372564 0.329983C0.590148 0.121096 0.884488 0.00260826 1.19219 4.09559e-05C1.49989 -0.0025254 1.79633 0.111032 2.01766 0.316258L8.6564 6.68963Z" fill="white"/>
        </svg>
    </a>
</div>
</article>