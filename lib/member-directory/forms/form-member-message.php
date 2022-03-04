<h4>
	Message resident:
</h4>

<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" name="dmc-message-member" class="gform_wrapper global-member dmc-message-member" method="POST" data-confirm="This will send a message to the resident - are you sure?">

	<?php
	wp_nonce_field( 'dmc_message_member', 'dmc_message_member_nonce' );

	$dmc_md_building_name = '';
	if ( isset( $dmc_user_meta['user_registration_user_bldg_name'] ) ) {
		$dmc_md_building_name = $dmc_user_meta['user_registration_user_bldg_name'];
	}
	$dmc_md_mobile_stripped = preg_replace( '/[^a-zA-Z0-9]+/', '', $dmc_md_mobile );
	?>

	<input type="hidden" name="action" value="dmc_message_member">
	<input type="hidden" name="user_id" value="<?php echo esc_attr( $user_id ); ?>">
	<input type="hidden" name="building_id" value="<?php echo esc_attr( $dmc_building_id ); ?>">
	<input type="hidden" name="building_name" value="<?php echo esc_attr( $dmc_md_building_name ); ?>">
	<input type="hidden" name="user_email" value="<?php echo esc_attr( $dmc_md_email ); ?>">
	<input type="hidden" name="user_first_name" value="<?php echo esc_attr( $dmc_md_firstname ); ?>">
	<input type="hidden" name="user_last_name" value="<?php echo esc_attr( $dmc_md_lastname ); ?>">
	<input type="hidden" name="dmc_md_mobile_stripped" value="<?php echo esc_attr( $dmc_md_mobile_stripped ); ?>">

	<div class="dmc-max-one godown">
		<label for="dmc_md_announcement">
			Send a message to <?php echo get_the_author_meta( 'first_name', $user_id ); ?>:
		</label>
		<textarea name="dmc_md_announcement_content" id="dmc_md_announcement_content" cols="30" rows="5">Hi <?php echo esc_textarea( $dmc_md_firstname ); ?>, </textarea>
	</div>

	<div class="dmc-max-one">
		<label for="dmc_md_own">
			Message format:
		</label>
		<div class="radio-holder">
			<label>
				<input type="radio" name="dmc_md_announcement_type[]" id="dmc_md_announcement_type" value="email" checked>
					Email
			</label>
			<?php
			if ( 1 == get_field( 'dmc_enable_sms', $dmc_building_id ) ) :
				?>
				<label>
					<input type="radio" name="dmc_md_announcement_type[]" id="dmc_md_announcement_type" value="sms">
						SMS
				</label>
				<?php
			endif;
			?>
		</div>
	</div>

	<input class="button gform_button" type="submit" value="Send Message">

</form>
