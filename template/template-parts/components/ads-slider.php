<?php
//$get_id = get_query_var('get_id');
$args = [
    'post_type' => 'coltman_addic_clinic',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    //'post__not_in' => [$get_id],
    'orderby' => 'title',
    'order' => 'ASC',
    'meta_key' => 'show_on_slider_ads',
    'meta_value' => 'on',
    'tax_query' => [
        [
            'taxonomy' => 'coltman_type_membership',
            'field' => 'slug',
            'terms' => 'payment-membership'
        ]
    ]
];

$free_rehabs = new WP_Query($args);
?>
<section  class="ads-section">
<?php echo coltman_get_template_slug_part('components/ads','info'); ?>
   <div class="ads-pink-section slider-pink">
        <div class="clinic-container">
            <div class="ads-slider">
                <div class="swiper-wrapper">
                <?php if($free_rehabs->have_posts()):
                    while($free_rehabs->have_posts()): $free_rehabs->the_post(); 
                    ?>
                    <div class="swiper-slide swiper-slider-item">
                        <?php 
                        set_query_var('card_info', [ 'post'=>get_post(get_the_ID()),'have_category'=>'true', 'limit'=>5, 'have_gallery'=>'true','words'=>40,'have_button'=>true]);
                        echo coltman_get_template_slug_part('components/rehab','card'); 
                        
                        ?>
                    </div>
                    <?php
                endwhile;
                endif; 
                wp_reset_postdata();
                ?>
                </div>
                <div class="ads-carousel-pagination"></div>
            </div>
        </div>
   </div>
</section>