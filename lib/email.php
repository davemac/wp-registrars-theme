<?php

// change name and email address for admin emails

add_filter( 'wp_mail_from', 'dmc_new_mail_from' );

function dmc_new_mail_from( $old ) {
	$dmc_site_email = get_bloginfo( 'admin_email' );
	return $dmc_site_email;
}

add_filter( 'wp_mail_from_name', 'dmc_new_mail_from_name' );

function dmc_new_mail_from_name( $old ) {
	$dmc_site_name = get_bloginfo( 'name' );
	return $dmc_site_name;
}


/**
	* Hide email from Spam Bots using a shortcode.
	*
	* @param array  $atts    Shortcode attributes. Not used.
	* @param string $content The shortcode content. Should be an email address.
	*
	* @return string The obfuscated email address.
	*/
function wpcodex_hide_email_shortcode( $atts, $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}

	return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
}
	add_shortcode( 'email', 'wpcodex_hide_email_shortcode' );

	// Allow shortcodes in widget_text
	add_filter( 'widget_text', 'shortcode_unautop' );
	add_filter( 'widget_text', 'do_shortcode' );
