<?php

// Hide ACF in admin menu for certain URLs
function dmc_hide_acf_admin() {
	$site_url = get_bloginfo( 'url' );

	$protected_urls = array(
		'https://registrars.org.au',
		'https://registrars.dmctest.com.au',
	);

	if ( in_array( $site_url, $protected_urls, true ) ) {
		// Hide the ACF menu item
		return false;

	} else {
		return true;
	}
}
add_filter( 'acf/settings/show_admin', 'dmc_hide_acf_admin' );


// adds ACF options page
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title' => 'Sitewide options',
			'menu_title' => 'Sitewide options',
			'menu_slug'  => 'site-global-settings',
			'position'   => 2,
			'capability' => 'edit_posts',
		)
	);
}


// only show published posts for relationship field
function dmc_filter_acf_relationship( $args, $field, $post_id ) {
	$args['post_status'] = 'publish';
	return $args;
}
add_filter( 'acf/fields/relationship/query', 'dmc_filter_acf_relationship', 10, 3 );

// display an ACF smart button field in a repeater
// https://github.com/gillesgoetsch/acf-smart-button
function dmc_button_repeater() {

	if ( have_rows( 'dmc_buttons' ) ) : ?>
	<div class="button-repeater">
		<?php
		while ( have_rows( 'dmc_buttons' ) ) :
			the_row();
			?>
			<?php
			if ( get_sub_field( 'dmc_button' ) ) :
				$dmc_button        = get_sub_field( 'dmc_button' );
				$dmc_button_label  = $dmc_button['text'];
				$dmc_button_url    = $dmc_button['url'];
				$dmc_button_target = $dmc_button['target'];
				?>
			<a href="<?php echo $dmc_button_url; ?>" class="button medium">
				<?php echo $dmc_button_label; ?>
			</a>
				<?php
		endif;
		endwhile;
		?>
	</div>
		<?php
	endif;

}
