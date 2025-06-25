<?php
$especialities_list = json_decode(get_query_var('especialities_list'));
if(count($especialities_list)>0):
?>
<section  class="espciality section-container">
    <div class="clinic-container">
        <div class="scalar-b-a">
            <?php foreach($especialities_list as $especiality): ?>
                <article class="especiality-block" id="especiality-<?php echo $especiality->id; ?>">
                    <div class="speciality-image">
                        <img src="<?php echo $especiality->image; ?>" alt="<?php echo str_replace('u00e0','',$especiality->title); ?>" height="453" width="700" loading="lazy" async decoding="async">
                    </div>
                    <div class="speciality-info">
                        <h2 class="speciality-title left-title"><?php echo str_replace('u00e0','',$especiality->title); ?></h2>
                        <div class="speciality-description"><?php echo str_replace('u00e0','',$especiality->content); ?></div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif;?>