<?php

/**********************
Enqueue CSS and Scripts
**********************/

// enque WP and vendor scripts
function dmcstarter_scripts_and_styles() {

	if ( ! is_admin() ) {

		// modernizr (customised from Gruntfile.js)
		wp_enqueue_script( 'dmcstarter-modernizr', get_template_directory_uri() . '/js/modernizr-custom.min.js', array(), '3.5.0', false );

		// only add WP comment-reply.min.js if threaded comments are on an it's a post of some type
		if ( get_option( 'thread_comments' ) && is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// add Foundation and vendor scripts files in the footer
		wp_enqueue_script( 'dmcstarter-js', get_template_directory_uri() . '/js/bower.min.js', array( 'jquery' ), 'false', true );

		if ( is_page( 11 ) ) {
			wp_register_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'isotope-init', get_template_directory_uri() . '/js/isotope-init.js', array( 'isotope' ), '3.0', true );
		}

		$gapi     = GOOGLE_API_KEY;
		$maps_url = 'https://maps.googleapis.com/maps/api/js?key=' . $gapi;
		wp_register_script( 'googlemap-js-api', $maps_url, '', 'false', false );

		wp_enqueue_script( 'acf-googlemap', get_template_directory_uri() . '/js/maps-init.js', array( 'googlemap-js-api' ), 'false', true );
	}
}
add_action( 'wp_enqueue_scripts', 'dmcstarter_scripts_and_styles' );

// https://wpshout.com/make-site-faster-async-deferred-javascript-introducing-script_loader_tag/
function dmc_defer_scripts( $tag, $handle, $src ) {
	// The handles of the enqueued scripts we want to defer
	$defer_scripts = array(
		// 'addevent',
		// 'admin-bar',
		// 'cookie',
		'devicepx',
		'comment-reply',
		'jquery-migrate',
	);
	if ( in_array( $handle, $defer_scripts, true ) ) {
		return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'dmc_defer_scripts', 10, 3 );


// vendor styles
function dmcstarter_enqueue_style() {

	// Google fonts
	wp_enqueue_style( 'google-font', 'https://fonts.googleapis.com/css?family=Noticia+Text|Source+Sans+Pro:400,600&display=swap', array(), 'false', 'all' );

	// main stylesheet
	wp_enqueue_style( 'dmcstarter-stylesheet', get_stylesheet_directory_uri() . '/css/style.css', array(), 'false', 'all' );

	// vendor styles
	wp_enqueue_style( 'vendor', get_template_directory_uri() . '/css/vendor.css', array(), 'false', 'all' );

}
add_action( 'wp_enqueue_scripts', 'dmcstarter_enqueue_style' );


// only load WooCommerce styles and scripts on WooCommerce pages
function dmc_conditionally_load_woc_js_css() {
	if ( function_exists( 'is_woocommerce' ) ) {
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! is_account_page() ) {

			## Dequeue scripts.
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-cart-fragments' );

			## Dequeue styles.
			wp_dequeue_style( 'woocommerce-general' );
			wp_dequeue_style( 'woocommerce-layout' );
			wp_dequeue_style( 'woocommerce-smallscreen' );

		}
	}
}
add_action( 'wp_enqueue_scripts', 'dmc_conditionally_load_woc_js_css' );
