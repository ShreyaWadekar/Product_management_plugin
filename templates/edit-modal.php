<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="pm-edit-modal" class="pm-modal">

	<div class="pm-modal-content">

		<span class="pm-close">&times;</span>

		<h2>Edit Product</h2>

		<form id="pm-edit-form">

			<input type="hidden" id="pm-product-id">

            <div class="pm-product-image">

    <img id="pm-image-preview" src="" alt="Product Image">

</div>

			<p>

				<label>Product Name</label>

				<input type="text" id="pm-product-name">

			</p>

			<p>

				<label>Regular Price</label>

				<input type="number" id="pm-regular-price">

			</p>

			<p>

				<label>Sale Price</label>

				<input type="number" id="pm-sale-price">

			</p>

			<p>

				<label>Stock Quantity</label>

				<input type="number" id="pm-stock">

			</p>

			<p>

				<label>Stock Status</label>

				<select id="pm-stock-status">

					<option value="instock">In Stock</option>

					<option value="outofstock">Out of Stock</option>

				</select>

			</p>

			<p>

				<button type="submit">

					Update Product

				</button>

			</p>

		</form>

	</div>

</div>