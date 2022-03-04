<?php


// add WooCommerce account login/logout link to additional nav
function add_loginout_link( $items, $args ) {

	if ( is_user_logged_in() && 'additional' === $args->theme_location ) :

		// $items .= '<li class="menu-item"><a href="/member-directory/">Member Directory</a></li><li class="menu-item">';

		$items .= '<li><a href="' . wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) . '">Log Out</a></li>';

	elseif ( ! is_user_logged_in() && 'additional' === $args->theme_location ) :

		$items .= '<li class="menu-item"><a href="' . get_permalink( wc_get_page_id( 'myaccount' ) ) . '">Member Login</a></li>';
	endif;

	return $items;
}
add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );


// change Company label to institution
add_filter( 'woocommerce_checkout_fields', 'dmc__override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function dmc__override_checkout_fields( $fields ) {
	$fields['billing']['billing_company']['label'] = 'Institution or Company name';
	// $fields['billing']['billing_state']['label'] = 'State or Region';
	return $fields;
}

/**
 * @snippet       Add User Field Conditionally @ WooCommerce Checkout Page
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=20560
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 2.5.5
 */

add_action( 'woocommerce_after_checkout_billing_form', 'dmc_add_fields_no_if_online_course' );
function dmc_add_fields_no_if_online_course( $checkout ) {

	// see if user has a previously saved field of the same (not used) #

	// $current_user = wp_get_current_user();
	// $saved_acu_no = $current_user->student_acu_no;

	// echo field only if dmc_check_product_category() is true
	// if( dmc_check_product_category() ){

	echo '<div id="dmc_specialisation">';
	woocommerce_form_field(
		'dmc_specialisation',
		array(
			'type'        => 'text',
			'class'       => array( 'dmc_specialisation form-row-wide' ),
			'label'       => __( 'Specialisation' ),
			'placeholder' => __( 'Enter your specialisation' ),
			'required'    => true,
			'default'     => '',
		),
		$checkout->get_value( 'dmc_specialisation' )
	);
	echo '</div>';

	 echo '<div id="dmc_position">';
	woocommerce_form_field(
		'dmc_position',
		array(
			'type'        => 'text',
			'class'       => array( 'dmc_position form-row-wide' ),
			'label'       => __( 'Position/Title' ),
			'placeholder' => __( 'Enter your position or title' ),
			'required'    => true,
			'default'     => '',
		),
		$checkout->get_value( 'dmc_position' )
	);
	echo '</div>';

	// }

}

// Function that returns true/false if category is in the cart
// Is called by function bbloomer_add_acu_no_if_online_course()

function dmc_check_product_category() {
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		if ( dmc_is_category_18_in_cart( $product_id ) ) {
			return true;
		}
	}
	return false;
}

// Function that specifies category ID for dmc_check_product_category()
// Is called by function dmc_check_product_category()

function dmc_is_category_18_in_cart( $product_id ) {
	// ID 18 = online courses
	return has_term( 18, 'product_cat', get_post( $product_id ) );
}



// Save Fields Into User Meta

add_action( 'woocommerce_checkout_update_user_meta', 'dmc_checkout_fields_update_user_meta' );
function dmc_checkout_fields_update_user_meta( $user_id ) {

	if ( $user_id && $_POST['dmc_specialisation'] ) {
		update_user_meta( $user_id, 'dmc_specialisation', esc_attr( $_POST['dmc_specialisation'] ) );
	}

	if ( $user_id && $_POST['dmc_position'] ) {
		update_user_meta( $user_id, 'dmc_position', esc_attr( $_POST['dmc_position'] ) );
	}

}

// Display User Fields @ User Profile

add_action( 'show_user_profile', 'dmc_show_user_extra_fields' );
add_action( 'edit_user_profile', 'dmc_show_user_extra_fields' );
function dmc_show_user_extra_fields( $user ) { ?>
	<h3>Additional Fields</h3>
	<table class="form-table">
		<tr>
			<th><label for="dmc_specialisation">Specialisation</label></th>
			<td><input type="text" name="dmc_specialisation" value="<?php echo esc_attr( get_the_author_meta( 'dmc_specialisation', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="dmc_position">Position/Title</label></th>
			<td><input type="text" name="dmc_position" value="<?php echo esc_attr( get_the_author_meta( 'dmc_position', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>
	</table>
	<?php
}

// Save User Field When Changed From the Profile Page

add_action( 'personal_options_update', 'dmc_save_extra_fields' );
add_action( 'edit_user_profile_update', 'dmc_save_extra_fields' );
function dmc_save_extra_fields( $user_id ) {
	update_user_meta( $user_id, 'dmc_specialisation', sanitize_text_field( $_POST['dmc_specialisation'] ) );
	update_user_meta( $user_id, 'dmc_position', sanitize_text_field( $_POST['dmc_position'] ) );
}


function dmc_get_all_active_wc_subscribers() {
	global $wpdb;

	return $wpdb->get_results(
		"
		SELECT DISTINCT u.*
		FROM {$wpdb->prefix}posts as p
		JOIN {$wpdb->prefix}postmeta as pm
			ON p.ID = pm.post_id
		JOIN {$wpdb->prefix}users as u
			ON pm.meta_value = u.ID
		WHERE p.post_type = 'shop_subscription'
		AND p.post_status = 'wc-active'
		AND pm.meta_key = '_customer_user'
		"
	);
}
