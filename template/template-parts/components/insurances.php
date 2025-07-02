<?php
$insurances_list = get_query_var('insurances_list');
$id = $insurances_list['post_id'];
$taxonomy = $insurances_list['taxonomy'];
$insurances = get_the_terms($id, $taxonomy);
$limit_item = 4;
if($insurances): // insurance exist
    if(count($insurances)>0): // have insurances
    ?>
    <section id="green-insurance" class="section-container">
        <div class="clinic-container">
            <div class="green-insurance-content">
                <div class="green-insurance-text-content">
                    <h2 class="green-title" style="margin-bottom: 30px;">Insurance Accepted</h2>
                    
                </div>
                <div class="insurance-container">
                    <div class="insurances-list"  data-limit_item="<?php echo $limit_item;?>">
                        <?php
                        $count = 0;
                        foreach($insurances as $insurance):
                            $title = $insurance->name;
                            $link = get_term_link($insurance->term_id, $taxonomy);
                            $insurance_logo = get_term_meta($insurance->term_id, 'logo', true);
                            $insurance_description = $insurance->description;
                        ?>
                        <article class="insurance-item <?php echo $count >= $limit_item ? 'hidden' : ''; ?>">
                        <div class="flip-card">
                                <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                            <img src="<?php echo $insurance_logo; ?>" alt="<?php echo $title; ?>" loading="lazy" async height="" width="">
                                    </div>
                                    <div class="flip-card-back">
                            <h3><?php echo $title; ?></h3>
                            <div class="flip-card-text">
                                <?php echo coltman_trim_content_text_fn($insurance_description,7);?>
                                <a href="<?php echo $link;?>"> Read More</a>
                            </div>
                            </div>
                        </div>
                        </div>
                        </article>
                        <?php
                        $count++;
                        endforeach;
                        ?>
                    </div>
                    <div class="view-all-insurances">
                        <?php if(count($insurances)>4 && $insurances_list['pay_membership'] !== 'free-membership'):?>
                        <a href="javascript:void(0);" class="view-all-insurances-btn" data-open="Show Less Insurances" data-close="Show All Insurances">Show All Insurances</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    endif;
endif;
?>