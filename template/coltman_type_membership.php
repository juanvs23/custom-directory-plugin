<?php
get_header();
$post = get_queried_object();
$header_title = get_term_meta($post->term_id, 'header_title', true);
$title = isset($header_title) && $header_title !='' ? $header_title : get_queried_object()->name;
$description = get_queried_object()->description;
$tem_image = get_term_meta($post->term_id, 'banner_image', true);
$content_blocks = get_term_meta($post->term_id, 'content_blocks_ama', true);
$faqs_items = get_term_meta($post->term_id, 'faq_accordeon', true);
$taxonomy = $post->taxonomy;
$featured_image = $tem_image!=''?$tem_image: ADDIC_CLINIC_PLUGIN_URL.'assets/frontend/image/category-default.webp';
set_query_var('header_info', ['title' => $title, 'featured_image' => $featured_image]);
echo coltman_get_template_slug_part('bannerpage'); //bannerpage.php

$content = $description!=''?$description: 'Our independent research team continuously gathers and evaluates data to compile an unbiased and thorough list of the best treatment centers for alcohol.';
$get_total_posts = get_posts(
    [
        'post_type' => 'coltman_addic_clinic',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'tax_query' => [
            [
                'taxonomy' => $post->taxonomy,
                'field' => 'term_id',
                'terms' => $post->term_id,
            ],
        ]
    ]
);

set_query_var('rehab_content', ['content' => $content,'total'=>count( $get_total_posts),'title'=>'<span class="counter-title">'.count( $get_total_posts). '</span>'.' Rehab Centers were found','faq_accordeon'=>isset($faqs_items) && !empty($faqs_items) && $faqs_items !== '[]' && $faqs_items !== ''  ? $faqs_items : json_encode([]) , 'content_blocks_ama' => isset($content_blocks) && !empty($content_blocks) && $content_blocks !== '[]' && $content_blocks !== ''  ? $content_blocks : '' ]);
echo coltman_get_template_slug_part('components/rehabs','counter');
set_query_var('ads_info', ['type' => 'carousel']);
set_query_var('have_gallery','false');
set_query_var('have_category','true');
echo  coltman_get_template_slug_part('components/ads','slider');

echo  coltman_get_template_slug_part('loops/loop','filter');
echo '<div class="ads-container-carousel">';
echo coltman_get_template_slug_part('components/ads','carousel');
echo '</div>';

echo coltman_get_template_slug_part('loops/related','posts'); 
echo '<section class="clinic-section">';
echo '<div class="clinic-container">';
echo do_shortcode('[addic_filters_tab current_filter="'.$taxonomy.'"]');
echo '</div>';
echo '</section>';
get_footer();