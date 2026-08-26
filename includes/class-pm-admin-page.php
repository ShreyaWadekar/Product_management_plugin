<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Admin Page Class
 */
class PM_Admin_Page {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action(
			'admin_menu',
			array( $this, 'add_admin_menu' )
		);

	}

	/**
	 * Add Admin Menu
	 */
	public function add_admin_menu() {

		add_menu_page(
			'Product Manager',
			'Product Manager',
			'manage_options',
			'product-manager',
			array( $this, 'render_admin_page' ),
			'dashicons-products',
			56
		);

	}

	/**
	 * Render Admin Page
	 */
	public function render_admin_page() {

		?>

		<div class="wrap">

			<h1>Product Manager</h1>

			<h2>Product Manager Shortcode</h2>

			<p>
				Use the following shortcode on any page where you want to display the Product Manager:
			</p>

			<input
				type="text"
				value="[product_manager]"
				readonly
				style="width: 300px; padding: 10px;"
			>

			<p>
				Copy the shortcode and paste it into a WordPress page or post.
			</p>

		</div>

		<?php

	}

}