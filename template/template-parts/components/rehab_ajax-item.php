<?php
$rehab_item = get_query_var('rehab_item');
$link = $rehab_item['link'] ?? '';
$image = $rehab_item['image'] ?? '';
$title = $rehab_item['title'] ?? '';
$description = coltman_trim_by_chars_fn($rehab_item['description'],120) ?? '';

?>


<div class="addic_ajax_item">
    <a href="<?php echo $link; ?>" class="ajax_link_item">
        <div class="addic_ajax_image">
            <img decoding="async" src="<?php echo $image; ?>" alt="<?php echo $title; ?>" loading="lazy" async="">
        </div>
        <div class="addic_ajax_content">
            <h2 class="addic_ajax_title"><?php echo $title; ?></h2>
            <p class="addic_ajax_description">
                <?php echo $description; ?>
            </p>
                
        </div>
    </a>
</div>