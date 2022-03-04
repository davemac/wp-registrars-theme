<?php
function dmc_arc_council_list() {
	$args = array(
		'role__in' => array( 'customer', 'contributor', 'editor', 'administrator' ),
		'order'    => 'ASC',
		'orderby'  => 'display_name',
		'fields'   => array( 'ID', 'display_name' ),
	);

	$user_query   = new WP_User_Query( $args );
	$user_results = $user_query->results;

	if ( $user_results ) :
		foreach ( $user_results as $user_result ) :

			$dmc_user_id = $user_result->ID;

			// get user meta
			$dmc_user_meta = array_map(
				function( $a ) {
					return $a[0];
				},
				get_user_meta( $dmc_user_id )
			);

			if ( isset( $dmc_user_meta['dmc_arc_council_member'] ) && $dmc_user_meta['dmc_arc_council_member'] ) :

				$dmc_md_display_name = get_the_author_meta( 'display_name', $dmc_user_id );
				$dmc_md_firstname    = get_the_author_meta( 'first_name', $dmc_user_id );
				$dmc_md_lastname     = get_the_author_meta( 'last_name', $dmc_user_id );
				$dmc_md_email        = get_the_author_meta( 'user_email', $dmc_user_id );
				$dmc_md_bio          = get_the_author_meta( 'description', $dmc_user_id );
				$dmc_md_url          = get_the_author_meta( 'user_url', $dmc_user_id );

				$dmc_md_position       = $dmc_user_meta['dmc_position'];
				$dmc_md_company        = $dmc_user_meta['billing_company'];
				$dmc_md_specialisation = $dmc_user_meta['dmc_specialisation'];
				$dmc_md_twitter        = $dmc_user_meta['twitter_handle'];
				$dmc_md_city           = $dmc_user_meta['billing_city'];
				$dmc_md_state          = $dmc_user_meta['billing_state'];
				$dmc_md_country        = $dmc_user_meta['billing_country'];
				$dmc_md_phone          = $dmc_user_meta['billing_phone'];
				$dmc_md_allow_listing  = $dmc_user_meta['dmc_allow_member_directory'];

				$dmc_md_image_id   = $dmc_user_meta['dmc_author_photo'];
				$dmc_md_image      = wp_get_attachment_image( $dmc_md_image_id, 'thumbnail' );
				$dmc_md_avatar_url = get_avatar_url( $dmc_user_id, array( 'size' => 'thumbnail' ) );

				$user_acf_prefix  = 'user_';
				$user_id_prefixed = $user_acf_prefix . $dmc_user_id;
				$dmc_md_arc_role  = get_field( 'dmc_arc_council_role', $user_id_prefixed );

				$council_members_array[] = $dmc_md_arc_role;
				// $order = array( 4, 2, 11, 5, 6, 0, 1, 3, 7, 8, 9, 10, 12, 13 );

				// uksort(
				// 	$council_members_array,
				// 	function( $key1, $key2 ) use ( $order ) {
				// 		return ( array_search( $key1, $order ) > array_search( $key2, $order, true ) );
				// 	}
				// );

				// echo '<pre>';
				// print_r( $council_members_array );
				// echo '</pre>';

				// foreach ( $council_members_array as $council_member ) :
				?>

					<div class="member-group">

						<?php
						dmc_user_directory_card(
							$dmc_user_id,
							$dmc_md_firstname,
							$dmc_md_lastname,
							$dmc_md_display_name,
							$dmc_md_position,
							$dmc_md_company,
							$dmc_md_specialisation,
							$dmc_md_twitter,
							$dmc_md_city,
							$dmc_md_state,
							$dmc_md_country,
							$dmc_md_phone,
							$dmc_md_email,
							$dmc_md_bio,
							$dmc_md_url,
							$dmc_md_image,
							$dmc_md_avatar_url,
							$dmc_md_arc_role,
							$dmc_md_allow_listing
						);
						?>

					</div>

				<?php
				// endforeach;

			endif;
		endforeach;
	else :
		?>

		<div class="entry-content">
			<div class="highlight">
				<p>
					The member does not exist.
				</p>
			</div>
		</div>

		<?php
	endif;
}
