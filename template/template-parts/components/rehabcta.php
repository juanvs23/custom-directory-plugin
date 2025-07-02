<?php
/*
set_query_var( 'cta', [
	'image' => LUXERCOVERY_THEME_URL . '/directory/assets/img/mobile-cta.webp',
	'button'=>[
			'text' => 'Get Help Now',
			'link' => get_bloginfo(). $cta_cpt->has_archive
	],
	'title' =>$button_text,
	'content' => 'Our independent research team continuously gathers and evaluates data to compile an unbiased and thorough list of the best treatment centers for alcohol.',
] );
 */
$cta = get_query_var('cta');
$image = $cta['image'];
$button = $cta['button'];
$title = $cta['title'];
$content = $cta['content'];

?>
<section class="cta-rehab-blog" style="background: linear-gradient(0deg, rgba(82, 119, 108, 0.75) 0%, rgba(82, 119, 108, 0.75) 100%), url(<?php echo $image;?>) lightgray 50% / cover no-repeat;" >
    <div class="cta-rehab-blog-content">
        <div class="cta-rehab-blog-text">
            <div class="cta-rehab-blog-text-icon">
                <img src="<?php echo ADDIC_CLINIC_PLUGIN_URL . '/assets/img/house-icon-04.webp' ?>" alt="<?php echo $title ?>">
            </div>
           <div class="cta-text">
           <h2><?php echo $title ?></h2>
           <p><?php echo $content ?></p>
           </div>
        </div>
        <div class="cta-rehab-blog-button">
            <a href="<?php echo $button['link'] ?>" class="button"><?php echo $button['text'] ?></a>
        </div>
    </div>
</section>
