<?php 
$rehab_content = get_query_var('rehab_content');
$total = $rehab_content['total'];
?>
<div class="clinic-section">
    <main id="rehabs-content" class="archive-rehab clinic-container">
        <section class="rehab-filters"  
            data-type="coltman_addic_clinic" 
            data-tax="<?php echo get_queried_object()->taxonomy;?>" 
            data-term="<?php echo get_queried_object()->term_id;?>">
            <?php $total = get_queried_object()->count;
            set_query_var('filter_info',['total' =>$total. ' Rehab Centers in "'. get_queried_object()->name.'"','title'=>$rehab_content['title'] , 'localize'=> get_queried_object()->term_id ]);
            echo  coltman_get_template_slug_part('components/rehab','filter');?>
        </section>
      
        <div class="rehabs-list-wraper">
          
           
                <?php
                $arg_a = [
                    'posts_per_page' => get_option('posts_per_page'),
                    'publish_status' => 'publish',
                    'post_type' => 'coltman_addic_clinic',
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'tax_query' =>[
                        [
                            'taxonomy' => get_queried_object()->taxonomy,
                            'field' => 'slug',
                            'terms' => get_queried_object()->slug
                        ]
                    ]
                 ];
                 $arg_b = [
                    'posts_per_page' => get_option('posts_per_page'),
                    'publish_status' => 'publish',
                    'post_type' => 'coltman_addic_clinic',
                    'orderby' => 'title',
                    'order' => 'ASC',
                 ];
                 
                $args = get_queried_object()->taxonomy != null ? $arg_a : $arg_b;
               // var_dump($args); 
                $query = get_posts($args);
                
                if(count($query)>0 ){
                    echo '<section class="rehab-list">';
                    foreach($query as $post) {
                       
                        set_query_var('card_info', [ 'post'=>get_post(get_the_ID($post->ID)),'have_category'=>'true', 'have_gallery'=>'false','words'=>25,'limit'=>3,'have_button'=>false]);
                        echo coltman_get_template_slug_part('components/rehab','card'); 
                    }
                    echo '</section>';
                    echo '<section class="rehab-no-list">';
                    echo '</section>';
                    wp_reset_postdata(  );
                }else{
                   $taxonomy = get_queried_object()->taxonomy;
                   echo '<section class="rehab-list">';
                    echo '</section>';
                   echo '<section class="rehab-no-list">';
                    if(get_queried_object()->parent != 0){
                       // var_dump(get_queried_object()->parent);
                        echo not_found_rehab_fn($taxonomy,  get_queried_object()->parent );
                    }else{
                      //  var_dump(get_queried_object()->term_id);
                        echo not_found_rehab_fn($taxonomy, get_queried_object()->term_id );
                    }
                    echo '</section>';

                    
                }
              
                ?>
            
          
          

            <div class="load-more-rehab-container">
                <button class="load-more-rehab" 
                    data-offset="<?php echo  get_option('posts_per_page') ?>" 
                    data-addcards="<?php echo  get_option('posts_per_page') ?>"  
                    data-currentpaged="" 
                    data-tax_filter="[]" 
                    data-tax="<?php echo get_queried_object()->taxonomy;?>" 
                    data-term="<?php echo get_queried_object()->term_id;?>"
                    style="opacity: <?php echo $rehab_content['total'] > get_option('posts_per_page')? '1' : '0';?>">
                    <span>Load More</span>
                </button>
            </div>
          
        </div>
    </main>
</div>
<?php
 $content_blocks_ama = isset($rehab_content['content_blocks_ama'])? json_decode($rehab_content['content_blocks_ama']) : json_decode(json_encode([]));
set_query_var('content_blocks_list', $content_blocks_ama);
echo coltman_get_template_slug_part('components/content','blocks'); 
if(is_iterable(json_decode($rehab_content['faq_accordeon'])) && count(json_decode($rehab_content['faq_accordeon'])) > 0):
?>
<section class="clinic-section faq-green ">
    <div class="clinic-container">
    <?php

$faq_accordeon = isset($rehab_content['faq_accordeon'])? json_decode($rehab_content['faq_accordeon']):json_decode(json_encode([]));
set_query_var('faq_list', $faq_accordeon);
echo coltman_get_template_slug_part('components/section','faq');
//wp_reset_postdata(  );
?>
        
    </div>
</section>

<?php endif;
//  echo coltman_get_template_slug_part('components/ads','carousel');

?>