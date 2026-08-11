<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="pm-add-modal" class="pm-modal">

	<div class="pm-modal-content">

		<span class="pm-add-close">&times;</span>

		<h2>Add Product</h2>

		<form id="pm-add-form">

			<p>

				<label>Product Name</label>

				<input
					type="text"
					id="pm-new-name"
					required
				>

			</p>

            <p>

	<label>Product Image</label>

	<div class="pm-image-upload">

		<img
			id="pm-add-image-preview"
			src=""
			alt="Product Image"
			style="display:none;"
		>

		<input
			type="hidden"
			id="pm-new-image-id"
		>

		<button
			type="button"
			id="pm-upload-image"
		>

			Choose Image

		</button>

	</div>

</p>

			<p>

				<label>Regular Price</label>

				<input
					type="number"
					id="pm-new-regular-price"
				>

			</p>

			<p>

				<label>Sale Price</label>

				<input
					type="number"
					id="pm-new-sale-price"
				>

			</p>

			<p>

				<label>Stock Quantity</label>

				<input
					type="number"
					id="pm-new-stock"
				>

			</p>

			<p>

				<label>Stock Status</label>

				<select id="pm-new-status">

					<option value="instock">

						In Stock

					</option>

					<option value="outofstock">

						Out Of Stock

					</option>

				</select>

			</p>

			<p>

				<button type="submit">

					Create Product

				</button>

			</p>

		</form>

	</div>

</div>