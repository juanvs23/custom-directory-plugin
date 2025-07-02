<?php
$rehab_content = get_query_var('rehab_content');
$rehab_total = $rehab_content['total'];
$rehab_content = $rehab_content['content'];

$total = get_posts(
    [
        'post_type' => 'coltman_addic_clinic',
        'post_status' => 'publish',
        'posts_per_page' => -1
    ]
);
?>
<section id="rehab-counter" class="section-container">
    <div class="clinic-container rehab-counter-content">
        <div class="rehab-content">
            <p class="content">
                <?php echo $rehab_content; ?>
            </p>
        </div>
        <!-- <div class="rehab-counter">
            <?php if(!is_post_type_archive('coltman_addic_clinic')): ?>
            <a class="counter" href="<?php echo get_post_type_archive_link('coltman_addic_clinic'); ?>">
            View All Ours <?php echo count($total) ;?> Centers
            </a>
            <?php endif; ?>
        </div> -->
    </div>
</section>

