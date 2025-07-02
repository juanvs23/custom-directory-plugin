<?php

if(!function_exists('get_rehabs_post')){
    function cotman_get_rehabs_post(){
        

        $html = "";
        $filters = json_decode(stripcslashes($_POST['filters']),true);

        $rehabs = [];  

        $nonce = $_POST['nonce'];
        if ( ! wp_verify_nonce( $nonce, 'addic_ajax_filter' ) ) {
            $html .='<div class="addic_ajax_nonce">';
            $html .= '<h2 class="addic_ajax_title">'.__('Nonce not verified', 'addic-clinic-directory').'</h2>';
            $html .= '<p> Your access token is not valid </p>';
            $html .='</div>'; 
            return wp_send_json_error( ['response'=>$html] );
        }
        $queries = [];
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            foreach($filters as $filter){
                $queries[] = [
                    'taxonomy' => $filter['taxonomy'],
                    'field' => 'slug',
                    'terms' => $filter['inputValue'],
                   
                ];
            }

        $queries['relation'] = 'AND';  
        $offset = isset($_POST['offset'])?($_POST['offset'] + $_POST['limit']):0;
        $args_a = [
            'post_type' => 'coltman_addic_clinic',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'post_status' => 'publish',
            'tax_query' =>$queries,
        ];
        $args_b = [
            'post_type' => 'coltman_addic_clinic',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'title',
            'order' => 'ASC',
        ];
        $args = count($queries)>0? $args_a:$args_b; 

        $posts_count = get_posts($args);

       // $args['posts_per_page'] = isset($_POST['limit'])?$_POST['limit']:-1;
       // $args['offset'] = $offset;


        $posts = get_posts($args);

        $rehabs = array_map('unserialize', array_unique(array_map('serialize',$posts )));

        $rehabs = array_slice($rehabs, 0, 6);

        uasort($rehabs, function($a, $b) {
            return $a->id <=> $b->id;
        });
        if(count($rehabs)>0){
            foreach($rehabs as  $rehab){
                $html .= coltman_get_rehab_card($rehab);
            }
        }else{
            $html .= '<div class="no-results">';
            $html .= not_found_rehab_fn($filter[0]['taxonomy'],'');
            $html .= '</div>';
        }
     $end_page = count($rehabs)>= $_POST['limit']?false : true;
        return wp_send_json_success(['response'=>$html,'total'=>count($posts_count), 'endpage'=>$end_page,'offset'=>$offset,'limit'=>$_POST['limit'],'query'=>$args]);
    }
    add_action('wp_ajax_nopriv_get_rehabs_post', 'cotman_get_rehabs_post');
    add_action('wp_ajax_get_rehabs_post', 'cotman_get_rehabs_post');
}