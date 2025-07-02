<?php
      // var_dump(get_queried_object());
      echo '<div class="breadcumb-principal '.$atts['class'].'">';
  // $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
   $delimiter = $atts['separator'] != '' ? $atts['separator'] : ' <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
   <path d="M4.6 6L0 1.4L1.4 0L7.4 6L1.4 12L0 10.6L4.6 6Z" fill="#012226"/>
   </svg> '; // delimiter between crumbs
      $home = $atts['home'] != '' ? $atts['home'] : 'Home'; // text for the 'Home' link
      $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
      $before = '<span class="current">'; // tag before the current crumb
      $after = '</span>'; // tag after the current crumb
   
   
      $html ='';
      $homeLink = get_bloginfo('url');
     
      if ( is_front_page()) {
        
        
        if ($showOnHome == 1) $html.='<div id="crumbs" class="breacumb-container"><a href="' . $homeLink . '">' . $home . '</a></div>';
     
      } elseif( is_home() ) {
       $page_data = get_queried_object();
        $html.='<div id="crumbs" class="breacumb-container"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
        $html.= before_title($page_data->post_title) . $page_data->post_title . $after;
        $html.= '</div>';
      } else {
        $html.='<div id="crumbs" class="breacumb-container"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
        // 'coltman_locations',
        // 'coltman_clients',
        // 'coltman_treatments',
        // 'coltman_level_care',
        // 'coltman_amenities',
        // 'coltman_luxuries',
        // 'coltman_highlights',
        // 'coltman_languages',
        // 'coltman_conditions',
        // 'coltman_type_membership',
        // 'coltman_insurance_method',
        if(is_tax('coltman_locations') || 
        is_tax('coltman_clients') || 
        is_tax('coltman_treatments') || 
        is_tax('coltman_level_care') || 
        is_tax('coltman_amenities') || 
        is_tax('coltman_luxuries') || 
        is_tax('coltman_highlights') || 
        is_tax('coltman_languages') || 
        is_tax('coltman_conditions') || 
        is_tax('coltman_type_membership') || 
        is_tax('coltman_insurance_method')){
          $tax = get_queried_object();

          $term_id = $tax->term_id;
          $header_title = get_term_meta($term_id, 'header_title', true);
          $title = isset($header_title) && $header_title !='' ? $header_title : $tax->name;

          //if tax name
          if(is_tax('coltman_locations')){
            //$html.= before_title('Locations'). 'Location' .  ' '.$delimiter.  $after;
            $html .= '<a href="'.home_url('/location').'">'. 'Location' .  ' '.$delimiter.  '</a>';
          }elseif(is_tax('coltman_clients')){
            $html .= '<a href="'.home_url('/clientele').'">'. 'Clientele' .  ' '.$delimiter.  '</a>';
           // $html.= before_title('Clientele'). 'Clientele' .  ' '.$delimiter.  $after;
          }elseif( 
          is_tax('coltman_treatments') 
          ){
          //  $html.= before_title('Therapies'). 'Therapies' .  ' '.$delimiter.  $after;
            $html .= '<a href="'.home_url('/therapies').'">'. 'Therapies' .  ' '.$delimiter.  '</a>';
          }elseif( 
          is_tax('coltman_level_care')
          ){
           // $html .= before_title('Level of Care'). 'Level of Care' .  ' '.$delimiter.  $after;
            $html .= '<a href="'.home_url('/level-of-care').'">'. 'Level of Care' .  ' '.$delimiter.  '</a>';
          }elseif( 
          is_tax('coltman_amenities')
          ){
            $html .= before_title('Amenities'). 'Amenities' .  ' '.$delimiter.  $after;
          }elseif( 
          is_tax('coltman_luxuries')
          ){
            $html .= before_title('Luxuries'). 'Luxuries' .  ' '.$delimiter.  $after;
          }elseif( 
          is_tax('coltman_highlights')
          ){
            $html .= before_title('Highlights'). 'Highlights' .  ' '.$delimiter.  $after;
          }elseif(
          is_tax('coltman_languages')
          ){
            $html .= before_title('Languages'). 'Languages' .  ' '.$delimiter.  $after;
            
          }elseif(
          is_tax('coltman_conditions') 
          ){
            $html .= '<a href="'.home_url('/conditions').'">'. 'Conditions' .  ' '.$delimiter.  '</a>';
          }elseif(
          is_tax('coltman_type_membership') 
          ){

          }elseif( 
          is_tax('coltman_insurance_method')){
            $html .= '<a href="'.home_url('/insurances').'">'. 'Insurances' .  ' '.$delimiter.  '</a>';
          //  $html .= before_title('Insurances'). 'Insurances' .  ' '.$delimiter.  $after;

          }

          if ($tax->parent != 0){
            $parent = get_term_by('term_id',$tax->parent,$tax->taxonomy);
            $html.='<a href="'.get_term_link($parent->slug,$parent->taxonomy).'">'.$parent->name.' '.$delimiter.'</a>';
          } 
          $html.= before_title($title).  $title .  $after;
         
        }elseif ( is_category() ) {
          $thisCat = get_category(get_query_var('cat'), false);
          if ($thisCat->parent != 0) $html.=get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
          $html.= before_title($page_data->post_title).  single_cat_title('', false) .  $after;
     
        } elseif ( is_search() ) {
          $html.= before_title($page_data->post_title). 'Search results for "' . get_search_query() . '"' . $after;
     
        }elseif(is_post_type_archive('coltman_addic_clinic')){
          $tile = get_queried_object();
          $html.= before_title($page_data->post_title).  $tile->label .  $after;
        }
        
         elseif ( is_day() ) {
          $html.= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          $html.= '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
          $html.= before_title($page_data->post_title). get_the_time('d') . $after;
     
        } elseif ( is_month() ) {
          $html.= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          $html.= before_title($page_data->post_title) . get_the_time('F') . $after;
     
        } elseif ( is_year() ) {
          $html.= before_title($page_data->post_title). get_the_time('Y') . $after;
     
        } elseif ( is_single() && !is_attachment() ) {
          if ( get_post_type() != 'post' ) {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            $html.= '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
            if ($showCurrent == 1) $html.=' ' . $delimiter . ' ' . before_title($post_type->labels->singular_name) . get_the_title() . $after;
          } else {
            
             $cat = get_the_category(); $cat = $cat[0];
             if($cat->name !="Uncategorized"):
             $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
             if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
             $html.= $cats;
             endif;
             if ($showCurrent == 1) $html.=before_title( get_the_title()) .trim_content_text_fn( get_the_title(),3) . $after;
          }
     
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
          $post_type = get_post_type_object(get_post_type());
          $html.=before_title($post_type->labels->singular_name) . ($post_type->labels->singular_name) . $after;
     
        } elseif ( is_attachment() ) {
          $parent = get_post($post->post_parent);
          $cat = get_the_category($parent->ID); $cat = $cat[0];
          $html.=get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
          $html.='<a href="' . get_permalink($parent) . '">' . trim_content_text_fn(($parent->post_title!=''?$parent->post_title:$title),3) . '</a>';
          if ($showCurrent == 1) $html.=' ' . $delimiter . ' ' . before_title( get_the_title()) . trim_content_text_fn( get_the_title(),3) . $after;
     
        } elseif ( is_page() && !$post->post_parent ) {
          if ($showCurrent == 1) $html.=before_title( get_the_title()) .trim_content_text_fn( get_the_title(),3) . $after;
     
        } elseif ( is_page() && $post->post_parent ) {
          $parent_id  = $post->post_parent;
          $breadcrumbs = array();
          while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . trim_content_text_fn((get_the_title($page->ID)!=''?get_the_title($page->ID):$title),3) . '</a>';
            $parent_id  = $page->post_parent;
          }
          $breadcrumbs = array_reverse($breadcrumbs);
          for ($i = 0; $i < count($breadcrumbs); $i++) {
            $html.=$breadcrumbs[$i];
            if ($i != count($breadcrumbs)-1) $html.=' ' . $delimiter . ' ';
          }
          if ($showCurrent == 1) $html.=' ' . $delimiter . ' ' .before_title( get_the_title()) .trim_content_text_fn( get_the_title(),3) . $after;
     
        } elseif ( is_tag() ) {
          $html.=before_title( get_the_title()) . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
     
        } elseif ( is_author() ) {
           global $author;
          $userdata = get_userdata($author);
          $html.=before_title( get_the_title()) . 'Articles posted by ' . $userdata->display_name . $after;
     
        } elseif ( is_404() ) {
          $html.=before_title( get_the_title()) . 'Error 404' . $after;
        }
     
        if ( get_query_var('paged') ) {
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $html.=' (';
          $html.=__('Page') . ' ' . get_query_var('paged');
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $html.=')';
        }
     
        $html.='</div>';
       }
       echo $html;
      echo '</div>';

?>