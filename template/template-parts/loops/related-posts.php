<?php
$post_category = get_query_var('post_category')?get_query_var('post_category'):'';
?>
<aside class="clinic-section post-section">
    <div class="clinic-container clinic-content">
        <div class="related-posts-title-content">
            <h2 class="clinic-posts-title">
                <?php echo _x('Related Posts','addic-clinic-directory'); ?>
            </h2>
            <p class="clinic-posts-description">
                <?php echo _x('Check out some of our latest posts','addic-clinic-directory');?>
            </p>
        </div>
        <div class="clinic-posts"  itemscope itemtype="https://schema.org/CollectionPage">
            <?php
            $arg_a =[
                'post_type' => 'post',
                'posts_per_page' => 3
            ];
            $arg_b =[
                'post_type' => 'post',
                'posts_per_page' => 3,
                'tax_query' => [
                    [
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' =>$post_category 
                    ]
                ]
            ];
            $args = $post_category !='' ? $arg_b : $arg_a;
            $get_related_posts =  get_posts($args);
            foreach($get_related_posts as $current_post){
                set_query_var('post',$current_post);
                coltman_get_template_slug_part('components/post','card');
            }
            wp_reset_postdata();
            ?>
        </div>
        <div class="related-post-button">
            <a href="<?php echo get_permalink(get_option('page_for_posts'));?>" class="to-blog-post">
                <?php echo __('View all','addic-clinic-directory');?>
            </a>
        </div>
    </div>
</aside>