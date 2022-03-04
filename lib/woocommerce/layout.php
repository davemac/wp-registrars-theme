<?php

// change the layout container divs
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'dmc_theme_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'dmc_theme_wrapper_end', 10 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_product_loop_start', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

function dmc_theme_wrapper_start() {
	if ( is_product() ) {
		echo '<div class="medium-12 columns" id="content" role="main">';
	} elseif ( is_shop() || is_cart() ) {
		echo '<div class="medium-9 columns" id="content" role="main">';
	}
}


function dmc_theme_wrapper_end() {
	echo '</div>';
	if ( ! is_shop() ) {
		// get_sidebar();
	}
}


// adds custom global header image to shop pages
add_filter( 'woocommerce_before_main_content', 'dmc_woo_display_global_header', 5 );
// add_filter( 'woocommerce_before_cart', 'dmc_woo_display_global_header' );
if ( ! function_exists( 'dmc_woo_display_global_header' ) ) {
	function dmc_woo_display_global_header() { ?>
		<section class="header-image">
			 <?php
				if ( get_field( 'dmc_global_header_image', 'option' ) ) :
					?>
		<div class="hero" style="background-image: url('<?php the_field( 'dmc_global_header_image', 'option' ); ?>')">
			<header class="row">
				 <div class="small-12 medium-6 medium-push-6 columns">
					<h1><?php the_title(); ?></h1>
				</div>
			</header>
		</div>
					<?php
	 endif;
				?>
		</section>
		<?php
	}
}

// Display 24 products per page
// add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );


// add an alignment wrapper around the product title, remove the action first, then add it back with a custom function
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'dmc_woocommerce_template_loop_product_title', 10 );

if ( ! function_exists( 'dmc_woocommerce_template_loop_product_title' ) ) {
	function dmc_woocommerce_template_loop_product_title() {
			echo '<div class="title-container"><div class="title-layout"><h3>' . get_the_title() . '</h3></div></div>';
	}
}


// modify the breadcrumb home link
add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
function woo_custom_breadrumb_home_url() {
	return '/shop';
}


// modify the breadcrumb home title
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
	return array(
		'delimiter'   => ' &gt; ',
		'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
		'wrap_after'  => '</nav>',
		'before'      => '',
		'after'       => '',
		'home'        => _x( 'Get Started', 'breadcrumb', 'woocommerce' ),
	);
}

// remove breadcrumbs on shop category pages
add_action( 'template_redirect', 'dmc_remove_wc_breadcrumbs' );
function dmc_remove_wc_breadcrumbs() {
	if ( is_shop() ) {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	}
}


// remove product tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
	// unset( $tabs['description'] );       // Remove the description tab
	unset( $tabs['reviews'] );          // Remove the reviews tab
	unset( $tabs['additional_information'] );   // Remove the additional information tab
	return $tabs;
}


// move the title above the product image on shop pages
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );


// move price to below image on shop pages
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 20 );

// move rating to below image on shop pages
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 25 );


add_action( 'woocommerce_after_shop_loop_item_title', 'output_product_excerpt', 35 );
function output_product_excerpt() {
	?>
	<div class="description">
		<?php the_excerpt(); ?>
	</div>
	<?php
}

// move price below summary on single product pages
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );
