<?php

if(!function_exists('coltman_filter_page_loop_fn')){
    function coltman_filter_page_loop_fn($atts){
        $atts = shortcode_atts(
            [
                'tax'=>'',
                'title'=>'',
            ],
            $atts,
        );
        ob_start();
        $terms = get_terms([
            'taxonomy'=>$atts['tax'],
            'hide_empty'=>false,
            'orderby' => 'count',
            'order' => 'DESC',
        ]);
        $queries = [
           
        ];
        foreach($terms as $term){
            $tax = $term;
            $term_id = $tax->term_id;
            $header_title = get_term_meta($term_id, 'header_title', true);
            $title = isset($header_title) && $header_title !='' ? $header_title : $tax->name;
            //echo $title. '<br>';
            $queries[] =  $term_id;
        }
        $posts = get_posts([
            'posts_per_page' => get_option('posts_per_page'),
            'publish_status' => 'publish',
            'post_type' => 'coltman_addic_clinic',
            'orderby' => 'title',
            'order' => 'ASC',
            'tax_query' =>  [
                'taxonomy' => $atts['tax'],
                'field' => 'term_id',
                'terms' =>  $queries
            ]
        ]);
       // set_query_var('get_id', get_the_ID());
        echo coltman_get_template_slug_part('components/ads','slider');
        ?>
        <div class="clinic-container">
        <main id="rehabs-content" class="archive-rehab ">
        <section class="rehab-filters"  
            >
            <?php
            $total_posts = get_posts([
                'posts_per_page' =>-1,
                'publish_status' => 'publish',
                'post_type' => 'coltman_addic_clinic',
                'orderby' => 'title',
                'order' => 'ASC',
                'tax_query' =>  [
                    'taxonomy' => $atts['tax'],
                    'field' => 'term_id',
                    'terms' =>  $queries
                ]
            ]);
            
           $total = count($total_posts); 
            set_query_var('filter_info',['total' =>$total. ' Rehab Centers in ','title'=>$total .' Rehab Centers were found' , 'localize'=> get_queried_object()->slug ]);
            echo  coltman_get_template_slug_part('components/rehab','filter');?>
        </section>
        <div class="rehabs-list-wraper">
          
          <section class="rehab-list">
            <?php
             if(count($posts)>0 ){
                foreach($posts as $element) {
                   
                    set_query_var('card_info', [ 'post'=>$element,'have_category'=>'true', 'have_gallery'=>'false','words'=>25,'limit'=>3,'have_button'=>false]);
                   echo coltman_get_template_slug_part('components/rehab','card'); 
                }
                wp_reset_postdata();
            }
            
            ?>
          </section>
          <div class="load-more-rehab-container">
                <button class="load-more-rehab" 
                    data-offset="<?php echo  get_option('posts_per_page') ?>" 
                    data-addcards="<?php echo  get_option('posts_per_page') ?>"  
                    data-currentpaged="" 
                    data-tax_filter="[]" 
                    data-tax="<?php echo get_queried_object()->taxonomy;?>" 
                    data-term="<?php echo get_queried_object()->term_id;?>"
                    style="opacity: <?php  echo $total > get_option('posts_per_page')? '1' : '0';?>">
                    <span>Load More</span>
                </button>
            </div>
        </div>
        </main>
        </div>
        <?php
        return ob_get_clean();
    }
    add_shortcode('filter_page_loop', 'coltman_filter_page_loop_fn');
}