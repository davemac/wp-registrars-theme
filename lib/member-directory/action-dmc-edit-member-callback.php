<?php
function dmc_edit_member_callback() {

	if (
		! isset( $_POST['dmc_edit_member_nonce'] )
		|| ! wp_verify_nonce( $_POST['dmc_edit_member_nonce'], 'dmc_edit_member' )
	) :
		print 'Sorry, your nonce did not verify.';
		exit;
	else :

		$form_errors = new WP_Error();

		$user_id = sanitize_text_field( $_POST['user_id'] );

		$dmc_md_allow_listing = sanitize_text_field( $_POST['dmc_md_allow_listing'] );

		if ( isset( $_POST['dmc_md_firstname'] ) && ! empty( $_POST['dmc_md_firstname'] ) ) :
			$first_name = sanitize_text_field( $_POST['dmc_md_firstname'] );
			update_user_meta( $user_id, 'first_name', $first_name );
		else :
			$form_errors->add( $code = 'first_name', $message = 'First name field cannot be empty.', $data = 'dmc_error' );
		endif;

		if ( isset( $_POST['dmc_md_lastname'] ) && ! empty( $_POST['dmc_md_lastname'] ) ) :
			$last_name = sanitize_text_field( $_POST['dmc_md_lastname'] );
			update_user_meta( $user_id, 'last_name', $last_name );
		else :
			$form_errors->add( $code = 'last_name', $message = 'Last name field cannot be empty.', $data = 'dmc_error' );
		endif;

		if ( isset( $_POST['dmc_md_display_name'] ) ) :
			$dmc_md_display_name = sanitize_text_field( $_POST['dmc_md_display_name'] );
			wp_update_user(
				array(
					'ID'           => $user_id,
					'display_name' => $dmc_md_display_name,
				)
			);
		endif;

		if ( isset( $_POST['dmc_md_position'] ) ) :
			$dmc_md_position = sanitize_text_field( $_POST['dmc_md_position'] );
			update_user_meta( $user_id, 'dmc_position', $dmc_md_position );
		endif;

		if ( isset( $_POST['dmc_md_company'] ) ) :
			$dmc_md_company = sanitize_text_field( $_POST['dmc_md_company'] );
			update_user_meta( $user_id, 'billing_company', $dmc_md_company );
		endif;

		if ( isset( $_POST['dmc_md_specialisation'] ) ) :
			$dmc_md_specialisation = sanitize_text_field( $_POST['dmc_md_specialisation'] );
			update_user_meta( $user_id, 'dmc_specialisation', $dmc_md_specialisation );
		endif;

		if ( isset( $_POST['dmc_md_url'] ) ) :
			$dmc_md_url = sanitize_text_field( $_POST['dmc_md_url'] );
			update_user_meta( $user_id, 'user_url', $dmc_md_url );
		endif;

		if ( isset( $_POST['dmc_md_twitter'] ) ) :
			$dmc_md_twitter = sanitize_text_field( $_POST['dmc_md_twitter'] );
			update_user_meta( $user_id, 'twitter_handle', $dmc_md_twitter );
		endif;

		if ( isset( $_POST['dmc_md_city'] ) ) :
			$dmc_md_city = sanitize_text_field( $_POST['dmc_md_city'] );
			update_user_meta( $user_id, 'billing_city', $dmc_md_city );
		endif;

		if ( isset( $_POST['dmc_md_state'] ) ) :
			$dmc_md_state = sanitize_text_field( $_POST['dmc_md_state'] );
			update_user_meta( $user_id, 'billing_state', $dmc_md_state );
		endif;

		if ( isset( $_POST['dmc_md_country'] ) ) :
			$dmc_md_country = sanitize_text_field( $_POST['dmc_md_country'] );
			update_user_meta( $user_id, 'billing_country', $dmc_md_country );
		endif;

		if ( isset( $_POST['dmc_md_phone'] ) ) :
			$dmc_md_phone = sanitize_text_field( $_POST['dmc_md_phone'] );
			update_user_meta( $user_id, 'billing_phone', $dmc_md_phone );
		endif;

		if ( isset( $_POST['dmc_md_bio'] ) ) :
			$dmc_md_bio = sanitize_text_field( $_POST['dmc_md_bio'] );
			update_user_meta( $user_id, 'description', $dmc_md_bio );
		endif;

		update_user_meta( $user_id, 'dmc_allow_member_directory', $dmc_md_allow_listing );

		if ( isset( $_POST['dmc_md_email'] ) ) :
			$dmc_md_email = sanitize_email( $_POST['dmc_md_email'] );
			wp_update_user(
				array(
					'ID'         => $user_id,
					'user_email' => $dmc_md_email,
				)
			);
		endif;

		if ( $form_errors->get_error_codes() ) :

			foreach ( ( $codes = $form_errors->get_error_codes() ) as $code ) :
				$message = $form_errors->get_error_message( $code );
				// $data = $form_errors->get_error_data( $code );
				$transient_name = __FUNCTION__ . '_' . $code;
				set_transient( $transient_name, $message, 20 );
			endforeach;

		else :
			$transient_name = __FUNCTION__ . '_' . success;
			set_transient( $transient_name, 'Your changes have been made.', 20 );
		endif;

		$redirect_url = get_site_url() . '/member/' . esc_attr( $user_id );
		wp_safe_redirect( $redirect_url );
		exit;

	endif;

}
add_action( 'admin_post_dmc_edit_member', 'dmc_edit_member_callback' );
