<?php

if(!function_exists('coltman_get_template_slug_part')){



    function coltman_get_template_slug_part($slug,$name=null){

        do_action("coltman_get_template_slug_part_{$slug}", $slug, $name);

        $templates = [];
        if (isset($name))
            $templates[] = "{$slug}-{$name}.php";

        $templates[] = "{$slug}.php";

        coltman_get_template_path($templates, true, false);

    }

    function coltman_get_template_path($template_names, $load = false, $require_once = true ){
        $located = ''; 



        foreach ( (array) $template_names as $template_name ) {
            
            // Skip empty template names
            if ( !$template_name ) 
                continue;
            
            // Check child theme first
            $file_theme = trailingslashit( get_stylesheet_directory() ).'addic-clinic-directory/'. $template_name;
            
            // check plugin theme
            $file_plugin = trailingslashit( ADDIC_CLINIC_PLUGIN_DIR ). 'template/template-parts/' . $template_name;
            
            if ( file_exists( $file_theme ) ) {
                $located = $file_theme;
                break;
            } elseif ( file_exists( $file_plugin ) ) {
                $located = $file_plugin;
                break;
            }
        }


        if ( $load && '' != $located )
            load_template( $located, $require_once );

        return $located;
    }


}