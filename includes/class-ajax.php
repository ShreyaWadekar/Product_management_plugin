<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PM_Ajax {

	public function __construct() {

		add_action( 'wp_ajax_pm_update_product', array( $this, 'update_product' ) );

        add_action(
	'wp_ajax_pm_delete_product',
	array( $this, 'delete_product' )
);

        add_action(
	'wp_ajax_pm_create_product',
	array( $this, 'create_product' )
);

	}

	public function update_product() {

	check_ajax_referer( 'pm_nonce', 'nonce' );

	if ( ! current_user_can( 'edit_products' ) ) {

		wp_send_json_error(
			array(
				'message' => 'Permission Denied.'
			)
		);

	}

	$product_id = absint( $_POST['product_id'] );

	$product = wc_get_product( $product_id );

	if ( ! $product ) {

		wp_send_json_error(
			array(
				'message' => 'Product Not Found.'
			)
		);

	}

	$product->set_name(
		sanitize_text_field( $_POST['product_name'] )
	);

	$product->set_regular_price(
		wc_format_decimal( $_POST['regular_price'] )
	);

	$product->set_sale_price(
		wc_format_decimal( $_POST['sale_price'] )
	);

	$product->set_stock_quantity(
		absint( $_POST['stock'] )
	);

	$product->set_stock_status(
		sanitize_text_field( $_POST['stock_status'] )
	);

	$product->save();

	wp_send_json_success(
		array(
			'message' => 'Product Updated Successfully!'
		)
	);

}

public function delete_product() {

	check_ajax_referer( 'pm_nonce', 'nonce' );

	if ( ! current_user_can( 'delete_products' ) ) {

		wp_send_json_error(
			array(
				'message' => 'Permission Denied.'
			)
		);

	}

	$product_id = absint( $_POST['product_id'] );

	$product = wc_get_product( $product_id );

	if ( ! $product ) {

		wp_send_json_error(
			array(
				'message' => 'Product Not Found.'
			)
		);

	}

	$product->delete( true );

	wp_send_json_success(
		array(
			'message' => 'Product Deleted Successfully!'
		)
	);

}

public function create_product() {

	check_ajax_referer( 'pm_nonce', 'nonce' );

	if ( ! current_user_can( 'edit_products' ) ) {

		wp_send_json_error(
			array(
				'message' => 'Permission Denied.'
			)
		);

	}

	$product = new WC_Product_Simple();

	$product->set_name(
		sanitize_text_field( $_POST['product_name'] )
	);

	$product->set_regular_price(
		wc_format_decimal( $_POST['regular_price'] )
	);

	$product->set_sale_price(
		wc_format_decimal( $_POST['sale_price'] )
	);

	$product->set_stock_quantity(
		absint( $_POST['stock'] )
	);

	$product->set_stock_status(
		sanitize_text_field( $_POST['stock_status'] )
	);

	$product->set_catalog_visibility( 'visible' );

	$product->set_status( 'publish' );

	$product_id = $product->save();

	if ( ! empty( $_POST['image_id'] ) ) {

		set_post_thumbnail(
			$product_id,
			absint( $_POST['image_id'] )
		);

	}

	wp_send_json_success(
		array(
			'message' => 'Product Created Successfully!'
		)
	);

}
}