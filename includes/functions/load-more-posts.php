<?php
if(!function_exists('coltman_load_more_posts')){
    function coltman_load_more_posts(){
        $html = "";
        $nonce = $_POST['nonce'];
        if ( ! wp_verify_nonce( $nonce, 'addic_ajax_filter' ) ) {
            $html .='<div class="addic_ajax_nonce">';
            $html .= '<h2 class="addic_ajax_title">'.__('Nonce not verified', 'addic-clinic-directory').'</h2>';
            $html .= '<p> Your access token is not valid </p>';
            $html .='</div>'; 
            return wp_send_json_error( ['response'=>$nonce] );
        }
        $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
        $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 6;

        
       
        $args = [
                'post_type' => 'coltman_addic_clinic',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'title',
                'order' => 'ASC',
            ];
        if( $_POST['tax'] != '' && $_POST['term'] !='' ){
            $args['tax_query'] = [
                [
                    'taxonomy' => $_POST['tax'],
                    'field' => 'term_id',
                    'terms' => $_POST['term']
                ]
            ];
        }
        
        if(isset($_POST['tax_filter'])  && $_POST['tax_filter'] != '[]' ){
            $tax_filter = stripslashes($_POST['tax_filter']); // Eliminar las barras invertidas
            $tax_filter = json_decode($tax_filter, true); // Decodificar el JSON
            $taxs =[];
            foreach( $tax_filter as $filter){
                $taxs[] = [
                    'taxonomy' => $filter['taxonomy'],
                    'field' => 'slug',
                    'terms' => $filter['inputValue'],
                ];
            }
            $args['tax_query'] = $taxs;
        }
        $rehabs =get_posts($args);
      //  $end = intval($offset + 6) <= count($rehabs)? intval($offset + 6) : count($rehabs);
        $rehabs_page = array_slice($rehabs, $offset, 6);
        
        if(!empty($rehabs_page)){
            foreach($rehabs_page as $rehab){
               $html .= coltman_get_rehab_card($rehab);
            }
        }
        $end_page = count($rehabs_page)>= 6 ?false : true;
        return wp_send_json_success( ['response'=>$html,'endpage'=>$end_page,'sendend'=>count($rehabs_page), 'offset'=>intval($offset),'total'=>count($rehabs), 'limit'=>intval($limit) ,'query'=>$args,'receive'=>[
            'tax'=>$_POST['tax'],
            'term'=>$_POST['term'],
            'tax_filter'=>$tax_filter ,
            'offset'=>$_POST['offset'],
            'limit'=>$_POST['limit']
        ]], 200 );
    }
    add_action('wp_ajax_nopriv_coltman_load_more_posts', 'coltman_load_more_posts');
    add_action('wp_ajax_coltman_load_more_posts', 'coltman_load_more_posts');
}