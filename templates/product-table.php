<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="pm-product-manager">

	<h2>Product Manager</h2>

    <div class="pm-toolbar">

    <div class="pm-left-tools">

        <input 
    type="text" 
    id="pm-search" 
    placeholder="Search products..."
    value="<?php echo esc_attr( $search ); ?>"
>
    </div>

    <div class="pm-right-tools">

        <select id="pm-sort">

	<option value="">Sort By</option>

	<option
		value="name_asc"
		<?php selected( $sort, 'name_asc' ); ?>
	>
		Name (A - Z)
	</option>

	<option
		value="name_desc"
		<?php selected( $sort, 'name_desc' ); ?>
	>
		Name (Z - A)
	</option>

	<option
		value="price_low"
		<?php selected( $sort, 'price_low' ); ?>
	>
		Price (Low - High)
	</option>

	<option
		value="price_high"
		<?php selected( $sort, 'price_high' ); ?>
	>
		Price (High - Low)
	</option>

	<option
		value="newest"
		<?php selected( $sort, 'newest' ); ?>
	>
		Newest First
	</option>

	<option
		value="oldest"
		<?php selected( $sort, 'oldest' ); ?>
	>
		Oldest First
	</option>

</select>

        <button id="pm-add-product">

            + Add Product

        </button>

    </div>

</div>

	<table class="pm-table">

		<thead>

			<tr>

				<th>Image</th>

				<th>Product Name</th>

				<th>Price</th>

				<th>Stock</th>

				<th>Status</th>

				<th>Actions</th>

			</tr>

		</thead>

		<tbody>

		<?php if ( ! empty( $products ) ) : ?>

			<?php foreach ( $products as $product ) : ?>

				<tr>

					<td>

						<?php echo $product->get_image( array( 60, 60 ) ); ?>

					</td>

					<td>

						<?php echo esc_html( $product->get_name() ); ?>

					</td>

					<td>

						<?php echo wp_kses_post( wc_price( $product->get_price() ) ); ?>

					</td>

					<td>

						<?php echo esc_html( $product->get_stock_quantity() ); ?>

					</td>

					<td>

						<?php echo esc_html( $product->get_stock_status() ); ?>

					</td>

					<td>

						<button
    class="pm-edit-btn"
    data-id="<?php echo esc_attr( $product->get_id() ); ?>"
    data-name="<?php echo esc_attr( $product->get_name() ); ?>"
    data-regular-price="<?php echo esc_attr( $product->get_regular_price() ); ?>"
    data-sale-price="<?php echo esc_attr( $product->get_sale_price() ); ?>"
    data-stock="<?php echo esc_attr( $product->get_stock_quantity() ); ?>"
    data-status="<?php echo esc_attr( $product->get_stock_status() ); ?>"
    data-image="<?php echo esc_url( wp_get_attachment_image_url( $product->get_image_id(), 'medium' ) ); ?>"
>
    Edit
</button>

						<button
	class="pm-delete-btn"
	data-id="<?php echo esc_attr( $product->get_id() ); ?>"
>
	Delete
</button>

					</td>

				</tr>

			<?php endforeach; ?>

		<?php else : ?>

			<tr>

				<td colspan="6">

					No Products Found

				</td>

			</tr>

		<?php endif; ?>

		</tbody>

	</table>
   <?php if ( $total_pages > 1 ) : ?>

    <div class="pm-pagination">

        <?php
        echo paginate_links(
            array(
                'base'      => esc_url( add_query_arg( 'pm_page', '%#%' ) ),
                'format'    => '',
                'current'   => max( 1, $paged ),
                'total'     => $total_pages,
                'prev_text' => '« Previous',
                'next_text' => 'Next »',
                'add_args'  => array(
                    'pm_sort'   => $sort,
                    'pm_search' => $search,
                ),
            )
        );
        ?>

    </div>

<?php endif; ?>

</div>