<?php
function dmc_user_directory_card(
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
	) {

	if ( $dmc_md_arc_role ) :
		$dmc_md_arc_role = $dmc_md_arc_role . ': ';
	endif;

	$dmc_author_linkedin_check = get_field( 'dmc_linkedin', 'user_' . $dmc_user_id );
	?>

	<header>
		<h1 class="entry-title">
			<?php echo esc_html( $dmc_md_arc_role ); ?>
			<?php echo esc_html( $dmc_md_display_name ); ?>
			<span>
				<?php echo esc_html( $dmc_md_position ); ?> @
				<?php echo esc_html( $dmc_md_company ); ?>
			</span>
		</h1>
		<div class="member-meta">
			<h2>
				<strong>Specialisation:</strong> <?php echo esc_html( $dmc_md_specialisation ); ?>
			</h2>
			<h2>
				<strong>Location:</strong> <?php echo esc_html( $dmc_md_city ); ?>, <?php echo esc_html( $dmc_md_state ); ?> <?php echo esc_html( $dmc_md_country ); ?>
			</h2>
		</div>
	</header>

	<div class="entry-content">

		<div class="author-info">
			<div class="media">
				<div class="media-figure">

					<?php
					if ( $dmc_md_image ) :
						echo $dmc_md_image;
					elseif ( ( $dmc_md_avatar_url ) ) :
						?>
						<img src="<?php echo esc_url( $dmc_md_avatar_url ); ?>" />
						<?php
					endif;
					?>

					<div class="social__wrap">
						<?php
						if ( $dmc_md_twitter ) :
							?>
							<div class="social__item">
								<a class="social__link--twitter" href="http://twitter.com/<?php echo esc_html( $dmc_md_twitter ); ?>"  target="_blank" rel="noopener" title="View <?php echo esc_html( $dmc_md_firstname ); ?>'s Twitter feed">
									<span class="social__link--text">
										twitter
									</span>
								</a>
							</div>
							<?php
						endif;

						if ( $dmc_author_linkedin_check ) :
							?>
							<div class="social__item">
								<a class="social__link--linkedin" href="<?php echo esc_url( $dmc_author_linkedin_check ); ?>"  target="_blank" rel="noopener" title="View <?php echo esc_html( $dmc_md_firstname ); ?>'s LinkedIn page">
									<span class="social__link--text">
										linkedin
									</span>
								</a>
							</div>
							<?php
						endif;
						?>
					</div>

				</div>

				<div class="media-body">

					<p>
						<?php echo esc_html( $dmc_md_bio ); ?>
					</p>

					<div class="additional">
						<?php
						if ( $dmc_md_email ) :
							?>
							<a href="mailto:<?php echo antispambot( $dmc_md_email ); ?>">
								<?php echo antispambot( $dmc_md_email ); ?>
							</a>
							<?php
						endif;

						if ( $dmc_md_phone ) :
							?>
							<a href="tel:<?php echo antispambot( $dmc_md_phone ); ?>">
								Ph: <?php echo antispambot( $dmc_md_phone ); ?>
							</a>
							<?php
						endif;

						if ( $dmc_md_url ) :
							?>
							<a href="mailto:<?php echo esc_url( $dmc_md_url ); ?>">
								<?php echo esc_html( $dmc_md_firstname ); ?>'s website
							</a>
							<?php
						endif;
						?>
					</div>

				</div>
			</div>
		</div>

	</div>

	<?php
}


function dmc_user_list() {
	?>

		<div id="tablelist">
			<h3>
				Filter directory list:
			</h3>

			<input class="search" id="listsearch" placeholder="Type a name, location, position or specialisation to filter" />

			<table class="list-members">
				<thead>
					<tr>
						<th class="intro" colspan="4">
							Sort list by name, location, position or specialisation. Click on a name to view more information.
						</th>
					</tr>
					<tr>
						<th>
							<button class="sort" data-sort="reg_name">
								Name
							</button>
						</th>
						<th class="wider">
							<button class="sort" data-sort="reg_location">
								Location
							</button>
						</th>
						<th>
							<button class="sort" data-sort="reg_position">
								Position
							</button>
						</th>
						<th class="widest">
							<button class="sort" data-sort="reg_specialisation">
								Specialisation
							</button>
						</th>
					</tr>
				</thead>

				<tbody class="list intro">

					<?php
					foreach ( dmc_get_all_active_wc_subscribers() as $user_result ) :

						$user_id = $user_result->ID;

						$dmc_md_display_name = $user_result->display_name;

						// get user meta
						$dmc_user_meta = array_map(
							function( $a ) {
								return $a[0];
							},
							get_user_meta( $user_id )
						);

						if ( isset( $dmc_user_meta['dmc_allow_member_directory'] ) ) {
							$reg_allow_listing = $dmc_user_meta['dmc_allow_member_directory'];
						}

						if ( $reg_allow_listing === null || $reg_allow_listing ) :

							if ( isset( $dmc_user_meta['dmc_specialisation'] ) ) {
								$dmc_md_specialisation = $dmc_user_meta['dmc_specialisation'];
							}

							if ( isset( $dmc_user_meta['billing_state'] ) ) {
								$dmc_md_state = $dmc_user_meta['billing_state'];
							}

							if ( isset( $dmc_user_meta['billing_city'] ) ) {
								$dmc_md_city = $dmc_user_meta['billing_city'];
							}

							if ( isset( $dmc_user_meta['billing_country'] ) ) {
								$dmc_md_country = $dmc_user_meta['billing_country'];
							}

							if ( isset( $dmc_user_meta['dmc_position'] ) ) {
								$dmc_md_position = $dmc_user_meta['dmc_position'];
							}
							?>
							<tr>
								<td class="reg_name">
									<a href="/member/<?php echo esc_attr( $user_id ); ?>">
										<?php echo esc_html( $dmc_md_display_name ); ?>
									</a>
								</td>
								<td class="reg_location">
									<?php echo esc_html( $dmc_md_city ); ?>, <?php echo esc_html( $dmc_md_state ); ?> <?php echo esc_html( $dmc_md_country ); ?>
								</td>
								<td class="reg_position">
									<?php echo esc_html( $dmc_md_position ); ?>
								</td>
								<td class="reg_specialisation">
									<?php echo esc_html( $dmc_md_specialisation ); ?>
								</td>
							</tr>

							<?php
						endif;

					endforeach;
					?>

				</tbody>
			</table>

		</div>

	<?php
}


function dmc_user_edit(
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
	) {

	$user_id = $dmc_user_id;

	require_once get_template_directory() . '/lib/member-directory/forms/form-member-edit.php';

	// require_once get_template_directory() . '/lib/member-directory/forms/form-member-moveout.php';

}
