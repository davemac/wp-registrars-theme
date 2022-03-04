<?php
function dmc_moveout_member_callback() {

	if (
		! isset( $_POST['dmc_moveout_member_nonce'] )
		|| ! wp_verify_nonce( $_POST['dmc_moveout_member_nonce'], 'dmc_moveout_member' )
	) :
		print 'Sorry, your nonce did not verify.';
		exit;
	else :

		$user_id         = sanitize_text_field( $_POST['user_id'] );
		$dmc_building_id = sanitize_text_field( $_POST['building_id'] );

		wp_update_user(
			array(
				'ID'       => $user_id,
				'user_url' => '',
			)
		);

		update_user_meta( $user_id, 'user_registration_bldg_user_apt_number', '' );
		update_user_meta( $user_id, 'user_registration_bldg_user_apt_number', '' );
		update_user_meta( $user_id, 'user_registration_user_bldg_name', '' );

		$redirect_url = get_site_url() . '/building-manager-dashboard/?building=' . esc_attr( $dmc_building_id );
		wp_safe_redirect( $redirect_url );
		exit;

	endif;

}
add_action( 'admin_post_dmc_moveout_member', 'dmc_moveout_member_callback' );
