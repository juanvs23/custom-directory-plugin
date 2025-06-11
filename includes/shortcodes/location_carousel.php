<?php

if(!function_exists('addic_location_carousel_fn')){
    function addic_location_carousel_fn($atts){
        $atts = shortcode_atts(array(
            'city_order'=>'',
            'wrapper_class' => '',
            'model' => 'model-a',//model-a, model-b
        ), $atts, 'location_carousel');
        $city_order = $atts['city_order'];
        $temporal_location =[];
        ob_start();
        $locations = get_terms([
            'taxonomy' => 'coltman_locations',
            'hide_empty' => false,
            'orderby' => 'count',
            'order' => 'DESC',
        ]);
        if($city_order != ''){
            //get terms by city name
            $city_order = explode(',', $city_order);
            foreach ($city_order as  $city) {
                //get location by city name
                foreach ($locations as $location) {
                    if(strtolower($location->name) == strtolower($city)){
                        $temporal_location[] = $location;
                    }
                }
            }
            $locations = $temporal_location;          
        }
        ?>
        <div class="location-carousel-wrapper <?php echo $atts['wrapper_class']; ?>">
            <div class="location-carousel" 
                data-desktop="<?php  echo $atts['model']=='model-a'? '6': '3' ; ?>"
                data-tablet="<?php  echo $atts['model']=='model-a'? '4': '2' ; ?>"
                data-mobile="<?php  echo $atts['model']=='model-a'? '2': '1' ; ?>"
                >
                <div class="swiper-wrapper">
                    <?php 
                   /*  $locations = array_filter($locations, function ($item) {
                        return $item->parent != 0;
                    }); */
                    foreach ($locations as $location):
                        
                        $name = $location->name;
                        $count = $location->count;
                        $link = get_term_link($location->term_id, 'coltman_locations');
                        $banner_image = get_term_meta($location->term_id, 'banner_image', true)!=''?get_term_meta($location->term_id, 'banner_image', true): ADDIC_CLINIC_PLUGIN_URL . 'assets/frontend/image/video-default.webp';
                    

                        
                    ?>
                    <article class="swiper-slide location-card <?php echo $atts['model'];?>">
                        <a class="location__link" href="<?php echo $link; ?>">
                        <div class="location-card__image">
                            <img src="<?php echo $banner_image; ?>" alt="<?php echo $name; ?>">
                        </div>
                        <div class="location-card__content">
                            <h3 class="location-card__title"><?php echo $name; ?></h3>
                           
                                <p class="location-card__description"><?php echo $count;  ?>+ Rehabs Centers</p>
                           
                            </div>
                        </a>
                    </article>
                    <?php
            
               
                endforeach; ?>
                </div>
                <div class="location-pagination"></div>
                
            </div>
            <?php if(false): ?>
            <div class="location-prev locations-buttons">
                <button class="location-prev-button">
                    <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="18px" height="18px" viewBox="57 35.171 26 16.043" enable-background="new 57 35.171 26 16.043" xml:space="preserve">
                        <path d="M57.5,38.193l12.5,12.5l12.5-12.5l-2.5-2.5l-10,10l-10-10L57.5,38.193z"></path>
                    </svg>
                </button>
            </div>
            <div class="location-next locations-buttons">
                <button class="location-next-button">
                    <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="18px" height="18px" viewBox="57 35.171 26 16.043" enable-background="new 57 35.171 26 16.043" xml:space="preserve">
                        <path d="M57.5,38.193l12.5,12.5l12.5-12.5l-2.5-2.5l-10,10l-10-10L57.5,38.193z"></path>
                    </svg>
                </button>
            </div>
            <?php endif; ?>
        </div>
        <?php 
        return ob_get_clean();
    }
    add_shortcode('location_carousel', 'addic_location_carousel_fn');
}