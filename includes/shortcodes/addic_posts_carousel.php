<?php

if(!function_exists('addic_posts_carousel_fn')){
    function addic_posts_carousel_fn($atts){
        $atts = shortcode_atts(array(
            
        ), $atts, 'addic_posts_carousel');

        $posts = get_posts(array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'orderby' => 'title',
            'order' => 'ASC',
        ));
        ob_start();
        ?>
        <div class="addic-postcarousel-wrapper" itemprop itemtype="https://schema.org/CollectionPage" itemscope>
            <div class="addic-postcarousel">
                <div class="swiper-wrapper">
                    <?php foreach($posts as $item):
                        $image = get_the_post_thumbnail_url($item->ID, 'full') ? get_the_post_thumbnail_url($item->ID, 'full') : ADDIC_CLINIC_PLUGIN_URL . '/assets/frontend/image/article-default-1x.webp';
                        $title = coltman_trim_content_text_fn(get_the_title($item->ID),5);
                        $content = coltman_trim_content_text_fn($item->post_content,20);
                        $link = get_the_permalink($item->ID);
                        ?>
                        <article class="swiper-slide addic-post-card" itemscope itemtype="https://schema.org/Article">
                           
                            <div class="addic-post-card-content">
                                <a href="<?php echo $link; ?>" style="background: transparent !important;">
                                    <h3 class="addic-post-card-title" itemprop="headline"  title="<?php echo get_the_title($item->ID); ?>" >
                                        <?php echo $title; ?>
                                    </h3>
                                    <p class="addic-post-card-description" aria-expanded="false" itemprop="description" >
                                        <?php echo $content; ?>
                                        <span aria-hidden="true" style="display:none !important;" >
                                            <?php 
                                            // remove tags
                                            echo strip_tags( $item->post_content );
                                             ?>
                                        </span>
                                    </p>
                                </a>
                                <a href="<?php echo $link; ?>" itemprop="url" >
                                    <span class="addic-post-card-link">
                                        Read More 
                                    </span>
                                </a>
                            </div>
                            <div class="addic-post-card-image">
                                <a href="<?php echo $link; ?>" style="bacground: transparent !important;">
                                <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" loading="lazy" async />
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
                <div class="addic-post-pagination"></div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    add_shortcode('addic_posts_carousel', 'addic_posts_carousel_fn');
}