![logo](https://upsite.top/wp-content/uploads/2023/12/UPsiteLogo_800x800-150x150.png, "UPsite Top - IT development company from Ukraine creates and supports custom WordPress plugins" )
+ [**UPsite Top** custom WordPress plugins creates and supports](https://upsite.top/wordpress-development/)
# Wordpress SSE ( Server Sent Events ) demo plugin
The purpose of creating SSE example plugin is to demonstrate a practical solution for using SSE technology when creating WordPress plugins
### Dependencies
+ [Woocommerce](https://woocommerce.com/download/)
+ [Dokan](https://dokan.co/wordpress/download/)
### Process description
Add Custom field to the Dokan REST API Product Response
```php
add_filter( 'dokan_rest_prepare_product_object', 'test_dokan_add_custom_field', 10, 3 );
function test_dokan_add_custom_field( $response, $product, $request ) {
		
	$response_data = $response->get_data();
	$response_data['custom_field'] = $product->get_meta('custom_field_meta_key');
	$response->set_data( $response_data );
	$response = rest_ensure_response( $response );
	
	return $response;
}

```
Update Custom field in the Product meta from Dokan REST API request
```php
/*
 * Update Custom field in the Product meta from Dokan REST API request
 */
add_action( 'dokan_rest_insert_product_object', 'test_dokan_update_custom_fieldr', 10, 3 );
function test_dokan_update_custom_field( $product, $request, $creating ) {
	

	if( isset( $request['custom_field'] ) ) {
		
		$product->update_meta_data( 'custom_field_meta_key', $request['custom_field'], $product->get_id() );
		$product->save();
	}
}

```
### Used WordPress hooks
+ dokan_product_edit_after_main
+ dokan_product_updated
+ dokan_rest_prepare_product_object
+ dokan_rest_insert_product_object
### Video denonstration
[![video](https://upsite.top/wp-content/uploads/2023/12/sse_git_caption.png)](https://youtu.be/PrwtrKyzWYY)
