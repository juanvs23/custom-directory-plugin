<?php
if(!function_exists('rehabcta_fn')){

    function rehabcta_fn($atts){
        $atts = shortcode_atts(array(
            
        ),$atts,'rehabcta');
        
            $cta_cpt = get_post_type_object( 'coltman_addic_clinic' );
            $button_text = 'View All '.wp_count_posts('coltman_addic_clinic')->publish.' Centers';
            set_query_var( 'cta', [
	        'image' => LUXERCOVERY_THEME_URL . '/assets/img/mobile-cta.webp',
	'button'=>[
			'text' =>$button_text,
			'link' => get_bloginfo('url').'/'. $cta_cpt->has_archive
	],
	'title' =>  'Lorem Ipsum is simply dummy',
	'content' => 'Our independent research team continuously gathers and evaluates data to compile an unbiased and thorough list of the best treatment centers for alcohol.',
] );
get_template_part( 'template-parts/components/rehabcta' );
    }
    add_shortcode('rehabcta', 'rehabcta_fn');
}