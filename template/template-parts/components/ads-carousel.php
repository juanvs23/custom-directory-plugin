<?php
$get_id = get_query_var('get_id');
$have_gallery = get_query_var('have_gallery')? get_query_var('have_gallery') : 'true';
$have_category = get_query_var('have_category')? get_query_var('have_category') : 'false';
$args = [
    'post_type' => 'coltman_addic_clinic',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'post__not_in' => [$get_id],
    'orderby' => 'date',
    'order' => 'DESC',
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
   <div class="ads-pink-section">
        <div class="clinic-container">
            <div class="ads-carousel">
                <div class="swiper-wrapper">
                <?php if($free_rehabs->have_posts()):
                    while($free_rehabs->have_posts()): $free_rehabs->the_post();
                    ?>
                    <div class="swiper-slide swiper-carousel-item">
                        <?php 
                        set_query_var('card_info', [ 'post'=>get_post(get_the_ID()),'have_category'=>$have_category, 'have_gallery'=>$have_gallery,'words'=>25,'limit'=>3,'have_button'=>true]);
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