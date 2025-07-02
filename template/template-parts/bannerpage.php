

<?php 

$header_info = get_query_var('header_info');
$title = $header_info['title'];
$featured_image = $header_info['featured_image'];
?>
<header class="addic-clinic-single-header">
    <div loading="lazy" async  class="banner-section" style="background: linear-gradient(0deg, rgba(82, 119, 108, 0.20) 0%, rgba(82, 119, 108, 0.20) 100%), url('<?php echo $featured_image; ?>') lightgray 50% / cover no-repeat;">
        <div class="banner-content">
            <h1><?php echo $title; ?></h1>
        </div>
    </div>
    <div class="breadcumb-section">
        <?php 
        echo coltman_get_template_slug_part('breadcumbs/breadcumb','principal');
        
        ?>
    </div>

</header>