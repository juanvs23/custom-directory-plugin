<?php
get_header();
/**
 *  Begin loop
 */

$title = get_the_title();
$post = get_queried_object();

$post_id = $post->ID;


//fields:
$rehab_price_range = get_post_meta( $post_id, 'rehab_price_range', true ); 
$rehab_rating = get_post_meta( $post_id, 'rehab_rating', true );
$rehab_verified = get_post_meta( $post_id, 'rehab_verified', true );
$rehab_claimed = get_post_meta( $post_id, 'rehab_claimed', true );
$rehab_insurance = get_post_meta( $post_id, 'rehab_insurance', true );
$rehab_language = get_post_meta( $post_id, 'rehab_language', true );
$rehab_address = get_post_meta( $post_id, 'rehab_address', true );
$rehab_description = get_post_meta( $post_id, 'rehab_description', true );
$rehab_city = get_post_meta( $post_id, 'rehab_city', true );
$rehab_state = get_post_meta( $post_id, 'rehab_state', true );
$rehab_phone = get_post_meta( $post_id, 'rehab_phone', true );
$rehab_email = get_post_meta( $post_id, 'rehab_email', true );
$rehab_website = get_post_meta( $post_id, 'rehab_website', true );
$rehab_image_banner = get_post_meta( $post_id, 'rehab_video_preload', true );
$rehab_video_url = get_post_meta( $post_id, 'rehab_video_url', true );
$rehab_level_of_care = get_post_meta( $post_id, 'rehab_level_of_care', true ) && get_post_meta( $post_id, 'rehab_level_of_care', true ) != ""? get_post_meta( $post_id, 'rehab_level_of_care', true ) : "[]";
// var_dump($rehab_level_of_care);
$rehab_highlight_blocks = get_post_meta( $post_id, 'rehab_highlight_blocks', true );
$rehab_staff_title_section = get_post_meta( $post_id, 'rehab_staff_title_section', true );
$rehab_staff_description_section = get_post_meta( $post_id, 'rehab_staff_description_section', true );
$rehab_staff = get_post_meta( $post_id, 'rehab_staff', true );
$rehab_staff_members = get_post_meta( $post_id, 'rehab_staff_members', true );
$rehab_google_maps = get_post_meta( $post_id, 'rehab_google_maps', true );
$rehab_faq = get_post_meta( $post_id, 'rehab_faq', true );
$rehab_image_gallery = get_post_meta( $post_id, 'rehab_image_gallery', true );
$first_image = is_iterable(json_decode($rehab_image_gallery)) && $rehab_image_gallery !="[]" ? json_decode($rehab_image_gallery)[0]->url : ADDIC_CLINIC_PLUGIN_URL.'assets/frontend/image/single-default.webp'; 
$featured_image = get_the_post_thumbnail_url()?get_the_post_thumbnail_url():$first_image;
//var_dump($rehab_image_gallery);
$coltman_type_membership = get_the_terms( $post_id, 'coltman_type_membership' )[0]; // "free-membership" or "premium-membership"



set_query_var('header_info', ['title' => $title, 'featured_image' => $featured_image]);
echo coltman_get_template_slug_part('bannerpage'); //bannerpage.php

echo '<main id="rehab-content" class="single-rehab" style="margin-bottom: 80px;">';
set_query_var('rehab_info_buttons', [
   'phone' => $rehab_phone,
   'email' => $rehab_email,
   'website' => $rehab_website
]);


/*
 * Ads rehab premium  carousel (free) 
 */
if($coltman_type_membership->slug === 'free-membership'): 
set_query_var('get_id', $post_id);
echo coltman_get_template_slug_part('components/ads','slider');
endif;
/**
 * Green rehab line (only premium)
 */
// var_dump($coltman_type_membership);
if($coltman_type_membership->slug === 'payment-membership'):
?>
<section id="green-rehab-banner" class="section-container">
    <div class="clinic-container green-rehab-banner-content">
        <div class="block-left">
            <div class="image-block">
                <img src="<?php echo $featured_image; ?>" alt="<?php echo $title; ?>">
            </div>
            <div class="rehab-info">
                <h2 class="green-title left-title"><?php echo $title; ?></h2>
                <p class="green-address"><?php echo $rehab_address; ?></p>
            </div>
        </div>
        <div class="block-right">
            <div class="rehabs-buttons">
                <?php echo coltman_get_template_slug_part('components/rehab_info_buttons'); ?>
            </div>
        </div>
    </div>
</section>
<?php
endif;
/** 
 * Gallery section 
*/
//var_dump($rehab_image_banner);
/* $rehab_image_gallery
$rehab_image_banner
$rehab_video_url */
echo '<section id="rehab-gallery" class="section-container">';
echo '<div class="clinic-container rehab-gallery-content">';
// Video and gallery
if(isset($rehab_video_url) && $rehab_video_url !='' && $coltman_type_membership->slug !== 'free-membership'):
    set_query_var('rehab_image_gallery_video', ['gallery'=>$rehab_image_gallery,'video'=>$rehab_video_url,'preload'=>$rehab_image_banner]);
    echo coltman_get_template_slug_part('components/gallery_video');
    
else:    
    set_query_var('rehab_image_gallery', ['gallery'=>$rehab_image_gallery,'isPayment'=>$coltman_type_membership->slug]);
// only gallery
echo coltman_get_template_slug_part('components/gallery_thumbnails');
endif;

echo '</div>';
echo '</section>';
/**
 * Card rehab information
 */
echo '<section id="rehab-info" class="section-container">';
echo '<div class="clinic-container">';

set_query_var('rehab_info', [
    'price_range' => $rehab_price_range,
    'rating' => $rehab_rating,
    'verified' => $rehab_verified,
    'claimed' => $rehab_claimed,
    'insurance' => $rehab_insurance,
    'language' => $rehab_language,
    'address' => $rehab_address,
    'description' => $rehab_description,
    'city' => $rehab_city,
    'state' => $rehab_state,
]);
echo coltman_get_template_slug_part('components/rehab_info');
echo '</div>';
echo '</section>';
/**
 * Ads rehab premium  slider (free) 
 */
// if($coltman_type_membership->slug === 'free-membership'): 
//     echo coltman_get_template_slug_part('components/ads','carousel');
// endif;
/**
 * Insurance section
 */

            set_query_var('insurances_list', [
                'post_id' => $post_id,
                'taxonomy' => 'coltman_insurance_method',
                'pay_membership' => $coltman_type_membership->slug
            ]);
            echo coltman_get_template_slug_part('components/insurances');
           
 /**
  * Level of care section
  */

  $get_level_care =[];
  
  if(isset($rehab_level_of_care) && count(json_decode($rehab_level_of_care))>0){
      $rehab_level_of_care = json_decode($rehab_level_of_care);
      foreach($rehab_level_of_care as $level){
          $get_level_care[] = [
          'id' => $level->id,
          'title' => $level->title,
          'content' => $level->content
        ];
      };

  }else{
      
      $level_terms = get_the_terms($post_id, 'coltman_level_care');

      foreach($level_terms as $level_term){
        if($level_term->parent == 0 ){
            $get_level_care[] = [
                'id' => $level_term->term_id,
                'title' => $level_term->name,
                'content' => $level_term->description
              ];
        }
        
      };
  }
  if( count($get_level_care) > 0 ){
    set_query_var('level_care', ['get_level_care' => $get_level_care, 'level_title'=>'Level Of Care', 'level_text'=>'']);
    echo coltman_get_template_slug_part('components/tab','level_care');
  }

 /**
  * Conditions  section
  */
  if(!is_wp_error(wp_get_post_terms($post_id, 'coltman_conditions'))):
    if(count(wp_get_post_terms($post_id, 'coltman_conditions'))>0):
    ?>
    
    <section id="condicions" class="section-container">
        <div class="clinic-container" >
            <?php
            set_query_var('conditions_list', ['post_id' => $post_id, 'taxonomy' => 'coltman_conditions'] );
            echo coltman_get_template_slug_part('components/conditions');
            ?>
        </div>
    </section>
    <?php
    endif;
    endif;
/**
 * Especialities section
 */
if($rehab_highlight_blocks):
     set_query_var('especialities_list', $rehab_highlight_blocks );
    // var_dump($rehab_highlight_blocks);
       echo coltman_get_template_slug_part('components/especialities');
?>

<?php
/*
* Ads rehab premium  carousel (free) 
*/
if($coltman_type_membership->slug === 'free-membership'):
    echo coltman_get_template_slug_part('components/ads','carousel');
endif;
endif;

/**
 * profesional staff section
 */
if($rehab_staff_members && $rehab_staff_members!='' && $rehab_staff && $rehab_staff=='on'):
$staff_title = isset($rehab_staff_title_section) && $rehab_staff_title_section != '' ? $rehab_staff_title_section : 'Professional Staff';
$rehab_staff_description = isset($rehab_staff_description_section) && $rehab_staff_description_section !='' ? $rehab_staff_description_section :   'Meet the dedicated team that will support and care for you throughout your rehabilitation journey. From skilled therapists to compassionate caregivers, they are here to ensure your recovery is their top priority.';

?>
<section id="staff" class="section-container professional-staff">
    <div class="clinic-container">
        <div class="proffesional-staff">
            <h2 class="professional-title">
             <?php echo $staff_title;?>
            </h2>
            <div class="staff-description">
                <?php echo $rehab_staff_description;?>
            </div>
            <?php
            set_query_var('staff_list', json_decode($rehab_staff_members) );
            echo coltman_get_template_slug_part('components/staff','members');
            ?>
        </div>
    </div>
</section>

<?php
/*
* Ads rehab premium  carousel (free)
*/
/* if($coltman_type_membership->slug === 'free-membership'):
    echo coltman_get_template_slug_part('components/ads','carousel');
endif; */
endif;
/**
 * Reviews section 
 */
set_query_var('google_review',['post_id'=>$post_id,'title'=>$title,'address'=>$rehab_address]);
echo coltman_get_template_slug_part('components/google','review');
 /**
  * Google map section
  */
  if($rehab_google_maps):
?>
<section id="google-map-section" class="section-container">
    <div class="clinic-container">
        <?php
        /*
        $rehab_google_maps
        $rehab_address
        $title
        $rehab_phone
        $phone_number = trim(preg_replace('/[^0-9]/', '', $rehab_phone));
        */
        set_query_var('rehab_google_maps', ['map'=>$rehab_google_maps,'address'=>$rehab_address,'title'=>$title,'phone_number'=>$rehab_phone]);
        echo coltman_get_template_slug_part('components/google_map');
        ?>
    </div>
</section>
<?php
if($coltman_type_membership->slug === 'free-membership'):
    echo coltman_get_template_slug_part('components/ads','carousel');
endif;
endif;
/**
 * Faq section
 */
if ($rehab_faq && $rehab_faq!='') {
    # code...
if( is_iterable(json_decode($rehab_faq)) ):
    ?>
    <section id="faq" class="section-container" style="margin-top:60px; margin-bottom:70px;">
        <div class="clinic-container">
            <?php
            set_query_var('faq_list', json_decode($rehab_faq) );
        // print_r(json_decode($rehab_faq));
            echo coltman_get_template_slug_part('components/section','faq');
            ?>
        </div>
    </section>
    <?php
endif;
}
echo '</main>';
get_footer();