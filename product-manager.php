<?php
/**
 * Plugin Name: Product Manager
 * Plugin URI: https://example.com
 * Description: A reusable WooCommerce product management plugin.
 * Version: 1.0.0
 * Author: Shreya Wadekar
 * Author URI: https://example.com
 * License: GPL v2 or later
 * Text Domain: product-manager
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Plugin Constants
 */
define( 'PM_VERSION', '1.0.0' );
define( 'PM_PLUGIN_FILE', __FILE__ );
define( 'PM_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
/**
 * Load Plugin Files
 */
require_once PM_PLUGIN_PATH . 'includes/class-loader.php';
/**
 * Initialize Plugin
 */
new PM_Loader();