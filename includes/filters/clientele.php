<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Add coltman_clients to sitemap.
 */
if(!function_exists('coltman_clients_add_sitemap_index')){
    function coltman_clients_add_sitemap_index($sitemap_index) {
        global $wpseo_sitemaps;
        $sitemap_url = home_url("clientele-sitemap.xml");
        $sitemap_date = date(DATE_W3C);  # Current date and time in sitemap format.
        $custom_sitemap = <<<SITEMAP_INDEX_ENTRY
    <sitemap>
        <loc>%s</loc>
        <lastmod>%s</lastmod>
    </sitemap>
    SITEMAP_INDEX_ENTRY;
        $sitemap_index .= sprintf($custom_sitemap, $sitemap_url, $sitemap_date);
        return $sitemap_index;
    }
    add_filter("wpseo_sitemap_index", "coltman_clients_add_sitemap_index");

}

/**
* Register CUSTOM_SITEMAP sitemap with Yoast
*/
if(!function_exists('coltman_clients_sitemap_register')){
    function coltman_clients_sitemap_register() {
        global $wpseo_sitemaps;
        if (isset($wpseo_sitemaps) && !empty($wpseo_sitemaps)) {
            $wpseo_sitemaps->register_sitemap("clientele", "coltman_clients_sitemap_generate");
        }
    }
    add_action("init", "coltman_clients_sitemap_register");
}

if(!function_exists('coltman_clients_sitemap_generate')){
    /**
 * Generate CUSTOM_SITEMAP sitemap XML body
 */
function coltman_clients_sitemap_generate() {
        global $wpseo_sitemaps;
        $data = get_terms(array('taxonomy' => 'coltman_clients', 'hide_empty' => false));  # Replace this with your own data source function
        $urls = array();
        foreach ($data as $item) {
            $urls[]= $wpseo_sitemaps->renderer->sitemap_url(array(
                "mod" => $item->date,  # <lastmod></lastmod>
                "loc" => get_term_link($item->slug, 'coltman_clients'),  # <loc></loc>
            ));
        }
        $sitemap_body = <<<SITEMAP_BODY
    <urlset
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd"
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    %s
    </urlset>
    SITEMAP_BODY;
        $sitemap = sprintf($sitemap_body, implode("\n", $urls));
        $wpseo_sitemaps->set_sitemap($sitemap);
    }
}
