<?php

if(!function_exists('clinic_list_carousel_fn')){
    function clinic_list_carousel_fn($atts){
        $atts = shortcode_atts( array(
            'tax'   => '', // taxonomy name
            'type'  => 'carousel', // carousel or grid
            'term'  =>'', // slug
            'only'  =>'', // only this id, explode by comma
            'have_category'=>'false', // true or false
            'have_gallery'=>'true', // true or false
            'orderby'=>'title',
            'words'=>25, // number of words
            'limit'=>3, // number of terms
            'limit_post' =>10
        ),$atts,'clinic_list_carousel');

        $arg_a = [
            'post_type' => 'coltman_addic_clinic',
            'post_status' => 'publish',
            'posts_per_page' => $atts['limit_post'],
            'orderby' => $atts['orderby'],
            'order' => 'ASC',
        ];
        $arg_b = [
            'post_type' => 'coltman_addic_clinic',
            'post_status' => 'publish',
            'posts_per_page' => $atts['limit_post'],
            'orderby' => $atts['orderby'],
            'order' => 'ASC',
            'tax_query' => [
                [
                    'taxonomy' => $atts['tax'],
                    'field' => 'slug',
                    'terms' => $atts['term']
                ]
            ]
        ];
        $args = ($atts['tax'] != '' && $atts['term'] != '') ? $arg_b : $arg_a;
       
        ob_start();
        ?>
        <div class="clinic-carousel-list clinic-container clinic-<?php echo $atts['type'];?> ">
            <?php if($atts['type'] == 'carousel'):?>
                <div class="clinic-swiper">
                    <div class="swiper-wrapper">
            <?php endif;
            if($atts['only']!=''):
                $only_posts = explode(',',$atts['only']);
                foreach($only_posts as $post_id):
                    $args['post__in'] = array_map('intval', $only_posts);
                    $args['orderby'] = 'post__in';
                    
                    if($atts['type'] == 'carousel'):?>
                            <div class="swiper-slide swiper-item">
                        <?php endif;?>
                        <?php
                            
                            set_query_var('card_info', [ 'post'=>get_post($post_id),'have_category'=>'false', 'have_gallery'=>'true','words'=>25,'limit'=>3]);
                            echo coltman_get_template_slug_part('components/rehab','card'); 
                        ?> 
                        <?php if($atts['type'] == 'carousel'):?>
                            </div>
                        <?php endif;
                endforeach;
                    else:
                 $free_rehabs = new WP_Query($args);
            ?>


                    <?php if($free_rehabs->have_posts()): while($free_rehabs->have_posts()): $free_rehabs->the_post(); ?>

                        <?php if($atts['type'] == 'carousel'):?>
                            <div class="swiper-slide swiper-item">
                        <?php endif;?>
                        <?php
                            
                            set_query_var('card_info', [ 'post'=>get_post(get_the_ID()),'have_category'=>'false', 'have_gallery'=>'true','words'=>25,'limit'=>3]);
                            echo coltman_get_template_slug_part('components/rehab','card'); 
                        ?> 
                        <?php if($atts['type'] == 'carousel'):?>
                            </div>
                        <?php endif;?>
                    <?php endwhile;
                    endif; 
                wp_reset_postdata();
                endif; ?>
            <?php if($atts['type'] == 'carousel'):?>
                    </div>
                    <div class="ads-carousel-pagination"></div>
                </div>
                <button class="clinic-carousel-button clicnic-carousel-prev">
                    <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="18px" height="18px" viewBox="57 35.171 26 16.043" enable-background="new 57 35.171 26 16.043" xml:space="preserve">
                        <path d="M57.5,38.193l12.5,12.5l12.5-12.5l-2.5-2.5l-10,10l-10-10L57.5,38.193z" fill="rgb(var(--primary-green-color))"></path>
                    </svg>
                </button>
                <button class="clinic-carousel-button clicnic-carousel-next">
                    <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="18px" height="18px" viewBox="57 35.171 26 16.043" enable-background="new 57 35.171 26 16.043" xml:space="preserve">
                        <path d="M57.5,38.193l12.5,12.5l12.5-12.5l-2.5-2.5l-10,10l-10-10L57.5,38.193z" fill="rgb(var(--primary-green-color))"></path>
                    </svg>
                </button>
            <?php endif;?>
        </div>
        <?php
        return ob_get_clean();
                        
    }
    add_shortcode('clinic_list_carousel', 'clinic_list_carousel_fn');
}