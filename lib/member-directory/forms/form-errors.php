<?php
function dmc_edit_member_error_handler() {

	$message_type = 'message_default';

	if ( get_transient( 'dmc_edit_member_callback_first_name' ) ) :
		$dmc_form_messages[] = get_transient( 'dmc_edit_member_callback_first_name' );
		$message_type = 'message_error';
	endif;

	if ( get_transient( 'dmc_edit_member_callback_last_name' ) ) :
		$dmc_form_messages[] = get_transient( 'dmc_edit_member_callback_last_name' );
		$message_type = 'message_error';
	endif;

	if ( get_transient( 'dmc_edit_member_callback_success' ) ) :
		$dmc_form_messages[] = get_transient( 'dmc_edit_member_callback_success' );
		$message_type = 'message_success';
		delete_transient( 'dmc_edit_member_callback_success' );
	endif;

	// if ( isset ( $dmc_form_messages[2] ) && null !== $dmc_form_messages[2] ) :
	// 	$message_type = 'message_success';
	// endif;

	if ( ! empty( $dmc_form_messages ) ) :
		?>
		<div class="dmc-form-message__<?php echo esc_attr( $message_type ); ?> text-center">
			<?php
			foreach ( $dmc_form_messages as $dmc_form_message ) :
				echo $dmc_form_message . ' ';
			endforeach;

			delete_transient( 'dmc_edit_member_callback_first_name' );
			delete_transient( 'dmc_edit_member_callback_last_name' );

			?>
		</div>
		<?php
	endif;

}

function dmc_message_member_error_handler() {

	$message_type = 'message_default';

	if ( get_transient( 'dmc_message_member_callback_dmc_md_announcement_content' ) ) :
		$dmc_form_messages[] = get_transient( 'dmc_message_member_callback_dmc_md_announcement_content' );
		$message_type = 'message_error';
	endif;

	if ( get_transient( 'dmc_message_member_callback_success' ) ) :
		$dmc_form_messages[] = get_transient( 'dmc_message_member_callback_success' );
		$message_type = 'message_success';
		delete_transient( 'dmc_message_member_callback_success' );
	endif;

	// if ( isset ( $dmc_form_messages[2] ) && null !== $dmc_form_messages[2] ) :
	// 	$message_type = 'message_success';
	// endif;

	if ( ! empty( $dmc_form_messages ) ) :
		?>
		<div class="dmc-form-message__<?php echo esc_attr( $message_type ); ?> text-center">
			<?php
			foreach ( $dmc_form_messages as $dmc_form_message ) :
				echo $dmc_form_message . ' ';
			endforeach;

			delete_transient( 'dmc_message_member_callback_dmc_md_announcement_content' );

			?>
		</div>
		<?php
	endif;

}

function dmc_post_member_error_handler() {

	$message_type = 'message_default';

	if ( get_transient( 'dmc_post_member_callback_dmc_md_announcement_content' ) ) :
		$dmc_form_messages[] = get_transient( 'dmc_post_member_callback_dmc_md_announcement_content' );
		$message_type = 'message_error';
	endif;

	if ( get_transient( 'dmc_post_member_callback_success' ) ) :
		$dmc_form_messages[] = get_transient( 'dmc_post_member_callback_success' );
		$message_type = 'message_success';
		delete_transient( 'dmc_post_member_callback_success' );
	endif;

	// if ( isset ( $dmc_form_messages[2] ) && null !== $dmc_form_messages[2] ) :
	// 	$message_type = 'message_success';
	// endif;

	if ( ! empty( $dmc_form_messages ) ) :
		?>
		<div class="dmc-form-message__<?php echo esc_attr( $message_type ); ?> text-center">
			<?php
			foreach ( $dmc_form_messages as $dmc_form_message ) :
				echo $dmc_form_message . ' ';
			endforeach;

			delete_transient( 'dmc_post_member_callback_dmc_md_announcement_content' );

			?>
		</div>
		<?php
	endif;

}
