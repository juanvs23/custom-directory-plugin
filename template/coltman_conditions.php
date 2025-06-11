<?php
get_header();
$post = get_queried_object();
$header_title = get_term_meta($post->term_id, 'header_title', true);
$title = isset($header_title) && $header_title !='' ? $header_title : get_queried_object()->name;
$description = get_queried_object()->description;
$tem_image = get_term_meta($post->term_id, 'banner_image', true);
$content_blocks = get_term_meta($post->term_id, 'content_blocks_ama', true);
$faqs_items = get_term_meta($post->term_id, 'faq_accordeon', true);
$auto_generate_blocks_title = get_term_meta($post->term_id, 'group_block_title_ama', true);
$auto_generate_blocks_content = get_term_meta($post->term_id, 'group_block_content_ama', true);
$content_blocks_parent = get_term_meta($post->parent, 'content_blocks_ama', true);
$content_faqs_parent = get_term_meta($post->parent, 'faq_accordeon', true);
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
                'terms' => $post->term_id
            ]
        ]
    ]
);

/*Content blocks*/ 
$content_blocks_ama =  isset($content_blocks) && !empty($content_blocks) && $content_blocks !== '[]' && $content_blocks !== ''  ? $content_blocks : '';
$content_blocks_auto_title = isset($auto_generate_blocks_title) && !empty($auto_generate_blocks_title) && $auto_generate_blocks_title !== '[]' && $auto_generate_blocks_title !== ''  ? $auto_generate_blocks_title : '';
$content_blocks_auto_content = isset($auto_generate_blocks_content) && !empty($auto_generate_blocks_content) && $auto_generate_blocks_content !== '[]' && $auto_generate_blocks_content !== ''  ? $auto_generate_blocks_content : '';
$content_blocks_parent_items =  isset($content_blocks_parent) && !empty($content_blocks_parent) && $content_blocks_parent !== '[]' && $content_blocks_parent !== ''  ? $content_blocks_parent : '';

if($content_blocks_ama !== ''){
    $content_block_definitive = $content_blocks_ama;
}else if($content_blocks_auto_content !== '' && $content_blocks_auto_title !== ''){
     $content_block_definitive = json_encode([['id' => uniqid(), 'title' => $content_blocks_auto_title, 'content' => $content_blocks_auto_content, 'image' => '']]);
}else if($content_blocks_parent_items !== ''){
    $content_block_definitive = $content_blocks_parent_items;
}else{
    $content_block_definitive = '';
}

/*FAQs*/ 
$content_faqs_ama = isset($faqs_items) && !empty($faqs_items) && $faqs_items !== '[]' && $faqs_items !== ''  ? $faqs_items : '';
$content_faqs_auto = [] ;
if( $content_faqs_auto == []){
    for($int = 1; $int <= 7; $int++){

        $temp_faq_title = get_term_meta($post->term_id, 'faq_ama_group_faq_title_'.$int, true);
        $temp_faq_content = get_term_meta($post->term_id, 'faq_ama_group_faq_content_'.$int, true);

        $faq_ama_title_sanitized = isset($temp_faq_title) && !empty($temp_faq_title) && $temp_faq_title !== '[]' && $temp_faq_title !== ''  ? $temp_faq_title : '';
        $faq_ama_content_sanitized = isset($temp_faq_content) && !empty($temp_faq_content) && $temp_faq_content !== '[]' && $temp_faq_content !== ''  ? $temp_faq_content : '';
    
        if($faq_ama_title_sanitized !== '' && $faq_ama_content_sanitized !== ''){
            array_push($content_faqs_auto, ['id' => uniqid(), 'title' => get_term_meta($post->term_id, 'faq_ama_group_faq_title_'.$int, true), 'content' => get_term_meta($post->term_id, 'faq_ama_group_faq_content_'.$int, true), 'image' => '' ]);
        }

    }
}
$content_faqs_parent_items = isset($content_faqs_parent) && !empty($content_faqs_parent) && $content_faqs_parent !== '[]' && $content_faqs_parent !== ''  ? $content_faqs_parent : '';

if($content_faqs_ama !== ''){
    $faqs_items_definitive = $content_faqs_ama;
}else if( $content_faqs_auto !== []){
    $faqs_items_definitive = json_encode($content_faqs_auto);
}else if($content_faqs_parent_items !== ''){
    $faqs_items_definitive = $content_faqs_parent_items;
}else{
    $faqs_items_definitive = json_encode([]);
}

set_query_var('rehab_content', ['content' => $content,'total'=>count( $get_total_posts),'title'=>'<span class="counter-title">'.count( $get_total_posts). '</span>'.' Rehab Centers were found','faq_accordeon'=>$faqs_items_definitive, 'content_blocks_ama' => $content_block_definitive ]);
echo coltman_get_template_slug_part('components/rehabs','counter');
set_query_var('ads_info', ['type' => 'carousel']);
set_query_var('have_gallery','true');
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