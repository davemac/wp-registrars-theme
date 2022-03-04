<?php get_header(); ?>

	<div class="medium-9 columns" id="content" role="main">

	<header>
		<h2 class="archive-title">

			<?php if ( is_category() ) : ?>
				<span>
					articles categorised '<?php single_cat_title(); ?>'
				</span>
			<?php elseif ( is_post_type_archive( 'post' ) || is_home() ) : ?>

				<span>News</span>
			<?php elseif ( is_author() ) : ?>
				<span>
					Articles by <?php the_author(); ?>
				</span>

			<?php elseif ( is_tag() ) : ?>
				<span>
					Archive for tag '<?php single_tag_title(); ?>'
				</span>

			<?php elseif ( is_post_type_archive() ) : ?>
				<?php $dmc_post_type = get_queried_object(); ?>
				<span>
					<?php echo esc_html( $dmc_post_type->labels->singular_name ); ?>
				</span>

			<?php elseif ( is_archive() ) : ?>
				<span>
					News archive for <?php single_month_title( ' ' ); ?>
				</span>
			<?php endif; ?>
		</h2>
	</header>

	<?php if ( have_posts() ) : ?>

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php
			if ( is_post_type_archive( array( 'dmc-cons-resources', 'dmc-legislation', 'dmc-reg-networks' ) ) ) {

				get_template_part( 'content', 'dmc-external-link' );

			} elseif ( is_archive() || is_home() || is_month() ) {

				get_template_part( 'content', get_post_format() );

			} else {
				get_template_part( 'content', 'none' );
			};
			?>

		<?php endwhile; ?>

	<?php endif; ?>

		<?php dmc_display_pagination(); ?>

		</div>

	<?php get_sidebar(); ?>

<?php
get_footer();
