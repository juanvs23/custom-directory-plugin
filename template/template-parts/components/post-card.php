<?php
    $post = get_query_var('post');
    //var_dump($post);
    $title = wp_strip_all_tags(coltman_trim_by_chars_fn($post->post_title,60),true);
    $content = wp_strip_all_tags(coltman_trim_by_chars_fn($post->post_content,100),true);
    $link = get_the_permalink($post->ID);
    $image = get_the_post_thumbnail_url($post->ID,'full') ? get_the_post_thumbnail_url($post->ID,'full') : ADDIC_CLINIC_PLUGIN_URL . '/assets/frontend/image/article-default-1x.webp';
?>
<article class="new-post-card" itemscope itemtype="https://schema.org/Article">
    <div class="image-new-post">
        <a href="<?php  echo $link; ?>" title="<?php echo $title;?>">

            <img src="<?php echo $image;?>" alt="<?php echo $title;?>" itemprop="image">
        </a>
    <div class="content-new-post">
        <a href="<?php  echo $link; ?>">
            <h3 class="title-new-post" itemprop="headline" >
                <?php echo $title;?>
            </h3>
            <p class="description-new-post" aria-expanded="false" itemprop="description">
                <?php echo $content;?>
                <span aria-hidden="true" style="display:none;" >
                    <?php echo strip_tags($post->post_content);?>
                </span>
            </p>
        </a>
    </div>

</article>