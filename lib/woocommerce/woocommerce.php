<?php

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_post_type_support( 'product', 'excerpt' );

	// rmove shop title
	add_filter( 'woocommerce_show_page_title', '__return_false' );
}

// remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// User account field customisations
require_once get_template_directory() . '/lib/woocommerce/account.php';

// Cart customisations
require_once get_template_directory() . '/lib/woocommerce/cart.php';

// Layout customisations
// require_once get_template_directory() . '/lib/woocommerce/layout.php';

// Category & Shop customisations
// require_once get_template_directory() . '/lib/woocommerce/category.php';

// Ordering customisations
require_once get_template_directory() . '/lib/woocommerce/order.php';


/**
* Preview WooCommerce Emails.
* @author WordImpress.com
* @url https://github.com/WordImpress/woocommerce-preview-emails
*/
$preview = get_stylesheet_directory() . '/woocommerce/emails/woo-preview-emails.php';
if ( file_exists( $preview ) ) {
	require $preview;
}

// add currency symbol before prices
add_filter( 'woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2 );
function change_existing_currency_symbol( $currency_symbol, $currency ) {
	switch ( $currency ) {
		case 'AUD':
			$currency_symbol = 'AUD$';
			break;
	}
	return $currency_symbol;
}


// redirect shop page
add_filter( 'woocommerce_return_to_shop_redirect', 'dmc_woo_return_to_shop_redirect', 20 );
function dmc_woo_return_to_shop_redirect() {
	return site_url() . '/product/membership/';
}

// Remove Sidebar on all the Single Product Pages
add_action( 'wp', 'woo_remove_sidebar_product_pages' );
function woo_remove_sidebar_product_pages() {
	if ( is_product() ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
}

// move product description to top of single product page
function woocommerce_template_product_description() {
	wc_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_before_single_product', 'woocommerce_template_product_description', 20 );


// remove product tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
	unset( $tabs['description'] );       // Remove the description tab
	unset( $tabs['reviews'] );          // Remove the reviews tab
	unset( $tabs['additional_information'] );   // Remove the additional information tab
	return $tabs;
}


// remove breadcrumbs
add_action( 'template_redirect', 'dmc_remove_wc_breadcrumbs' );
function dmc_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
}


/**
 * Change on single product panel "Product Description"
 * since it already says "features" on tab.
 */
add_filter( 'woocommerce_product_description_heading', 'dmc_product_description_heading' );

function dmc_product_description_heading() {
	return __( 'Membership', 'woocommerce' );
}


/**
 * Change text strings
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function dmc_woo_text_strings( $translated_text, $text, $domain ) {
	if ( ! is_admin() ) {

		switch ( $translated_text ) {
			case 'An order has been created for you on':
				$translated_text = __( 'A purchase order has been created for you by the', 'woocommerce' );
				break;

			case 'Pay for this order':
				$translated_text = __( 'To pay for your order by direct debit or credit card please use the following link:', 'woocommerce' );
				break;

			case 'An order has been created for you on':
				$translated_text = __( 'A purchase order has been created for you by the', 'woocommerce' );
				break;

		}
	}
	return $translated_text;
}
add_filter( 'gettext', 'dmc_woo_text_strings', 20, 3 );
