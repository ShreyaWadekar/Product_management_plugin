jQuery(function ($) {

    // Open Modal
    $(document).on('click', '.pm-edit-btn', function () {

    let button = $(this);

    $('#pm-product-id').val(button.data('id'));
    $('#pm-product-name').val(button.data('name'));
    $('#pm-regular-price').val(button.data('regular-price'));
    $('#pm-sale-price').val(button.data('sale-price'));
    $('#pm-stock').val(button.data('stock'));
    $('#pm-stock-status').val(button.data('status'));

    $('#pm-image-preview').attr('src', button.data('image'));

    $('#pm-edit-modal').fadeIn();

});

    // Close Button
    $(document).on('click', '.pm-close', function () {

        $('#pm-edit-modal').fadeOut();

    });

    // Click Outside Modal
    $(window).on('click', function (e) {

        if ($(e.target).is('#pm-edit-modal')) {

            $('#pm-edit-modal').fadeOut();

        }

    });

    $('#pm-edit-form').on('submit', function (e) {

    e.preventDefault();

    $.ajax({

        url: pm_ajax.ajax_url,

        type: 'POST',

        data: {

            action: 'pm_update_product',

            nonce: pm_ajax.nonce,

            product_id: $('#pm-product-id').val(),

            product_name: $('#pm-product-name').val(),

            regular_price: $('#pm-regular-price').val(),

            sale_price: $('#pm-sale-price').val(),

            stock: $('#pm-stock').val(),

            stock_status: $('#pm-stock-status').val()

        },

        success: function (response) {

            if (response.success) {

    alert(response.data.message);

    location.reload();

} else {

    alert(response.data.message);

}

        }

    });

});

$(document).on('click', '.pm-delete-btn', function () {

    let button = $(this);

    let productID = button.data('id');

    if (!confirm('Are you sure you want to delete this product?')) {
        return;
    }

    $.ajax({

        url: pm_ajax.ajax_url,

        type: 'POST',

        data: {

            action: 'pm_delete_product',

            nonce: pm_ajax.nonce,

            product_id: productID

        },

        success: function (response) {

            if (response.success) {

                alert(response.data.message);

                button.closest('tr').fadeOut(300, function () {
                    $(this).remove();
                });

            } else {

                alert(response.data.message);

            }

        }

    });

});


$('#pm-add-product').on('click', function () {

    $('#pm-add-modal').fadeIn();

});

$('.pm-add-close').on('click', function () {

    $('#pm-add-modal').fadeOut();

});

$(window).on('click', function (e) {

    if ($(e.target).is('#pm-add-modal')) {

        $('#pm-add-modal').fadeOut();

    }

});

let mediaUploader;

$('#pm-upload-image').on('click', function (e) {

	e.preventDefault();

	if (mediaUploader) {

		mediaUploader.open();

		return;

	}

	mediaUploader = wp.media({

		title: 'Select Product Image',

		button: {

			text: 'Use Image'

		},

		multiple: false

	});

	mediaUploader.on('select', function () {

		let attachment = mediaUploader
			.state()
			.get('selection')
			.first()
			.toJSON();

		$('#pm-new-image-id').val(attachment.id);

		$('#pm-add-image-preview')
    .attr('src', attachment.url)
    .show();

	});

	mediaUploader.open();

});

$('#pm-add-form').on('submit', function (e) {

	e.preventDefault();

	$.ajax({

		url: pm_ajax.ajax_url,

		type: 'POST',

		data: {

			action: 'pm_create_product',

			nonce: pm_ajax.nonce,

			product_name: $('#pm-new-name').val(),

			regular_price: $('#pm-new-regular-price').val(),

			sale_price: $('#pm-new-sale-price').val(),

			stock: $('#pm-new-stock').val(),

			stock_status: $('#pm-new-status').val(),

			image_id: $('#pm-new-image-id').val()

		},

		success: function (response) {

			if (response.success) {

				alert(response.data.message);

				location.reload();

			} else {

				alert(response.data.message);

			}

		}

	});

});

$('#pm-sort').on('change', function () {

	let value = $(this).val();

	let url = new URL(window.location.href);

	if (value) {
		url.searchParams.set('pm_sort', value);
	} else {
		url.searchParams.delete('pm_sort');
	}

	// Reset to first page when sorting changes
	url.searchParams.delete('pm_page');

	window.location.href = url.toString();

});

$('#pm-search').on('keydown', function (e) {

    if (e.key === 'Enter') {

        e.preventDefault();

        let value = $(this).val().trim();

        let url = new URL(window.location.href);

        if (value) {
            url.searchParams.set('pm_search', value);
        } else {
            url.searchParams.delete('pm_search');
        }

        // Always go back to page 1 for a new search
        url.searchParams.delete('pm_page');

        window.location.href = url.toString();
    }

});

// Clear Search
$(document).on('click', '#pm-clear-search', function (e) {

    e.preventDefault();

    // Clear the search input immediately
    $('#pm-search').val('');

    let url = new URL(window.location.href);

    // Remove search parameter
    url.searchParams.delete('pm_search');

    // Reset pagination
    url.searchParams.delete('pm_page');

    // Reload page with all products
    window.location.href = url.toString();

});
});