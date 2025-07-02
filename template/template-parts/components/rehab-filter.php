<?php
$filter_info = get_query_var('filter_info');
$total = $filter_info['total'];
$title = $filter_info['title'];
$localize = $filter_info['localize'];
if(!function_exists('display_filter_items')){
    function display_filter_items($list, $localize, $taxonomy){
        $code = '';
        foreach ( $list as $filter ) {
            $code .= '<li class="filter-item">';
            $code .= '<a class="filter-link" href="'.get_term_link( $filter->term_id, $taxonomy ).'">';
            $code .= '<input class="filter-checkbox"  data-taxonomy="'.$taxonomy.'" data-parent="'.$filter->parent.'" data-term="'.$filter->term_id.'" data-localize="'.$localize.'"  type="checkbox" name="filter" '.($localize == $filter->term_id ||  get_queried_object()->parent == $filter->term_id ? 'checked' : '').' value="'.$filter->slug.'">';
            $code .='<span class="filter-item-name" >'.$filter->name.'</span>';
           
                $code .='<span class="filter-item-count">(+'.$filter->count.')</span>';
            
            $code .= '</a>';
            $code .= '</li>';
        };
        return $code;
    }
}
if(!function_exists('get_filters')){
    
function get_filters ($taxonomy, $localize, $title, $extraClass='inluder' ){
    $html = '';
    $filters = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' =>false,
        'orderby' => 'count',
                        'order' => 'DESC',
        
    ]);

    $filters = array_filter($filters, function ($item) {
        return $item->parent == 0;
    });
    $limit = 5;
    $start_list = [];
    $end_list = [];

    foreach ( $filters as $filter ) {
        if ( count($start_list) < $limit ) {
            array_push($start_list, $filter);
        } else {
            array_push($end_list, $filter);
        }
    }

    $html .= '<div class="filter-container '.$extraClass.'"  data-taxonomy="'.$taxonomy.'" >';
    $html .= '<div class="filter-item-trigger">';
    $html .= '<h3 class="filter-title-name">'.$title.'</h3>';
    $html .= '</div>';
    $html .= '<div class="filter-content">';
    $html .= '<ul class="filter-items">';
    $html .= display_filter_items($start_list, $localize, $taxonomy);
    if( count($end_list) > 0 ) {
       
        $html .= '<div class="hidden-filter-items">';
        $html .= display_filter_items($end_list, $localize, $taxonomy);
        $html .= '</div>';
        $html .= '<button class="readmore-filter-button" data-open="View Less" data-close="View More"  type="button"><span>'. __('View More','addic-clinic-directory').'</span>';
        $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 15 10" fill="none">
<path fill-rule="evenodd" clip-rule="evenodd" d="M8.31037 9.1564C8.0991 9.37641 7.81259 9.5 7.51384 9.5C7.2151 9.5 6.92859 9.37641 6.71731 9.1564L0.343948 2.51766C0.236343 2.40941 0.150514 2.27991 0.0914678 2.13673C0.0324221 1.99356 0.00134247 1.83956 4.25376e-05 1.68374C-0.00125739 1.52792 0.0272487 1.37339 0.0838968 1.22916C0.140545 1.08494 0.224201 0.95391 0.329984 0.843723C0.435766 0.733536 0.561557 0.646396 0.700016 0.58739C0.838475 0.528383 0.98683 0.49869 1.13642 0.500044C1.28602 0.501398 1.43385 0.533772 1.57131 0.595276C1.70876 0.656781 1.83308 0.746184 1.93701 0.858269L7.51384 6.66732L13.0907 0.858269C13.3032 0.644498 13.5878 0.526212 13.8832 0.528886C14.1786 0.531559 14.4611 0.65498 14.67 0.872564C14.8789 1.09015 14.9974 1.38449 15 1.69219C15.0025 1.99989 14.889 2.29633 14.6837 2.51766L8.31037 9.1564Z" fill="#1A1A1A"/>
</svg>';
        $html .= '</button>';
    }
    $html .= '</ul>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}
}
?>

<div class="rehab-filter-tite">
    <h2 class="">
        <?php
        echo __(''.$title.'','addic-clinic-directory');
        ?>
    </h2>
    </div>
    <div class="filter-list">
    <div class="filter-trigger">
        <h3 class="filter-name"><?php echo __('Filters','addic-clinic-directory'); ?></h3>
        <div class="filter-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M19.25 10H6.895M2.534 10H0.75M2.534 10C2.534 9.42184 2.76368 8.86735 3.17251 8.45852C3.58134 8.04969 4.13583 7.82001 4.714 7.82001C5.29217 7.82001 5.84666 8.04969 6.25549 8.45852C6.66432 8.86735 6.894 9.42184 6.894 10C6.894 10.5782 6.66432 11.1327 6.25549 11.5415C5.84666 11.9503 5.29217 12.18 4.714 12.18C4.13583 12.18 3.58134 11.9503 3.17251 11.5415C2.76368 11.1327 2.534 10.5782 2.534 10ZM19.25 16.607H13.502M13.502 16.607C13.502 17.1853 13.2718 17.7404 12.8628 18.1494C12.4539 18.5583 11.8993 18.788 11.321 18.788C10.7428 18.788 10.1883 18.5573 9.77951 18.1485C9.37068 17.7397 9.141 17.1852 9.141 16.607M13.502 16.607C13.502 16.0287 13.2718 15.4746 12.8628 15.0657C12.4539 14.6567 11.8993 14.427 11.321 14.427C10.7428 14.427 10.1883 14.6567 9.77951 15.0655C9.37068 15.4743 9.141 16.0288 9.141 16.607M9.141 16.607H0.75M19.25 3.39301H16.145M11.784 3.39301H0.75M11.784 3.39301C11.784 2.81484 12.0137 2.26035 12.4225 1.85152C12.8313 1.44269 13.3858 1.21301 13.964 1.21301C14.2503 1.21301 14.5338 1.2694 14.7983 1.37896C15.0627 1.48851 15.3031 1.64909 15.5055 1.85152C15.7079 2.05395 15.8685 2.29427 15.9781 2.55876C16.0876 2.82325 16.144 3.10673 16.144 3.39301C16.144 3.67929 16.0876 3.96277 15.9781 4.22726C15.8685 4.49175 15.7079 4.73207 15.5055 4.93451C15.3031 5.13694 15.0627 5.29751 14.7983 5.40707C14.5338 5.51663 14.2503 5.57301 13.964 5.57301C13.3858 5.57301 12.8313 5.34333 12.4225 4.93451C12.0137 4.52568 11.784 3.97118 11.784 3.39301Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
            </svg>
        </div>
    </div>
    <div class="filter-wrappper">
        <div class="filter-list-items">
            <?php
            echo get_filters( 'coltman_locations',$localize, 'Locations', 'excluder' );
            echo get_filters( 'coltman_level_care',$localize, 'Level of care' );
            echo get_filters( 'coltman_conditions',$localize, 'Conditions' );
            echo get_filters( 'coltman_insurance_method',$localize, 'Insurances' );
          //  echo get_filters( 'coltman_highlights',$localize, 'Highlights' );
            echo get_filters( 'coltman_treatments',$localize, 'Therapies' );
            echo get_filters(  'coltman_clients',$localize, 'Clientele' );

            ?>
        </div>
    </div>
</div>