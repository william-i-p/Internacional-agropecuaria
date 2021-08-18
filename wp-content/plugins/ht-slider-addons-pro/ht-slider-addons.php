<?php
/**
 * Plugin Name: HT Slider Pro
 * Description: The Slider is a elementor addons for WordPress.
 * Plugin URI:  https://htplugins.com/
 * Author:      HT Plugins
 * Author URI:  https://profiles.wordpress.org/htplugins/
 * Version:     1.0.7
 * License:     GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: htslider-pro
 * Domain Path: /languages
*/
if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly
define( 'HTSLIDER_PRO_VERSION', '1.0.7' );
define( 'HTSLIDER_PRO_PL_ROOT', __FILE__ );
define( 'HTSLIDER_PRO_PL_URL', plugins_url( '/', HTSLIDER_PRO_PL_ROOT ) );
define( 'HTSLIDER_PRO_PL_PATH', plugin_dir_path( HTSLIDER_PRO_PL_ROOT ) );
define( 'HTSLIDER_PRO_PL_ASSETS', trailingslashit( HTSLIDER_PRO_PL_URL.'assets' ) );
define( 'HTSLIDER_PRO_ADMIN_ASSETS', trailingslashit( HTSLIDER_PRO_PL_ASSETS.'admin' ) );
define( 'HTSLIDER_PRO_PL_INCLUDE', trailingslashit( HTSLIDER_PRO_PL_PATH .'include' ) );
define( 'HTSLIDER_PRO_PLUGIN_BASE', plugin_basename( HTSLIDER_PRO_PL_ROOT ) );

// Required File
include( HTSLIDER_PRO_PL_INCLUDE.'/base.php' );
\HTSliderPro\Base::instance();