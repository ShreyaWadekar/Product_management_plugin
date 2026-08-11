<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shortcode Class
 */
class PM_Shortcode {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_shortcode( 'product_manager', array( $this, 'render_product_manager' ) );

	}

	/**
	 * Render Product Manager
	 */
	public function render_product_manager() {

		$product_list = new PM_Product_List();

$paged = isset( $_GET['pm_page'] ) ? absint( $_GET['pm_page'] ) : 1;

$sort = isset( $_GET['pm_sort'] )
    ? sanitize_text_field( $_GET['pm_sort'] )
    : '';

$products = $product_list->get_products(
    $paged,
    10,
    $sort
);

$total_products = wp_count_posts( 'product' )->publish;

$total_pages = ceil( $total_products / 10 );

ob_start();

include PM_PLUGIN_PATH . 'templates/product-table.php';
include PM_PLUGIN_PATH . 'templates/edit-modal.php';
include PM_PLUGIN_PATH . 'templates/add-modal.php';

return ob_get_clean();

	}
}