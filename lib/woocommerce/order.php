<?php

add_action( 'woocommerce_checkout_order_review', 'dmc_checkout_browser_message', 10 );

function dmc_checkout_browser_message( ) {
	?>
	<div class="highlight">
		<h4>
			Please Note
		</h4>
		<p>
			<strong>
				If you use Internet Explorer and you are having difficulties making payment, please try using a different browser.
			</strong> Alternatively, please check your Windows security settings if you are still having issues.
		</p>
	</div>

<?php
}

// Auto Complete all WooCommerce orders.
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) {
	global $woocommerce;
	if ( ! $order_id )
		return;
	$order = new WC_Order( $order_id );
	$order->update_status( 'completed' );
}
