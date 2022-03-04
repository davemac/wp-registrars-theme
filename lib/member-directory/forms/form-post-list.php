<?php
$get_announcement_id = get_post_meta( $dmc_building_id, '_dmc_related_announcement', true );
if ( ( $get_announcement_id ) && get_post_status( $get_announcement_id ) === 'publish' ) :
	?>

	<div class="dmc-announcement-holder content-holder building-meta">

		<h5 class="announce-header">
			<?php
			if ( is_singular( 'dmc-building' ) ) :
				?>
				Announcements:
				<?php
			else :
				?>
				Current on-site announcement @ <?php echo esc_js( $dmc_building_name ); ?>:
				<?php
			endif;
			?>
		</h5>

		<div class="announce-list">
			<span>
				<?php echo get_the_date( '', $dmc_building_id ); ?>
			</span>
			<p>
				<?php echo esc_textarea( get_the_excerpt( $get_announcement_id ) ); ?>
			</p>

			<?php
			$dmc_user_check = dmc_get_wp_user_role();
			if ( in_array( $dmc_user_check, array( 'admin', 'building_manager' ), true ) ) :
				?>

				<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" name="dmc-delete-post" class="global-member  dmc-delete-post" method="POST" data-confirm="This will remove the current on-site announcement for this building  - are you sure?">
				<?php wp_nonce_field( 'dmc_delete_post', 'dmc_delete_post_nonce' ); ?>

					<input type="hidden" name="action" value="dmc_delete_post">
					<input type="hidden" name="building_id" value="<?php echo esc_attr( $dmc_building_id ); ?>">
					<input type="hidden" name="announcement_id" value="<?php echo esc_attr( $get_announcement_id ); ?>">

					<input class="button gform_button unstyle-button remove" type="submit" value="Remove">
				</form>

				<?php
			endif;
			?>

		</div>
	</div>

	<?php
endif;
