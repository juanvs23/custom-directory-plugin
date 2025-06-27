<?php

if(!function_exists('addic_clinic_directory_paginator')){
    function addic_clinic_directory_paginator( array $paginateSettings = []){
        global $wp_query;
        $html = '';
        $current_page = isset($paginateSettings['current_page']) ? $paginateSettings['current_page'] : 1;
        $query = isset($paginateSettings['query']) ? $paginateSettings['query'] : $wp_query;
        $total_pages = isset($paginateSettings['total_pages']) ? $paginateSettings['total_pages'] : $query->max_num_pages;
        $previous_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
</svg>';

        $next_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
</svg>';



        if ($total_pages <= 1) return $html; // No pagination needed if there's only one page


        $html .= '<section class="pagination-container" itemscope itemtype="https://schema.org/ItemList">';
            $html .= '<nav class="pagination" role="navigation" aria-label="' . __('Pagination', 'addic-clinic-directory') . '" aria-live="polite" >';


            // Previous Page Link
            if ($current_page > 1) {
                $html .= '<a  itemscope itemtype="https://schema.org/ListItem"  href="' . get_pagenum_link($current_page - 1) . '" class="gotobutton previous paginator-link">'.$previous_icon.' <span class="patinator-text" itemprop="name">' . __('Previous', 'addic-clinic-directory') . '</span></a>';
            }else{
                $html .= '<span  itemscope itemtype="https://schema.org/ListItem" class="gotobutton previous paginator-link disabled">'.$previous_icon.' <span class="patinator-text" itemprop="name">' . __('Previous', 'addic-clinic-directory') . '</span></span>';
            }
            
            // Page Numbers
            $html .= '<ul class="page-numbers">';
            
            if ($total_pages > 1) {
                $current = max(1, $current_page);
                $range = 2; // Cuántas páginas mostrar a cada lado de la actual
            
                // first page
                    $html .= $current > 1 ? '<li  itemscope itemtype="https://schema.org/ListItem" class="page-number"><a href="' . get_pagenum_link(1) . '" class="paginator-link">1</a></li>' : '<li class="page-number active"><span class="paginator-link">1</span></li>';
                    if ($current > $range + 3) {
                        $html .= '<li   class="page-number "><span class="paginator-link">...</span></li>';
                    }
                

                // middle buttons

                for ($i = max(2, $current - $range); $i <= min($total_pages - 1, $current + $range); $i++) {
                    if ($i == $current) {
                        $html .= '<li  itemscope itemtype="https://schema.org/ListItem" class="page-number active"><span class="paginator-link" itemprop="name">' . $i . '</span></li>';
                    } else {
                        $html .= '<li  itemscope itemtype="https://schema.org/ListItem" class="page-number"><a href="' . get_pagenum_link($i) . '" class="paginator-link" itemprop="name">' . $i . '</a></li>';
                    }
                }

                // last page
                if ($current < $total_pages - $range - 1) {
                    $html .= '<li class="page-number"><span class="paginator-link">...</span></li>';
                }
                $html .= $total_pages > 1 ? '<li class="page-number"><a href="' . get_pagenum_link($total_pages) . '" class="paginator-link">' . $total_pages . '</a></li>' : '<li class="page-number active"><span class="paginator-link">' . $total_pages . '</span></li>';

            
                $html .= '</ul>';
                
    
                // Next Page Link
                if ($current_page < $total_pages) {
                    $html .= '<a  itemscope itemtype="https://schema.org/ListItem" href="' . get_pagenum_link($current_page + 1) . '" class="gotobutton next paginator-link"><span class="patinator-text" itemprop="name">' . __('Next', 'addic-clinic-directory') . '</span>'.$next_icon.'</a>';
                }else{
                    $html .= '<span  itemscope itemtype="https://schema.org/ListItem" class="gotobutton next paginator-link disabled"><span class="patinator-text" itemprop="name">' . __('Next', 'addic-clinic-directory') . '</span>'.$next_icon.'</span>';
                }
            }




            $html .= '</nav>';
        $html .= '</section>';
        

        return $html;
    }
}