<?php
/*
 * Add Serial number section to the Vendor dashboard Product edit tab
 */
add_action( 'dokan_product_edit_after_main', 'test_dashboard_add_serial_number_section', 3, 2 );
function test_dashboard_add_serial_number_section( $post, $product_id ) {
	
	?>
	<div class="dokan-product-features dokan-edit-row">
		<div class="dokan-section-heading" data-togglehandler="dokan_product_features">
			<h2><i class="fa fa-list" aria-hidden="true"></i> <?php _e( 'Serial-number', 'my-textdomain' ) ?></h2>
			<p><?php _e( 'Vendor product serial-number', 'my-textdomain' ) ?></p>
			<a href="#" class="dokan-section-toggle">
				<i class="fa fa-sort-desc fa-flip-vertical" aria-hidden="true"></i>
			</a>
			<div class="dokan-clearfix"></div>
		</div>
		<div class="dokan-section-content">
			<div class="dokan-form-group">
				<label for="test_serial_number" class="form-label"><?php _e( 'Serial number', 'my-textdomain' ) ?></label>
				<?php dokan_post_input_box( $product_id, 'test_serial_number' ); ?>
			</div>
		</div>
	</div>
	<?php
}

/*
 * Update Product Serial number
 */
add_action( 'dokan_product_updated', 'test_dashboard_update_serial_number', 10, 2 );
function test_dashboard_update_serial_number( $product_id, $data ) {
	
	if( isset( $data['test_serial_number'] ) ) {
		
		$product = wc_get_product( $product_id );
		$product->update_meta_data( 'test_serial_number', $data['test_serial_number'], $product->get_id() );
		$product->save();
	}
}

/*
 * Add Serial number to the Dokan REST API Product Response
 */
add_filter( 'dokan_rest_prepare_product_object', 'test_dokan_add_serial_number', 10, 3 );
function test_dokan_add_serial_number( $response, $product, $request ) {
		
	$response_data = $response->get_data();
	$response_data['serial_number'] = $product->get_meta('test_serial_number');
	$response->set_data( $response_data );
	$response = rest_ensure_response( $response );
	
	return $response;
}

/*
 * Update Serial number in the Product meta from Dokan REST API request
 */
add_action( 'dokan_rest_insert_product_object', 'test_dokan_update_serial_number', 10, 3 );
function test_dokan_update_serial_number( $product, $request, $creating ) {
	

	if( isset( $request['serial_number'] ) ) {
		
		$product->update_meta_data( 'test_serial_number', $request['serial_number'], $product->get_id() );
		$product->save();
	}
}
