<?php
define('ADDIC_FIELDS',  [
  "url",
  "title",
  "rehab_price_range",
  "rehab_address",
  "rehab_website",
  "rehab_rating",
  "rehab_video_url",
  "rehab_google_maps",
  "coltman_clients",
  "rehab_faq",
  "rehab_banner",
  "rehab_image_gallery",
  "coltman_highlights",
  "rehab_phone",
  "rehab_description",
  "rehab_highlight_blocks",
  "rehab_staff",
  "rehab_language",
  "coltman_insurance_method",
  "rehab_insurance",
  "rehab_state",
  "rehab_city",
  "coltman_amenities",
  "coltman_level_care",
  "coltman_treatments",
  "coltman_conditions",
]);

define('NOTFOUND',"Not Found");

require __DIR__ . '/functions/functions.php';

if(!function_exists('coltman_clinic_load_content_fn')){
    function coltmanClinicLoadContentFn(){
      add_menu_page(
        'Clinic Directory',// titulo de la pagina
        'Clinic Directory',// titulo del menu
        'manage_options',//permisos
        'coltman-clinic-directory',//slug
        'coltmanClinicLoadContentCb',// callback
        ADDIC_CLINIC_PLUGIN_URL . 'assets/admin/img/llave-inglesa.svg',// icon
        6
       );
    }
    function coltmanClinicLoadContentCb(){
     require __DIR__ . '/template/clinic_load_content.php';
     echo  clinicLoadContent();
    }
    add_action( 'admin_menu', 'coltmanClinicLoadContentFn' );
}