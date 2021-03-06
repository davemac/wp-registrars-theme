<?php
// theme setup

if ( ! isset( $content_width ) ) {
	$content_width = 757;
}

// start all the functions
add_action( 'after_setup_theme', 'dmcstarter_startup' );

function dmcstarter_startup() {
	// launching operation cleanup
	add_action( 'init', 'dmcstarter_head_cleanup' );
	// remove WP version from RSS
	add_filter( 'the_generator', 'dmcstarter_rss_version' );
	// additional post related cleaning
	add_filter( 'img_caption_shortcode', 'dmcstarter_cleaner_caption', 10, 3 );
	add_filter( 'get_image_tag', 'dmcstarter_image_editor', 0, 4 );
	// tracking pixels
	// add_action( 'wp_head', 'dmc_linkedin_pixel' );
	// add_action( 'wp_head', 'dmc_facebook_pixel' );
	// add_action( 'wp_head', 'dmc_gtm_tracking_code' );
	// add_action( 'wp_body_open', 'dmc_gtm_tracking_code_nojs' );
}


function dmcstarter_theme_support() {
	// Add language supports.
	load_theme_textdomain( 'dmcstarter', get_template_directory() . '/languages' );

	// Add theme support for HTML5 Semantic Markup
	add_theme_support( 'html5', array( 'comment-form', 'comment-list' ) );
	// Add theme support for document Title tag
	add_theme_support( 'title-tag' );

	// custom logo
	$defaults = array(
		'height'      => 62,
		'width'       => 328,
		'flex-height' => false,
		'flex-width'  => false,
		'header-text' => array( 'site-title', 'site-description' ),
	);
	add_theme_support( 'custom-logo', $defaults );

	// add excerpts to these post types
	$types = array( 'page' );
	foreach ( $types as $type ) {
		add_post_type_support( $type, 'excerpt' );
	}

	// add_post_type_support( 'jetpack-portfolio', 'archive' );

	// Add post thumbnail supports
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'fd-lrg', 1024, 99999 );
	add_image_size( 'fd-med', 768, 99999 );
	add_image_size( 'fd-sm', 320, 9999 );
	add_image_size( 'dmc-slider', 1440, 600 );
	add_image_size( 'dmc-logo', 328, 62 ); // for site logo @2x

	// rss feed
	add_theme_support( 'automatic-feed-links' );

	// Add menu support
	register_nav_menus(
		array(
			'primary'     => __( 'Primary Navigation', 'dmcstarter' ),
			'additional'  => __( 'Additional Navigation', 'dmcstarter' ),
			'contact'     => __( 'Contact Navigation', 'dmcstarter' ),
			'about'       => __( 'About Navigation', 'dmcstarter' ),
			'information' => __( 'Information Navigation', 'dmcstarter' ),
			'resources'   => __( 'Resources Navigation', 'dmcstarter' ),
		)
	);

	// Jetpack Infinite Scroll, preset to button click
	add_theme_support(
		'infinite-scroll',
		array(
			'container'      => 'dmc-infinite',
			// 'footer'		=> 'page',
			'type'           => 'click',
			// 'footer_widgets' => false,
			'wrapper'        => false,
			// 'render'         => 'dmc_infinite_scroll_render',
			'posts_per_page' => 3,
		)
	);
}
add_action( 'after_setup_theme', 'dmcstarter_theme_support' );


// wp_head cleanup
function dmcstarter_head_cleanup() {
	// removeWP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'dmcstarter_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'dmcstarter_remove_wp_ver_css_js', 9999 );

} /* end head cleanup */


// remove WP version from RSS
if ( ! function_exists( 'dmcstarter_rss_version ' ) ) {
	function dmcstarter_rss_version() {
		return ''; }
}


// remove WP version from scripts
function dmcstarter_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}


/*********************
Post related cleaning
*********************/
/* Customized the output of caption, you can remove the filter to restore back to the WP default output. Courtesy of DevPress. http://devpress.com/blog/captions-in-wordpress/ */
function dmcstarter_cleaner_caption( $output, $attr, $content ) {

	/* We're not worried abut captions in feeds, so just return the output here. */
	if ( is_feed() ) {
		return $output;
	}

	/* Set up the default arguments. */
	$defaults = array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => '',
	);

	/* Merge the defaults with user input. */
	$attr = shortcode_atts( $defaults, $attr );

	/* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
	if ( 1 > $attr['width'] || empty( $attr['caption'] ) ) {
		return $content;
	}

	/* Set up the attributes for the caption <div>. */
	$attributes = ' class="figure ' . esc_attr( $attr['align'] ) . '"';

	/* Open the caption <div>. */
	$output = '<figure' . $attributes . '>';

	/* Allow shortcodes for the content the caption was created for. */
	$output .= do_shortcode( $content );

	/* Append the caption text. */
	$output .= '<figcaption>' . $attr['caption'] . '</figcaption>';

	/* Close the caption </div>. */
	$output .= '</figure>';

	/* Return the formatted, clean caption. */
	return $output;

} /* end dmcstarter_cleaner_caption */


// Remove width and height in editor, for a better responsive world.
function dmcstarter_image_editor( $html, $id, $alt, $title ) {
	return preg_replace(
		array(
			'/\s+width="\d+"/i',
			'/\s+height="\d+"/i',
			'/alt=""/i',
		),
		array(
			'',
			'',
			'',
			'alt="' . $title . '"',
		),
		$html
	);
} /* end dmcstarter_image_editor */
