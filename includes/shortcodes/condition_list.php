<?php

if(!function_exists('addic_condition_list_fn')){

    function createConditionItem($item, $index){
        $id = $item->term_id;
        $title = $item->name;
        $description = $item->description;
        $link = get_term_link($id);
        $html ='';
        $html .='<div class="condition-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
        $html .= '<a href="'.$link.'" itemprop="url">';
        $html .= '<h3 class="condition-title" itemprop="name">';
        $html .= $title;
        $html .= '</h3>';
        $html .= '<p aria-expanded="false" class="condition-description" itemprop="description">';
        $html .= coltman_trim_content_text_fn($description,10);
        $html .= '<span class="read-more" style="display: none;" aria-hidden="true">'.$description.'</span>';
        $html .= '</p>';
        $html .= '</a>';
        $html .= '<meta itemprop="position" content="'.$index.'">';
        $html .= '</div>';
        return $html;
    }


    function addic_condition_list_fn($atts){
        $atts = shortcode_atts(array(
            'wrapper_class' => '',
            'number_list'=>-1,
            'item_row'=>3,
            'remove_conditions' =>'',
            'parent_id'=>'',
            'initial_items'=>6,
            'load_more_text'=>'All Conditions',
            'load_more_class'=>'',
            'load_more_icon' =>'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<g clip-path="url(#clip0_66_349)">
<path fill-rule="evenodd" clip-rule="evenodd" d="M12.7071 15.707C12.5196 15.8944 12.2653 15.9998 12.0001 15.9998C11.7349 15.9998 11.4806 15.8944 11.2931 15.707L5.6361 10.05C5.54059 9.95773 5.46441 9.84739 5.412 9.72538C5.35959 9.60338 5.332 9.47216 5.33085 9.33938C5.32969 9.2066 5.355 9.07492 5.40528 8.95202C5.45556 8.82913 5.52981 8.71747 5.6237 8.62358C5.7176 8.52969 5.82925 8.45544 5.95214 8.40515C6.07504 8.35487 6.20672 8.32957 6.3395 8.33073C6.47228 8.33188 6.6035 8.35947 6.7255 8.41188C6.84751 8.46428 6.95785 8.54047 7.0501 8.63598L12.0001 13.586L16.9501 8.63598C17.1387 8.45382 17.3913 8.35302 17.6535 8.3553C17.9157 8.35758 18.1665 8.46275 18.3519 8.64816C18.5373 8.83357 18.6425 9.08438 18.6448 9.34658C18.6471 9.60877 18.5463 9.86137 18.3641 10.05L12.7071 15.707Z" fill="#1A1A1A"/>
</g>
<defs>
<clipPath id="clip0_66_349">
<rect width="24" height="24" fill="white"/>
</clipPath>
</defs>
</svg>'

        ), $atts, 'condition_list');
        $start_items = [];
        $end_items = [];
        $remove_conditions = $atts['remove_conditions'];

        $arg_a = [
            'taxonomy' => 'coltman_conditions',
            'hide_empty' => false,
           // 'number' =>-1,
            'orderby' => 'name',
            'order' => 'ASC',
        ];
        $arg_b = [
            'taxonomy' => 'coltman_conditions',
            'hide_empty' => false,
           'number' =>$atts['number_list'],
            'orderby' => 'name',
            'order' => 'ASC',
        ];
        if($remove_conditions !=''){
            $remove_conditions = explode(',', $remove_conditions);
            $arg_a['exclude'] = $remove_conditions;
            $arg_b['exclude'] = $remove_conditions;
        }

        $args = $atts['number_list'] != -1 ? $arg_b : $arg_a;

        $conditions = get_terms($args);
        $conditions = array_filter($conditions, function ($item) {
            return $item->parent == 0;
        });
        // if remove_conditions is not empty
        if($atts['initial_items']>0){
            $start_items = array_slice($conditions,0, $atts['initial_items']);
            $end_items = array_slice($conditions, $atts['initial_items']);

        }else{
            $start_items = $conditions;
        }

      

        ob_start();?>
        <div class="condition_list<?php echo $atts['wrapper_class']!=''?' '.$atts['wrapper_class']:'';  ?> " itemscope itemtype="https://schema.org/ItemList" >
            <div class="condition_items">
                <?php 
                $count = 1;
                foreach($start_items as $item):?>
                    <?php echo createConditionItem($item,$count);
                    $count++;
                    ?>                    
                <?php endforeach; ?>
            </div>
            <?php if(count($end_items)>0):?>
                <div class="condition_items extras condition_hides">
                    <?php foreach($end_items as $item):?>
                        <?php echo createConditionItem($item,$count);
                        $count++;
                        ?>
                        
                    <?php endforeach; ?>
                </div>
           
                <div class="load-more-button-wrapper">
                    <button class="condition-load-more<?php echo $atts['load_more_class']!=''?' '.$atts['load_more_class']:'';  ?>">
                        <span class="load-more-text">
                            <?php echo $atts['load_more_text']; ?>
                        </span>
                        <?php if($atts['load_more_icon']!=''): ?>
                            <span class="load-more-icon">
                                <?php echo $atts['load_more_icon']; ?>
                            </span>
                        <?php endif; ?>
                    </button>
                </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
    add_shortcode('condition_list', 'addic_condition_list_fn');
}