<?php
/**
* WordPress WhatsApp Support
*
* @package           WWS
* @author            WeCreativez
* @copyright         2021 WeCreativez
* @license           GPL-2.0-or-later
*
* @wordpress-plugin
* Plugin Name:       WordPress WhatsApp Support
* Plugin URI:        https://codecanyon.net/item/wordpress-whatsapp-support/20963962
* Description:       WordPress WhatsApp Support plugin provides better and easy way to communicate visitors and customers directly to your support person.
* Version:           2.0.9
* Requires at least: 4.6
* Requires PHP:      5.6
* Author:            WeCreativez
* Author URI:        https://wecreativez.com/
* Text Domain:       wc-wws
* License:           GPL v2 or later
* Domain Path:       /languages/
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
*/

// Preventing to direct access
defined( 'ABSPATH' ) OR die( 'Direct access not acceptable!' );

/**
 * Plugin file.
 *
 * @since 1.8.5
 */
if ( ! defined( 'WWS_PLUGIN_FILE' ) ) {
	define( 'WWS_PLUGIN_FILE', __FILE__ );
}

/**
 * Defined Plugin ABSPATH
 *
 * @since 1.8.5
 */
if ( ! defined( 'WWS_PLUGIN_PATH' ) ) {
	define( 'WWS_PLUGIN_PATH', plugin_dir_path( WWS_PLUGIN_FILE ) );
}

/**
 * Defined Plugin URL
 *
 * @since 1.8.5
 */
if ( ! defined( 'WWS_PLUGIN_URL' ) ) {
	define( 'WWS_PLUGIN_URL', plugin_dir_url( WWS_PLUGIN_FILE ) );
}

/**
 * Defined plugin version
 *
 * @since 1.8.5
 */
if ( ! defined( 'WWS_PLUGIN_VER' ) ) {
	define( 'WWS_PLUGIN_VER', '2.0.9' );
}

/**
 * This function will run when plugin activate
 * @since 1.2
 */
function wws_plugin_install() {
	// Run migration first
	require_once WWS_PLUGIN_PATH . 'includes/deprecated/class-wws-migration.php';

	require_once WWS_PLUGIN_PATH . 'includes/class-wws-install.php';
	WWS_Install::install();
}
register_activation_hook( __FILE__, 'wws_plugin_install' );

// Load plugin with plugins_load
function wws_init() {
	require_once WWS_PLUGIN_PATH . 'includes/class-wws-init.php';

	$wws_init = new WWS_Init;
	$wws_init->init();
}
add_action( 'plugins_loaded', 'wws_init', 20 );
