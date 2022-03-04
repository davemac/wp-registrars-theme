<h4>
	Send an announcement to all residents @ <?php echo esc_js( $dmc_building_name ); ?>:
</h4>

<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" name="dmc-post-member" class="gform_wrapper global-member dmc-post-member" method="POST" data-confirm="This will send an announcement to all residents - are you sure?">

	<?php wp_nonce_field( 'dmc_post_member', 'dmc_post_member_nonce' ); ?>

	<input type="hidden" name="action" value="dmc_post_member">
	<input type="hidden" name="building_id" value="<?php echo esc_attr( $dmc_building_id ); ?>">
	<input type="hidden" name="building_name" value="<?php echo esc_attr( $dmc_building_name ); ?>">

	<div class="dmc-max-one godown">
		<label for="dmc_md_announcement">
			Announcement content:
		</label>
		<textarea name="dmc_md_announcement_content" id="dmc_md_announcement_content" cols="30" rows="5">Hi everyone, </textarea>
	</div>

	<div class="dmc-max-one">
		<label for="dmc_md_own">
			Send to <strong>all residents</strong> via:
		</label>
		<div class="radio-holder">
			<label>
				<input type="radio" name="dmc_md_announcement_type[]" id="dmc_md_announcement_type" value="onsite" checked>
					On site announcement
			</label>
			<label>
				<input type="radio" name="dmc_md_announcement_type[]" id="dmc_md_announcement_type" value="email">
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

	<input class="button gform_button" type="submit" value="Send Announcement">

</form>
