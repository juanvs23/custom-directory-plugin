<?php
/*
$rehab_price_range
$rehab_rating
$rehab_verified 
$rehab_claimed
$rehab_insurance
$rehab_language
$rehab_address
$rehab_description
$rehab_city
$rehab_state
$rehab_phone
$rehab_email
$rehab_website
*/
$rehab_info = get_query_var('rehab_info');
$rehab_price_range = $rehab_info['price_range'];
$rehab_rating = $rehab_info['rating'];
$rehab_verified = $rehab_info['verified'];
$rehab_claimed = $rehab_info['claimed'];
$rehab_insurance = $rehab_info['insurance'];
$rehab_language = $rehab_info['language'];
$rehab_address = $rehab_info['address'];
$rehab_description = $rehab_info['description'];
$rehab_city = $rehab_info['city'];
$rehab_state = $rehab_info['state'];
$rehab_address = !empty($rehab_address) ?$rehab_address : $rehab_city . ', ' . $rehab_state;
?>
<div class="rehab-info-content">
    <div class="info-cardd">
        <div class="info-left">
            <div class="top-info">
                <div class="info-city">
                    <address class="info-city-name"><?php echo $rehab_address; ?></address>
                </div>
                <?php
                echo get_template_rating_badget($rehab_rating,get_permalink(get_the_ID()),'');
                ?>
            </div>
            <div class="middle-info">
                <div class="info-site-title">
                    <h2><?php echo get_the_title(); ?></h2>
                </div>
            
                <?php if(isset($rehab_verified ) && $rehab_verified  !== ''):?>
                    <div class="verified">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                            <rect y="0.5" width="20" height="20" rx="10" fill="#52776C"/>
                            <path d="M8.24675 15.0833L4.16699 10.7382L5.18693 9.65194L8.24675 12.9108L14.8137 5.91666L15.8337 7.00294L8.24675 15.0833Z" fill="white"/>
                        </svg>
                        <p>
                        Verified
                        </p>
                    </div>
                <?php endif;?>
                <?php if(isset($rehab_claimed ) && $rehab_claimed  !== ''):?>
                    <div class="rehab_claimed">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                            <rect y="0.5" width="20" height="20" rx="10" fill="#A9E2D1"/>
                            <path d="M7.37548 14.5208L10.0005 12.9375L12.6255 14.5417L11.938 11.5417L14.2505 9.54167L11.2088 9.27083L10.0005 6.4375L8.79215 9.25L5.75048 9.52083L8.06298 11.5417L7.37548 14.5208ZM6.10465 16.2692L7.13798 11.8417L3.70215 8.865L8.22798 8.47333L10.0005 4.2975L11.773 8.4725L16.298 8.86417L12.8621 11.8408L13.8963 16.2683L10.0005 13.9183L6.10465 16.2692Z" fill="#52776C" stroke="#52776C" stroke-width="0.5"/>
                        </svg>
                        <p>
                        Claimed
                        </p>
                    </div> 
                <?php endif;?>
            </div>
            <div class="bottom-info">
                <?php if(isset($rehab_price_range) && $rehab_price_range !== ''):?>
                    <div class="price">
                        <div class="price-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M22.5738 6.06726C22.5197 6.03349 22.458 6.01404 22.3943 6.01076C22.3307 6.00748 22.2672 6.02047 22.21 6.04851C18.0503 8.08101 15.1066 7.13977 11.9913 6.14226C8.87594 5.14476 5.64344 4.1107 1.21 6.27539C1.14689 6.30631 1.09373 6.35435 1.0566 6.41403C1.01947 6.4737 0.99986 6.54261 1 6.61289V17.8629C0.999873 17.9266 1.01599 17.9893 1.04683 18.0451C1.07767 18.1009 1.12221 18.1479 1.17625 18.1816C1.23029 18.2154 1.29205 18.2349 1.3557 18.2381C1.41934 18.2414 1.48277 18.2284 1.54 18.2004C5.69969 16.1679 8.64344 17.1091 11.7588 18.1066C13.5269 18.6691 15.3288 19.2495 17.365 19.2495C18.9222 19.2495 20.6172 18.912 22.5381 17.9735C22.6012 17.9426 22.6544 17.8946 22.6915 17.8349C22.7287 17.7752 22.7483 17.7063 22.7481 17.636V6.38601C22.7485 6.32246 22.7326 6.25987 22.7021 6.20411C22.6716 6.14835 22.6274 6.10127 22.5738 6.06726ZM22 17.3998C17.9509 19.3001 15.0531 18.3729 11.9894 17.3923C10.2213 16.8298 8.41938 16.2504 6.38313 16.2504C4.97688 16.2504 3.45063 16.5316 1.75 17.276V6.84914C5.79906 4.94883 8.69688 5.87601 11.7606 6.85664C14.7531 7.81195 17.8441 8.80289 22 6.97289V17.3998ZM11.875 9.49945C11.3558 9.49945 10.8483 9.65341 10.4166 9.94184C9.98495 10.2303 9.6485 10.6403 9.44982 11.1199C9.25114 11.5996 9.19915 12.1274 9.30044 12.6366C9.40172 13.1458 9.65173 13.6135 10.0188 13.9806C10.386 14.3477 10.8537 14.5977 11.3629 14.699C11.8721 14.8003 12.3999 14.7483 12.8795 14.5496C13.3592 14.351 13.7692 14.0145 14.0576 13.5828C14.346 13.1511 14.5 12.6436 14.5 12.1245C14.5 11.4283 14.2234 10.7606 13.7312 10.2683C13.2389 9.77601 12.5712 9.49945 11.875 9.49945ZM11.875 13.9995C11.5042 13.9995 11.1416 13.8895 10.8333 13.6835C10.525 13.4774 10.2846 13.1846 10.1427 12.842C10.0008 12.4994 9.96368 12.1224 10.036 11.7587C10.1084 11.3949 10.287 11.0609 10.5492 10.7986C10.8114 10.5364 11.1455 10.3578 11.5092 10.2855C11.8729 10.2131 12.2499 10.2503 12.5925 10.3922C12.9351 10.5341 13.228 10.7744 13.434 11.0828C13.64 11.3911 13.75 11.7536 13.75 12.1245C13.75 12.6217 13.5525 13.0986 13.2008 13.4503C12.8492 13.8019 12.3723 13.9995 11.875 13.9995ZM4.75 9.12445V13.6245C4.75 13.7239 4.71049 13.8193 4.64017 13.8896C4.56984 13.9599 4.47446 13.9995 4.375 13.9995C4.27554 13.9995 4.18016 13.9599 4.10984 13.8896C4.03951 13.8193 4 13.7239 4 13.6245V9.12445C4 9.025 4.03951 8.92961 4.10984 8.85929C4.18016 8.78896 4.27554 8.74945 4.375 8.74945C4.47446 8.74945 4.56984 8.78896 4.64017 8.85929C4.71049 8.92961 4.75 9.025 4.75 9.12445ZM19 15.1245V10.6245C19 10.525 19.0395 10.4296 19.1098 10.3593C19.1802 10.289 19.2755 10.2495 19.375 10.2495C19.4745 10.2495 19.5698 10.289 19.6402 10.3593C19.7105 10.4296 19.75 10.525 19.75 10.6245V15.1245C19.75 15.2239 19.7105 15.3193 19.6402 15.3896C19.5698 15.4599 19.4745 15.4995 19.375 15.4995C19.2755 15.4995 19.1802 15.4599 19.1098 15.3896C19.0395 15.3193 19 15.2239 19 15.1245Z" fill="#52776C" stroke="#52776C" stroke-width="0.6"/>
</svg>
                        </div>
                        <p>
                            <?php echo $rehab_price_range; ?>
                        </p>
                    </div>
                <?php endif;?>
                <?php if(isset($rehab_insurance ) && $rehab_insurance  !== ''):?>
                    <div class="insurance">
                        <p>
                        <?php
                        echo isset($rehab_insurance) && $rehab_insurance  == 'on'? 'Insurance Acepted' : 'Cash Only' ; ?>
                        </p>
                    </div>
                <?php endif;?>
                <?php if(false):?>
                    <div class="language">
                        <p>
                        <?php echo get_term_by( 'term_id', $rehab_language, 'coltman_languages'  )->name; ?>
                        </p>
                    </div>
                <?php endif;?>
            </div>
            <div class="description-info">
                <?php if(isset($rehab_description) && $rehab_description != ''): ?>
                    <div class="content-block-ama-right">
                        <div class="content-block-ama-content">
                            <div class="content-block-wrapper">
                            <?php echo $rehab_description; ?>
                            </div>
                        </div>
                        <button class="btn-content-block-ama" data-open="View Less" data-close="View More">
                            <span>Read More</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                    <g clip-path="url(#clip0_108_4978)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.7073 16.2069C12.5198 16.3943 12.2655 16.4996 12.0003 16.4996C11.7352 16.4996 11.4809 16.3943 11.2933 16.2069L5.63634 10.5499C5.54083 10.4576 5.46465 10.3473 5.41224 10.2253C5.35983 10.1033 5.33225 9.97204 5.33109 9.83926C5.32994 9.70648 5.35524 9.5748 5.40552 9.4519C5.4558 9.329 5.53006 9.21735 5.62395 9.12346C5.71784 9.02957 5.82949 8.95531 5.95239 8.90503C6.07529 8.85475 6.20696 8.82945 6.33974 8.8306C6.47252 8.83176 6.60374 8.85934 6.72575 8.91175C6.84775 8.96416 6.9581 9.04034 7.05034 9.13585L12.0003 14.0859L16.9503 9.13585C17.1389 8.9537 17.3915 8.8529 17.6537 8.85518C17.9159 8.85746 18.1668 8.96263 18.3522 9.14804C18.5376 9.33344 18.6427 9.58426 18.645 9.84645C18.6473 10.1087 18.5465 10.3613 18.3643 10.5499L12.7073 16.2069Z" fill="#FFFFFF"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_108_4978">
                                        <rect width="24" height="24" fill="white" transform="translate(0 0.5)"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                        </button>
                    </div>
                <?php endif;?>
            </div>
        </div>
        <div class="info-right">
            <?php 
        
            $highlights = wp_get_post_terms( get_the_ID(), 'coltman_highlights',array( 'order' => 'ASC', 'orderby' => 'name' ) );
            echo coltman_get_terms_list([
                'taxonomy_title'=>'Highlights:', 
                'terms'=>$highlights,
                'link'=> true, 
                'imit'=> 5, 
                'toolip'=> false
            ] );

            $amenities = wp_get_post_terms( get_the_ID(), 'coltman_amenities',array( 'order' => 'ASC', 'orderby' => 'name' ) );
            echo coltman_get_terms_list([
                'taxonomy_title'=>'Amenities:', 
                'terms'=>$amenities,
                'link'=> false, 
                'imit'=> 5, 
                'toolip'=> false
            ] );
            $rehab_luxuries = get_the_terms( get_the_ID(), 'coltman_luxuries' );
            echo coltman_get_terms_list([
                'taxonomy_title'=>'Luxury:', 
                'terms'=>$rehab_luxuries,
                'link'=> true, 
                'imit'=> 5, 
                'toolip'=> false
            ] );

            $clients = wp_get_post_terms( get_the_ID(), 'coltman_clients',array( 'order' => 'ASC', 'orderby' => 'name' ) );
            echo coltman_get_terms_list([
                'taxonomy_title'=>'Clientele:', 
                'terms'=>$clients, 
                'link'=> true, 
                'imit'=> 5, 
                'toolip'=> true
            ] );

            $languages = wp_get_post_terms( get_the_ID(), 'coltman_languages',array( 'order' => 'ASC', 'orderby' => 'name' ) );
            echo coltman_get_terms_list([
                'taxonomy_title'=>'Languages:', 
                'terms'=>$languages,
                'link'=> true,
                'imit'=> 3, 
                'toolip'=> false
            ] );
            ?>
        </div>
    </div>
    <div class="rehabs-buttons">

       
        <?php echo coltman_get_template_slug_part('components/rehab_info_buttons'); ?>
    </div>
</div>