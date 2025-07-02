<?php
if(!function_exists('coltman_custom_breadcrumbs_fn')){
    function coltman_custom_breadcrumbs_fn($atts) {
      $atts = shortcode_atts([
        'class' => '',
        'separator' => '',
        'home' => 'Home',
        'title'=>''
      ], $atts,'coltman_breadcrumbs');
      ob_start();
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
   
     
     
      global $post;
   
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
     
        if ( is_category() ) {
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

      return ob_get_clean();
    } // end qt_custom_breadcrumbs()
    add_shortcode( 'coltman_breadcrumbs', 'coltman_custom_breadcrumbs_fn' );
}



