<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Remove coltman_level_care from sitemap.
 */
// function sitemap_exclude_taxonomy( $excluded, $taxonomy ) {
//     return $taxonomy === 'ingredients';
// }

// add_filter( 'wpseo_sitemap_exclude_taxonomy', 'sitemap_exclude_taxonomy', 10, 2 );


if(!function_exists('coltman_level_care_sitemap_exclude_taxonomy')){
    function coltman_level_care_sitemap_exclude_taxonomy( $excluded, $taxonomy){
        if(in_array($taxonomy, ADDIC_CLINIC_FILTERS)){
            return true;
        }
        //return $taxonomy === 'coltman_level_care';

    }
    add_filter( 'wpseo_sitemap_exclude_taxonomy', 'coltman_level_care_sitemap_exclude_taxonomy', 10, 2 );
}