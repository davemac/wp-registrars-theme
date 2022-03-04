<?php
get_header()
?>

<div class="flex-row" id="content">

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title">
					<?php the_title(); ?>
				</h1>

				<?php dmc_display_image_with_caption(); ?>

				<div class="meta-holder">
					<?php dmcstarter_entry_meta(); ?>
					<?php dmc_display_share(); ?>
				</div>

			</header>
			<div class="entry-content">
				<?php
				if ( is_user_logged_in() ) :
					the_content();
				else :
					the_excerpt();
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
			</div>

			<?php
			if ( is_singular( array( 'post', 'dmc-conf-papers', 'dmc-jour-articles'  ) ) ) :
				dmc_user_profile();
			endif;
			?>

		</article>

		<?php
	endwhile;

	get_sidebar();
	?>

</div>

<?php
get_footer();
