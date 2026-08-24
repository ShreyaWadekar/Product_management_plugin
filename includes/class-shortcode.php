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

$paged = isset( $_GET['pm_page'] )
    ? absint( $_GET['pm_page'] )
    : 1;

$sort = isset( $_GET['pm_sort'] )
    ? sanitize_text_field( $_GET['pm_sort'] )
    : '';

$search = isset( $_GET['pm_search'] )
    ? sanitize_text_field( $_GET['pm_search'] )
    : '';

$products = $product_list->get_products(
    $paged,
    10,
    $sort,
    $search
);

$count_args = array(
    'status' => array( 'publish' ),
    'limit'  => -1,
    'return' => 'ids',
);

if ( ! empty( $search ) ) {
    $count_args['s'] = $search;
}

$total_products = count( wc_get_products( $count_args ) );

$total_pages = ceil( $total_products / 10 );

ob_start();

include PM_PLUGIN_PATH . 'templates/product-table.php';
include PM_PLUGIN_PATH . 'templates/edit-modal.php';
include PM_PLUGIN_PATH . 'templates/add-modal.php';

return ob_get_clean();

	}
}