<h4>
	Edit Profile:
</h4>

<p>
	Note: The Members Directory is only visible to logged in members and is not publicly accessible.
</p>

<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" name="dmc-edit-member" class="gform_wrapper global-member" method="POST" enctype="multipart/form-data">

	<?php wp_nonce_field( 'dmc_edit_member', 'dmc_edit_member_nonce' ); ?>

	<input type="hidden" name="action" value="dmc_edit_member">
	<input type="hidden" name="user_id" value="<?php echo esc_attr( $dmc_user_id ); ?>">

	<?php
	if ( isset( $dmc_md_allow_listing ) ) {
		$checked_list_yes = '';
		$checked_list_no  = '';
		if ( '1' === $dmc_md_allow_listing ) :
			$checked_list_yes = 'checked';
		else :
			$checked_list_no = 'checked';
		endif;
	}
	?>

	<div class="dmc-max-two">
		<label for="dmc_md_own">
			Show my information in the Members Directory?
		</label>
		<div class="radio-holder keep-height">
			<label>
				<input type="radio" name="dmc_md_allow_listing" id="dmc_md_allow_listing" value="1" <?php echo esc_attr( $checked_list_yes ); ?>>
					Yes, show my info
			</label>
			<label>
				<input type="radio" name="dmc_md_allow_listing" id="dmc_md_allow_listing" value="" <?php echo esc_attr( $checked_list_no ); ?>>
					No, don't show my info
			</label>
		</div>
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_image">
			Profile image:
		</label>
		<div class="upload-holder">
			<input type="file" id="dmc_md_image" name="dmc_md_image" value="" multiple="false" />
			<?php echo $dmc_md_image; ?>
		</div>
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_firstname">
			First Name:
		</label>
		<input type="text" id="dmc_md_firstname" name="dmc_md_firstname" value="<?php echo esc_attr( $dmc_md_firstname ); ?>" />
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_lastname">
			Last Name:
		</label>
		<input type="text" id="dmc_md_lastname" name="dmc_md_lastname" value="<?php echo esc_attr( $dmc_md_lastname ); ?>" />
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_display_name">
			Display Name as:
		</label>
		<input type="text" id="dmc_md_display_name" name="dmc_md_display_name" value="<?php echo esc_attr( $dmc_md_display_name ); ?>" />
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_position">
			Position:
		</label>
		<input type="text" id="dmc_md_position" name="dmc_md_position" value="<?php echo esc_attr( $dmc_md_position ); ?>" />
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_company">
			Company:
		</label>
		<input type="text" id="dmc_md_company" name="dmc_md_company" value="<?php echo esc_attr( $dmc_md_company ); ?>" />
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_specialisation">
			Specialisation:
		</label>
		<input type="text" id="dmc_md_specialisation" name="dmc_md_specialisation" value="<?php echo esc_attr( $dmc_md_specialisation ); ?>" />
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_url">
			Website:
		</label>
		<input type="text" id="dmc_md_url" name="dmc_md_url" value="<?php echo esc_attr( $dmc_md_url ); ?>" />
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_twitter">
			Twitter:
		</label>
		<input type="text" id="dmc_md_twitter" name="dmc_md_twitter" value="<?php echo esc_attr( $dmc_md_twitter ); ?>" />
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_city">
			City:
		</label>
		<input type="text" id="dmc_md_city" name="dmc_md_city" value="<?php echo esc_attr( $dmc_md_city ); ?>" />
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_state">
			State:
		</label>
		<input type="text" id="dmc_md_state" name="dmc_md_state" value="<?php echo esc_attr( $dmc_md_state ); ?>" />
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_country">
			Country:
		</label>
		<input type="text" id="dmc_md_country" name="dmc_md_country" value="<?php echo esc_attr( $dmc_md_country ); ?>" />
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_phone">
			Phone:
		</label>
		<input type="text" id="dmc_md_phone" name="dmc_md_phone" value="<?php echo esc_attr( $dmc_md_phone ); ?>" />
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_email">
			Email:
		</label>
		<input type="text" id="dmc_md_email" name="dmc_md_email" value="<?php echo esc_attr( $dmc_md_email ); ?>" />
	</div>

	<div class="dmc-max-two">
		<label for="dmc_md_bio">
			Bio:
		</label>
		<textarea id="dmc_md_bio" name="dmc_md_bio" rows="15"><?php echo esc_attr( $dmc_md_bio ); ?></textarea>
	</div>

	<input class="button gform_button" type="submit" value="Update Profile">

</form>
