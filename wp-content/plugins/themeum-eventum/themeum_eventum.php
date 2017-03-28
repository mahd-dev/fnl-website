<?php
/**
 * Plugin Name: Themeum Eventum
 * Plugin URI: http://www.themeum.com
 * Description: Themeum Eventum plugins
 * Author: Themeum
 * Version: 2.1
 * Author URI: http://www.themeum.com
 *
 * Tested up to: 4.0
 * Text Domain: themeum-eventum
 *
 * @package Themeum Eventum
 * @category Core
 * @author Eventum
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define( 'THMRWMB_URL', trailingslashit( plugins_url( 'post-type/meta-box' , __FILE__ ) ) );
define( 'THMRWMB_DIR', trailingslashit(  plugin_dir_path( __FILE__ ). 'post-type' ) );


// Language File Loaded.
add_action( 'plugins_loaded', 'myplugin_load_textdomain' );
function myplugin_load_textdomain(){
  load_plugin_textdomain( 'themeum-eventum', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
 

// Include the meta box script
require_once THMRWMB_DIR . 'meta-box/meta-box.php';
require_once THMRWMB_DIR . 'meta_box.php';


//Register Post Type
include_once( 'post-type/speaker.php' );
include_once( 'post-type/schedule.php' );
include_once( 'post-type/photo-gallery.php' );


//Shortcodes
include_once( 'shortcodes/themeum-function-list.php' );
include_once( 'shortcodes/speaker.php' );
include_once( 'shortcodes/themeum-gallery-list.php' );
include_once( 'shortcodes/speaker-id.php' );
include_once( 'shortcodes/schedules.php' );
include_once( 'shortcodes/schedules-tab.php' );
include_once( 'shortcodes/google-map.php' );


// Include Settings
include_once( 'themeum_eventum_settings.php' );

function beackend_theme_update_notice()
{
    wp_enqueue_style('woonotice',plugins_url('assets/css/woonotice.css',__FILE__));
}
add_action( 'admin_print_styles', 'beackend_theme_update_notice' );
