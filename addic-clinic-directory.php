<?php
 
/**
 * Addic Clinic Directory Plugin
 * 
 * @package ColtmanAddicClinic
 * 
 * @version 1.2.5
 * @author Juan Carlos Avila
 * @link http://www.addicclinic.com
 * @copyright Copyright (c) 2024 Addic Clinic
 * 
 * @wordpress-plugin
 * Plugin Name: Addic Clinic Directory
 * Plugin URI: http://www.addicclinic.com
 * Description: Addic Clinic Directory
 * Requires at least: 5.2
 * Requires PHP: 8.1
 * Version: 1.2.5
 * Author: Juan Carlos Avila
 * Author URI: http://www.addicclinic.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: addic-clinic-directory
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}
/**
 * Constants
 */

set_time_limit(3000); 

if(!defined('ADDIC_CLINIC_PLUGIN_DIR')) define('ADDIC_CLINIC_PLUGIN_DIR', __DIR__);
if(!defined('ADDIC_CLINIC_PLUGIN_URL')) define('ADDIC_CLINIC_PLUGIN_URL', plugin_dir_url(__FILE__));
if(!defined('ADDIC_CLINIC_VERSION')) define('ADDIC_CLINIC_VERSION', '1.2.5'); 

// Add templates folders
$theme_folder = trailingslashit( get_stylesheet_directory() ).'addic-clinic-directory/';
$plugin_folder = trailingslashit( ADDIC_CLINIC_PLUGIN_DIR ).'template/';

if(!defined('ADDIC_CLINIC_THEME_TEMPLATES')) define('ADDIC_CLINIC_THEME_TEMPLATES', $theme_folder);
if(!defined('ADDIC_CLINIC_PLUGIN_TEMPLATES')) define('ADDIC_CLINIC_PLUGIN_TEMPLATES', $plugin_folder);

$clinis_filters = [
    'coltman_locations',
    'coltman_clients',
    'coltman_treatments',
    'coltman_level_care',
    'coltman_amenities',
    'coltman_luxuries',
    'coltman_highlights',
    'coltman_languages',
    'coltman_conditions',
    'coltman_type_membership',
    'coltman_insurance_method',
];

if(!defined('ADDIC_CLINIC_FILTERS')) define('ADDIC_CLINIC_FILTERS', $clinis_filters);


// vendor/autoload.php
require __DIR__ . '/vendor/autoload.php';

$env = false;
if(file_exists(__DIR__.'/.env')){
   // echo 'Existe el archivo';
    $env = file_get_contents(__DIR__.'/.env');
    $env = explode("\n", $env);
    foreach ($env as $key => $value) {
        $env[$key] = explode('=', $value);
        $_ENV[$env[$key][0]] = $env[$key][1];
    }
}
$openKey = isset($_ENV['OPENAI_API_KEY'])?$_ENV['OPENAI_API_KEY']:'';
$googleApiKey = isset($_ENV['GOOGLE_API_KEY'])?$_ENV['GOOGLE_API_KEY']:'';

if(!defined('ADDIC_CLINIC_GOOGLE_API_KEY')) define('ADDIC_CLINIC_GOOGLE_API_KEY', $googleApiKey);
if(!defined('ADDIC_CLINIC_OPENAI_KEY')) define('ADDIC_CLINIC_OPENAI_KEY', $openKey);

// classes/class.php
require __DIR__ . '/classes/class.php';

// includes/includes.php
require __DIR__ . '/includes/includes.php';

if (function_exists('coltman_add_clinic_post_type')) {
 //   echo 'This function already exists. It will not be overwritten.';
    coltman_add_clinic_post_type();
}

if (!function_exists('addic_clinic_register_plugin')) {
    function addic_clinic_register_plugin() {
        flush_rewrite_rules(); 
    }
    register_deactivation_hook( __FILE__, 'addic_clinic_register_plugin' );
}

if (!function_exists('addic_clinic_unregister_plugin')) {
    # code...
    function addic_clinic_unregister_plugin() {
        // Unregister the post type, so the rules are no longer in memory.
        unregister_post_type( 'addic-clinic-directory' );
        // Clear the permalinks to remove our post type's rules from the database.
        flush_rewrite_rules();
    }
    register_deactivation_hook( __FILE__, 'coltman_addic_clinic' );
}

