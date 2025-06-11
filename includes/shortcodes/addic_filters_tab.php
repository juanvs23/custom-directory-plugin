<?php

if(!function_exists('addic_filters_tab_fn')){

    function currentActiveFilter ($current_tax,$local_tax,$count,$activeClass){
        $active = '';
        if($current_tax == $local_tax){
            $active = $activeClass;
        }
        if($current_tax == '' && $count== 0){
            $active = $activeClass;
        }
        return $active;
    }
    function addic_filters_tab_fn($atts){
        $atts = shortcode_atts(array(
            'current_filter' => '',
            'no_button'=>''
        ), $atts, 'addic_filters_tab');
        $current = $atts['current_filter'];
        $no_button = $atts['no_button'];
        ob_start();
        $filters =[
            [
                'title' =>'Locations',
                'name' => 'coltman_locations',
            ],
            [
                'title' =>'Clientele',
                'name' => 'coltman_clients',
            ],
            [
                'title' =>'Conditions',
                'name' => 'coltman_conditions',
            ],

            [
                'title' =>'Insurances',
                'name' => 'coltman_insurance_method',
            ],
            [
                'title' =>'Therapies',
                'name' => 'coltman_treatments',
            ],
            [
                'title' => 'Levels of Care',
                'name' => 'coltman_level_care',
            ]
        ];
        $filters_items = [];
        foreach($filters as $filter){
            $get_filter = get_terms([
               'taxonomy' => $filter['name'],
               'hide_empty' => false,

            ]);
            $items =[];
        //    if($filter['name']=='coltman_locations' || $filter['name']=='coltman_conditions'){
                $get_filter = array_filter($get_filter, function ($item) {
                    return $item->parent == 0;
                });
        ///    }
            foreach($get_filter as $item){
                $items[] =[
                    'name' => $item->name,
                    'id' => $item->term_id,
                    'count' => $item->count,
                    'taxonomy' => $item->taxonomy,
                    'link' => get_term_link($item->term_id),
                ];
            }
            $filters_items[$filter['name']] = [
                'name' =>$filter['name'],
                'title' => $filter['title'],
                'items' =>  $items
            ];

        }
       // var_dump($filters_items);

        ?>
        <div class="addic_filter_tabs">
            <ul class="addic_filter_tab_titles">
                <?php 
                
                $count = 0;
                foreach($filters_items as $filter):
                    
              //  $active = $current != '' && $current == $filter['name'] ? 'active' : ($count == 0 && $current == '' ? 'active' : '') ;
                $active = currentActiveFilter($current, $filter['name'],$count,'active');
                ?>
                <?php // var_dump($filter); ?>
                    <li class="addic_filter_tab_title <?php echo $active;?>" 
                        id="<?php echo $filter['name'].'_title';?>"  
                        data-id="<?php echo $filter['name'];?>" >
                        <span class="addic_filter_tab_title_name">
                            <?php echo $filter['title']; ?>
                        </span>
                    </li>
                    <?php 
                    $count++;
            
            endforeach; ?>
                
            </ul>
            <div class="addic_filter_tab_contents">
                <?php 
                $count = 0;
                
                foreach($filters_items as $filter): 
                    //$active = $count == 0 ? 'opened' : '';
                    $active = currentActiveFilter($current, $filter['name'],$count,'opened' );
                ?>
                    <div id="<?php echo $filter['name'];?>" class="addic_filter_tab_content <?php echo $active;?>">
                        <div class="addic-hot-topic">
                            <h3 class="addic-hot-topic-title">
                                <?php echo __('Hot Topics','addic-clinic-directory');?>
                            </h3>
                            <div class="addic-hot-topic-items-wrapper" id="<?php echo $filter['name'];?>">
                                <div class="addic-hot-topic-items"  >
                                    <div class="swiper-wrapper">

                                    

                                    <?php
                             
                             $hot_topic = array_filter($filter['items'],function ($item){
                                 
                                 return (int) $item['count'] !=0;
                                });
                                usort($hot_topic,function($a,$b){
                                    return (int) $b['count'] - (int) $a['count'];
                                });
                                //var_dump($hot_topic);
                                $limit = count($hot_topic) < 5? count($hot_topic)-1 : 5 ;
                                for ($i=0; $i <=$limit ; $i++) { 
                                    # code...
                                    if(isset($hot_topic[$i])):
                                    ?>

                                    <div class=" swiper-slide addic-hot-topic-item">
                                     
                                        <a href="<?php echo $hot_topic[$i]['link'] ?>" class="addic-hot-topic-item_link"> 
                                            <?php echo $hot_topic[$i]["name"];?> (+<?php echo (string) $hot_topic[$i]["count"]; ?>)
                                        </a>

                                    </div>
                                    <?php
                                    endif;
                                }
                                ?>
                                    </div>
                                </div>
                                <div class="hot-topic-prev locations-buttons">
                                    <button class="location-prev-button">
                                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="18px" height="18px" viewBox="57 35.171 26 16.043" enable-background="new 57 35.171 26 16.043" xml:space="preserve">
                                            <path d="M57.5,38.193l12.5,12.5l12.5-12.5l-2.5-2.5l-10,10l-10-10L57.5,38.193z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="hot-topic-next locations-buttons">
                                    <button class="location-next-button">
                                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="18px" height="18px" viewBox="57 35.171 26 16.043" enable-background="new 57 35.171 26 16.043" xml:space="preserve">
                                            <path d="M57.5,38.193l12.5,12.5l12.5-12.5l-2.5-2.5l-10,10l-10-10L57.5,38.193z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="addic_filter_tab_list_content">
                            <ul class="addic_filter_tab_list">

                                <?php 
                                $count = 0;
                                if($filter['name'] =='coltman_locations' ){
                                    $first_cities = ['Los Angeles','Malibu'];
                                    $first_cities = array_filter($filter['items'],function ($item) use ($first_cities){
                                        return in_array($item['name'], $first_cities);
                                    });
                                    $other_cities = array_filter($filter['items'],function ($item) use ($first_cities){
                                        return !in_array($item['name'], $first_cities);
                                    });
                                    $filter['items'] = array_merge($first_cities,$other_cities);
                                    // remove repeated cities
                                    $filter['items'] = array_unique($filter['items'], SORT_REGULAR);

                                }
                                foreach($filter['items'] as $filter): ?>
                                    <?php if($no_button!=''):?>
                                    <li class="addic_filter_tab_list_item">
                                    <?php else:?>
                                    <li class="addic_filter_tab_list_item <?php echo $count > 19 ? 'hidden' : '';?>">
                                    <?php endif;?>
                                        <a href="<?php echo $filter['link'];?>" class="addic_filter_tab_list_item_link">
                                            <?php echo $filter['name'];?>
                                        </a>
                                    </li>
                                <?php 
                            $count++;
                            endforeach; ?>
                            </ul>
                           <?php if( $no_button =='' && $count > 20): ?>
                            <button class="read-more-tabfilter-list" data-open="Read Less" data-close="Read More">
                                <span  class="tabfilter-text">
                                    Read More
                                </span>
                                <span class="tabfilter-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<g clip-path="url(#clip0_66_349)">
<path fill-rule="evenodd" clip-rule="evenodd" d="M12.7071 15.707C12.5196 15.8944 12.2653 15.9998 12.0001 15.9998C11.7349 15.9998 11.4806 15.8944 11.2931 15.707L5.6361 10.05C5.54059 9.95773 5.46441 9.84739 5.412 9.72538C5.35959 9.60338 5.332 9.47216 5.33085 9.33938C5.32969 9.2066 5.355 9.07492 5.40528 8.95202C5.45556 8.82913 5.52981 8.71747 5.6237 8.62358C5.7176 8.52969 5.82925 8.45544 5.95214 8.40515C6.07504 8.35487 6.20672 8.32957 6.3395 8.33073C6.47228 8.33188 6.6035 8.35947 6.7255 8.41188C6.84751 8.46428 6.95785 8.54047 7.0501 8.63598L12.0001 13.586L16.9501 8.63598C17.1387 8.45382 17.3913 8.35302 17.6535 8.3553C17.9157 8.35758 18.1665 8.46275 18.3519 8.64816C18.5373 8.83357 18.6425 9.08438 18.6448 9.34658C18.6471 9.60877 18.5463 9.86137 18.3641 10.05L12.7071 15.707Z" fill="#1A1A1A"></path>
</g>
<defs>
<clipPath id="clip0_66_349">
<rect width="24" height="24" fill="white"></rect>
</clipPath>
</defs>
</svg>
                                </span>
                            </button>
                          <?php endif;?> 
                        </div>
                    </div>
                <?php
              $count++;
            endforeach;?>
           
            </div>


        </div>
        <?php
        return ob_get_clean();
    }
    add_shortcode('addic_filters_tab', 'addic_filters_tab_fn');
}