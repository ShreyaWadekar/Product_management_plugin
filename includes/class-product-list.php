<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Product List Class
 */
class PM_Product_List {

	/**
	 * Get WooCommerce Products
	 *
	 * @return array
	 */
	public function get_products(
    $paged = 1,
    $per_page = 10,
    $sort = '',
    $search = ''
) {

	$args = array(
    'status' => array( 'publish' ),
    'limit'  => $per_page,
    'page'   => $paged,
    'return' => 'objects',
);
if ( ! empty( $search ) ) {
    $args['s'] = $search;
}

switch ( $sort ) {

    case 'name_asc':
        $args['orderby'] = 'title';
        $args['order']   = 'ASC';
        break;

    case 'name_desc':
        $args['orderby'] = 'title';
        $args['order']   = 'DESC';
        break;
                            
    case 'newest':
        $args['orderby'] = 'date';
        $args['order']   = 'DESC';
        break;

    case 'oldest':
        $args['orderby'] = 'date';
        $args['order']   = 'ASC';
        break;

    case 'price_low':
        $args['orderby'] = 'meta_value_num';
        $args['meta_key'] = '_price';
        $args['order'] = 'ASC';
        break;

    case 'price_high':
        $args['orderby'] = 'meta_value_num';
        $args['meta_key'] = '_price';
        $args['order'] = 'DESC';
        break;

}

	return wc_get_products( $args );
}
}