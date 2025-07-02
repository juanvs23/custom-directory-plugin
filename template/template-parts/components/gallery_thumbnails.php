<?php
$rehab_image_gallery =   get_query_var('rehab_image_gallery');
$gallery =json_decode( $rehab_image_gallery['gallery']);
// var_dump($gallery);
$isPayment = $rehab_image_gallery['isPayment'];

if(is_iterable($gallery) && count($gallery)>0):
?>
<div class="gallery-thumbnail-container">
  <?php if($isPayment === 'payment-membership'):?>
<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
    <div class="swiper-wrapper">
      <?php foreach($gallery as $image):?>
      <div class="swiper-slide rehab_image_image">
        <img src="<?php echo $image->url;?>" alt="<?php echo $image->id;?>" loading="lazy" async />
      </div>
      <?php endforeach; ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
  <div thumbsSlider="" class="swiper mySwiper">
    <div class="swiper-wrapper">
    <?php foreach($gallery as $image):?>
      <div class="swiper-slide rehab_image_thumbnail" loading="lazy" async >
        <img src="<?php echo $image->url;?>" alt="<?php echo $image->id;?>"  loading="lazy" async />
      </div>
      <?php endforeach; ?>
    </div>
    </div>
    <?php else:?>
      <div class="single-image-gallery">
        <div class="rehab_image_image">
          <img src="<?php echo $gallery[0]->url;?>" alt="<?php echo $gallery[0]->id;?>" loading="lazy" async />
        </div>
      </div>
    <?php endif;?>
    </div>
<?php endif;?>