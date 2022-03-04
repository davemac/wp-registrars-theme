<?php

// modify the main product loop on shop and category pages
function dmc_woo_custom_shop_loop( $query ) {
	if ( ! $query->is_main_query() ) {
		return;
	}
	if ( ! is_admin() && is_shop() || is_product_category() ) {
		// only show variable subscription products in main loop on shop and category pages
		set_query_var(
			'orderby',
			'menu_order'
			// 'tax_query',
			// array(
			//     array(
			//         'taxonomy' => 'product_type',
			//         'field'    => 'slug',
			//         'terms'    => 'variable-subscription',
			//     ),
			// )
		);
		// show products on sale
		// $product_ids_on_sale = wc_get_product_ids_on_sale();
		// $query->set( 'post__not_in', array( $do_not_duplicate ) );
	}
}
add_action( 'woocommerce_product_query', 'dmc_woo_custom_shop_loop' );
// add_filter( 'pre_get_posts', 'dmc_woo_custom_shop_loop' );
