<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" name="dmc-moveout-member" class="dmc-moveout-member" method="POST" data-confirm="This will remove this resident from this building, but they will remain a member of Roost. They will receive an email notification. Are you sure?">
	<?php wp_nonce_field( 'dmc_moveout_member', 'dmc_moveout_member_nonce' ); ?>

	<input type="hidden" name="action" value="dmc_moveout_member">
	<input type="hidden" name="user_id" value="<?php echo esc_attr( $user_id ); ?>">
	<input type="hidden" name="building_id" value="<?php echo esc_attr( $dmc_building_id ); ?>">

	<input class="button warning gform_button" type="submit" value="Move out resident">
</form>
