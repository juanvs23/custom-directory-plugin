<?php
$member = get_query_var('member');

$image = isset($member->image) && $member->image !='' ? $member->image : ADDIC_CLINIC_PLUGIN_URL.'/assets/frontend/image/member-default.webp';
$name = $member->title;
$job = $member->content;
?>
<article class="memeber-item" id="<?php echo $member->id;?>">
    <div class="member-image">
        <img src="<?php echo $image;?>" alt="<?php echo $name;?>" loading="lazy" async  height="" width=""/>
    </div>
    <div class="member-info">
        <h3 class="member-title"><?php echo $name;?></h3>
        <p class="member-position"><?php echo $job;?></p>
    </div>
</article>