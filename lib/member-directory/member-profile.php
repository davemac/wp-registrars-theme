<?php
get_header()
?>

<div class="medium-12 columns" id="content" role="main">

	<article <?php post_class( 'member-card' ); ?> id="post-<?php the_ID(); ?>">

		<div class="tools-holder">
			<div class="crumb">
				Member Directory Profile:
			</div>

			<a href="/member-directory/" class="back-button">
				Back to Member Directory
			</a>
		</div>

		<?php
		if ( is_user_logged_in() ) :

			$args = array(
				'role__in' => array( 'customer', 'contributor', 'editor', 'administrator' ),
				'include'  => array( $dmc_user_id ),
				'order'    => 'ASC',
				'orderby'  => 'display_name',
				'fields'   => array( 'ID', 'display_name' ),
			);

			$user_query   = new WP_User_Query( $args );
			$user_results = $user_query->results;

			if ( $user_results ) :

				// get user meta
				$dmc_user_meta = array_map(
					function( $a ) {
						return $a[0];
					},
					get_user_meta( $dmc_user_id )
				);

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
				$dmc_md_arc_role  = get_field( 'dmc_arc_council_role', $dmc_user_id );

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

				$current_user_id = get_current_user_id();
				if ( $current_user_id == $dmc_user_id ) :

					dmc_user_edit(
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
						$dmc_md_allow_listing
					);

				endif;

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

		else :
			?>
			<div class="highlight">
				<h4>
					Member access only
				</h4>
				<p>
					You need to be a logged in member to view this content.
				</p>
				<a href="/my-account/" class="button">
					Login Now
				</a>
			</div>
			<?php
		endif;
		?>
	</article>
</div>

<?php
get_footer();
