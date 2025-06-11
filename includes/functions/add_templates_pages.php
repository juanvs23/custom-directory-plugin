<?php
 
/*  function coltman_add_templates_pages( $origina ) {
    global $post;
    
    $theme_folder = trailingslashit( get_stylesheet_directory() ).'addic-clinic-directory/';
    $plugin_folder = trailingslashit( ADDIC_CLINIC_PLUGIN_DIR ).'template/';
    
    if(is_post_type_archive('coltman_addic_clinic')){
        if(file_exists($theme_folder)) return $theme_folder.'archive-clinics.php';
        return $theme_folder.'archive-clinics.php';
        }
        if(is_singular('coltman_addic_clinic')){
            echo file_exists($theme_folder);
            if(file_exists($theme_folder)) return $theme_folder.'single-clinic.php';
            return  $theme_folder.'single-clinic.php';
            }
            
            return $template;
            
            }
            add_action('template_include', 'coltman_add_templates_pages'); */
            
            
            
if(!function_exists('coltman_add_archive_template_page')){
            
    function coltman_add_archive_template_page($archive_template ){
        global $post;
        if(is_post_type_archive('coltman_addic_clinic')){
            if(file_exists(ADDIC_CLINIC_THEME_TEMPLATES)) return ADDIC_CLINIC_THEME_TEMPLATES.'archive-clinics.php';
            return ADDIC_CLINIC_PLUGIN_TEMPLATES.'archive-clinics.php';
        }
        return $archive_template;
    }
    add_filter( 'archive_template', 'coltman_add_archive_template_page', 10, 1 );
}
if(!function_exists('coltman_add_single_template_page')){
            
    function coltman_add_single_template_page($single_template ){
        global $post;
        if(is_singular('coltman_addic_clinic')){
            if(file_exists(ADDIC_CLINIC_THEME_TEMPLATES)) return ADDIC_CLINIC_THEME_TEMPLATES.'single-clinics.php';
            return ADDIC_CLINIC_PLUGIN_TEMPLATES.'single-clinics.php';
        }
        return $single_template;
    }
    add_filter( 'single_template', 'coltman_add_single_template_page', 10, 1 );
}
if(!function_exists('coltman_add_taxonomy_templates_page')){
    
    function coltman_add_taxonomy_templates_page($taxonomy_template ){
        global $post;
        $taxs = ADDIC_CLINIC_FILTERS;
        foreach($taxs as $tax){
            if(is_tax($tax)){
                if(file_exists(ADDIC_CLINIC_THEME_TEMPLATES)) return ADDIC_CLINIC_THEME_TEMPLATES . $tax .'.php';
                return ADDIC_CLINIC_PLUGIN_TEMPLATES . $tax.'.php';
            }
        }
        return $taxonomy_template;
    }
    add_filter( 'taxonomy_template', 'coltman_add_taxonomy_templates_page', 10, 1 );
}