<?php
if(!function_exists('coltman_get_terms_list')){
    function coltman_get_terms_list($args = [
        'taxonomy_title'=>'', 'terms'=>'', 'link'=> false, 'imit'=> 5, 'toolip'=> true,'have_button'=>true,
    ]){
     //  $have_button = isset($args['have_button']) && $args['have_button'] !='false' ?true:false;
        $html = '';
        
        if($args['terms'] == ""){
           // $html .= '<h3>Please provide the terms</h3>';
            return $html;
        }
        
        $taxonomy_title = $args['taxonomy_title'];
        $terms = $args['terms'];
       // var_dump($terms);
        $count = 0;
        if(!$terms){
          //  $html .= '<h3>No terms found</h3>'; 
            return $html;
        }; 
        if(count($terms)>0){
            $html .= '<div class="terms-lists" data-limit="'. $args['imit'] .'">';
            if($taxonomy_title != ""):
                $html .= '<h2 class="terms-lists-title">'.$taxonomy_title.'</h2>';
            endif;
            $html .= '<div class="terms-lists-content">';
                foreach($terms as $term){
                        $taxonomy_name = get_taxonomy($terms->name);
                      
                    if($term->parent == 0):
                        $html .= '<div class="terms-lists-item '.($count >= $args['imit'] ? 'hidden' : '').'">';
                            $html .='<h3 class="terms-lists-item-title">'.$term->name.'</h3>';
                        if($args['toolip']):
                            $html .='<div class="terms-lists-toolip">';
                    
                                $html .='<p class="terms-lists-toolip-content">'.coltman_trim_by_chars_fn($term->description, 100,'').'</p>';
                    //endif;
                                if($args['link']):
                                    $html .='<div class="terms-lists-toolip-link">';
                                        $html .='<a href="'.get_term_link($term, $taxonomy_name).'">View More</a>';
                                    $html .='</div>';
                                endif;
                            $html .='</div>';
                        endif;
                        $html .='</div>';
                        $count++;
                    endif;
                }
                    
                if(count($terms) >= $args['imit'] ){
                    $html .= '<a href="javascript:void(0)" data-open="View More" data-limit="'. $args['imit'] .'" data-close="View Less"  class="view-more-trigger">View More</a>';
                }
                $html .= '</div>';
            $html .= '</div>';
        }
        return $html;
    }
}