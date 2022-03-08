<?php
get_header();
?>

	<div <?php post_class(); ?> >

		<section class="page-hero" <?php dmc_display_featured_img_bg(); ?>>
			<div class="sub-title">
				<h1 class="page-title">
					hello
					<?php if ( is_category() ) : ?>
						articles categorised '<?php single_cat_title(); ?>'
z				<?php elseif ( is_post_type_archive( 'post' ) || is_home() ) : ?>

					News
				<?php elseif ( is_author() ) : ?>

						Articles by <?php the_author(); ?>

				<?php elseif ( is_tag() ) : ?>

						Archive for tag '<?php single_tag_title(); ?>'


				<?php elseif ( is_post_type_archive() ) : ?>
					<?php $dmc_post_type = get_queried_object(); ?>

						<?php echo esc_html( $dmc_post_type->labels->singular_name ); ?>


				<?php elseif ( is_archive() ) : ?>

						News archive for <?php single_month_title( ' ' ); ?>

				<?php endif; ?>
				</h1>
			</div>
			<!-- <div class="blend-overlay"></div> -->
		</section>



		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				get_template_part( 'content' );

			endwhile;

		else :
				get_template_part( 'content', 'none' );
		endif;

		dmc_display_pagination();
		?>

	</div>

<?php
get_footer();
