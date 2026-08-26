<?php
/**
 * Plugin Name: Product Manager
 * Plugin URI: https://github.com/ShreyaWadekar/Product_management_plugin
 * Description: A reusable WooCommerce product management plugin.
 * Version: 1.0.0
 * Author: Shreya Wadekar
 * Author URI: https://github.com/ShreyaWadekar/Product_management_plugin
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
 * Check if WooCommerce is active before loading the plugin.
 */
function pm_check_woocommerce() {

    if ( ! class_exists( 'WooCommerce' ) ) {

        add_action( 'admin_notices', function() {
            ?>
            <div class="notice notice-error">
                <p>
                    <strong>Product Manager requires WooCommerce to be installed and activated.</strong>
                </p>
            </div>
            <?php
        });

        return;
    }

    /**
     * Load Plugin Files
     */
    require_once PM_PLUGIN_PATH . 'includes/class-loader.php';

    /**
     * Initialize Plugin
     */
    new PM_Loader();
}

add_action( 'plugins_loaded', 'pm_check_woocommerce' );