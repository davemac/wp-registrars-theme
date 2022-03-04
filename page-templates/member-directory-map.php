<?php
/*
Template Name: Member Directory Map
*/
get_header();
?>

<div class="medium-12 columns" id="content" role="main">

<?php
while ( have_posts() ) :
	the_post();
	?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<header>
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
		</header>

		<div class="entry-content">
			<?php
			if ( is_user_logged_in() ) :
				?>
				<div class="acf-map" data-zoom="16">

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

						if ( isset( $dmc_user_meta['billing_state'] ) ) {
							$dmc_md_state = $dmc_user_meta['billing_state'];
						}

						if ( isset( $dmc_user_meta['billing_city'] ) ) {
							$dmc_md_city = $dmc_user_meta['billing_city'];
						}

						if ( isset( $dmc_user_meta['billing_country'] ) ) {
							$dmc_md_country = $dmc_user_meta['billing_country'];
						}

						$return = dmc_gmaps_geocode( '', $dmc_md_city, $dmc_md_state, $dmc_md_country );

						// echo '<pre>';
						// echo $dmc_md_city . ' ' . $dmc_md_state . ' ' . $dmc_md_country;
						// echo '</pre>';
						$address = $dmc_md_city . ' ' . $dmc_md_state . ' ' . $dmc_md_country;
						?>

						<div class="marker" data-lat="<?php echo esc_attr( $return['latitude'] ); ?>" data-lng="<?php echo esc_attr( $return['longitude'] ); ?>">
							<h3>
								<?php echo esc_html( $dmc_md_display_name ); ?>
							</h3>
							<p>
								<em>
									<?php echo esc_html( $address ); ?>
								</em>
							</p>
						</div>

						<?php
					endforeach;
					?>

				</div>
				<?php
			else :
				?>
				<div class="highlight">
					<h4>
						Member access only
					</h4>
					<p>
						You need to be a logged in member to view the Member Directory.
					</p>
					<a href="/my-account/" class="button">
						Login Now
					</a>
				</div>
				<?php
			endif;
			?>
		</div>

	</article>

	<?php
endwhile;
?>

</div>

<?php
get_footer();
