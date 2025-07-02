<?php
$rehab_image_gallery_video = get_query_var('rehab_image_gallery_video');
$image_preload = $rehab_image_gallery_video['preload'];
$gallery =json_decode ($rehab_image_gallery_video['gallery']);
$rehab_video_url = $rehab_image_gallery_video['video'];
$video_image = $image_preload!=''? $image_preload : ADDIC_CLINIC_PLUGIN_URL . 'assets/frontend/image/video-default.webp';

?>
<div class="galleries-sections">
    <div class="gallery-left">
        <div class="rehab-video-container">
            <div class="rehab-video" id="rehab-video" data-videoID="<?php echo $rehab_video_url; ?>"  data-poster="<?php echo $video_image; ?>" style="background-image: url('<?php echo $video_image; ?>');"></div>
            <div class="rehab-video-plaheholder"  id="rehab-video-plaheholder" data-playstatus="false">
                <div class="rehab-videoicon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="white" class="bi bi-pause-fill" viewBox="0 0 16 16">
                        <path d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5m5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" viewBox="0 0 46 46" fill="none">
                        <path d="M15.5603 2.79591L40.8349 19.0908C41.5009 19.5203 42.047 20.102 42.4247 20.7845C42.8024 21.467 43 22.2291 43 23.0031C43 23.7772 42.8024 24.5393 42.4247 25.2218C42.047 25.9042 41.5009 26.486 40.8349 26.9154L15.5603 43.2104C14.828 43.6824 13.9769 43.9534 13.0977 43.9945C12.2186 44.0356 11.3444 43.8452 10.5684 43.4436C9.7924 43.0421 9.14365 42.4444 8.69132 41.7143C8.239 40.9842 8.00006 40.1491 8 39.2981V6.70193C8.00006 5.85087 8.239 5.01577 8.69132 4.28569C9.14365 3.55562 9.7924 2.95793 10.5684 2.55636C11.3444 2.15479 12.2186 1.9644 13.0977 2.00548C13.9769 2.04657 14.828 2.31758 15.5603 2.78964V2.79591Z" fill="white"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="gallery-right">
        <div class="gallery-grid-container">
            <div class="gallery-grid">
                <div class="swiper-wrapper">
                    <?php foreach($gallery as $image):
                       
                        ?>
                        
                        <div class="swiper-slide rehab_lightbox" data-image="<?php echo $image->url;?>">
                            <img src="<?php echo $image->url;?>" alt="<?php echo $image->id;?>" loading="lazy" async />
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="gallery-button-next gallery-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                </div>
                <div class="gallery-button-prev gallery-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="modal-gallery-container">
                <div class="modal-gallery">
                    <div class="modal-image">
                        <div class="modal-image-header">
                            <button class="close-modal">
                            <svg class="ast-mobile-svg ast-close-svg" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5.293 6.707l5.293 5.293-5.293 5.293c-0.391 0.391-0.391 1.024 0 1.414s1.024 0.391 1.414 0l5.293-5.293 5.293 5.293c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414l-5.293-5.293 5.293-5.293c0.391-0.391 0.391-1.024 0-1.414s-1.024-0.391-1.414 0l-5.293 5.293-5.293-5.293c-0.391-0.391-1.024-0.391-1.414 0s-0.391 1.024 0 1.414z"></path></svg>
                            </button>
                        </div>
                        <div class="modal-image-body">
                            <img decoding="async" class="nolazy" src="<?php 
                            $logo_id = get_theme_mod('custom_logo');
                            $logo_url = wp_get_attachment_image_url($logo_id, 'full');
                            echo  $logo_url;?>" alt="" loading="lazy">
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>