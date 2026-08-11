<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Assets Class
 */
class PM_Assets {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ) );

	}

	/**
	 * Load Frontend CSS & JS
	 */
	public function enqueue_frontend_assets() {

		wp_enqueue_style(
			'pm-frontend-style',
			PM_PLUGIN_URL . 'assets/css/frontend.css',
			array(),
			PM_VERSION
		);

        wp_enqueue_media();
        
		wp_enqueue_script(
			'pm-frontend-script',
			PM_PLUGIN_URL . 'assets/js/frontend.js',
			array( 'jquery' ),
			PM_VERSION,
			true
		);

        wp_localize_script(
    'pm-frontend-script',
    'pm_ajax',
    array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'pm_nonce' ),
    )
);

	}
}