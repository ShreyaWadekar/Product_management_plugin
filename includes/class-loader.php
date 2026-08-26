<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin Loader Class
 */
class PM_Loader {

	public function __construct() {

		$this->load_dependencies();
		$this->init_classes();

	}

	private function load_dependencies() {

		require_once PM_PLUGIN_PATH . 'includes/class-assets.php';
		require_once PM_PLUGIN_PATH . 'includes/class-shortcode.php';
		require_once PM_PLUGIN_PATH . 'includes/class-product-list.php';
		require_once PM_PLUGIN_PATH . 'includes/class-ajax.php';
		require_once PM_PLUGIN_PATH . 'includes/class-security.php';
		require_once PM_PLUGIN_PATH . 'includes/class-helper.php';
		require_once PM_PLUGIN_PATH . 'includes/class-pm-admin-page.php';

	}

	private function init_classes() {

		new PM_Assets();

		new PM_Shortcode();

		new PM_Product_List();

		new PM_Ajax();

		new PM_Security();

		new PM_Helper();

		new PM_Admin_Page();

	}
}