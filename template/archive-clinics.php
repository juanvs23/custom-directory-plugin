<?php
get_header();
$post = get_queried_object();
$title = get_queried_object()->label;
$featured_image = ADDIC_CLINIC_PLUGIN_URL.'assets/frontend/image/category-default.webp';
set_query_var('header_info', ['title' => $title, 'featured_image' => $featured_image]);
echo coltman_get_template_slug_part('bannerpage'); //bannerpage.php

$content = 'Our independent research team continuously gathers and evaluates data to compile an unbiased and thorough list of the best treatment centers for alcohol.';
$get_total_posts = get_posts(
    [
        'post_type' => 'coltman_addic_clinic',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ]
);


set_query_var('rehab_content', ['content' => $content,'total'=>count( $get_total_posts),'title'=>'<span class="counter-title">'.count( $get_total_posts). '</span>'.' Rehab Centers were found']);
echo coltman_get_template_slug_part('components/rehabs','counter');
set_query_var('ads_info', ['type' => 'carousel']);
set_query_var('have_gallery','true');
set_query_var('have_category','true');
echo  coltman_get_template_slug_part('components/ads','slider');

echo  coltman_get_template_slug_part('loops/loop','filter');
?>


<?php
echo '<div class="ads-container-carousel">';
echo coltman_get_template_slug_part('components/ads','carousel');
echo '</div>';

echo coltman_get_template_slug_part('loops/related','posts'); 
echo '<section class="clinic-section">';
echo '<div class="clinic-container">';
echo do_shortcode('[addic_filters_tab]');
echo '</div>';
echo '</section>';
get_footer();


