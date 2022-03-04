<?php get_header(); ?>

	<div class="small-12 large-8 columns" id="content" role="main">

		<h2><?php _e( 'Search Results for', 'dmcstarter' ); ?> "<?php echo get_search_query(); ?>"</h2>

	<?php if ( have_posts() ) : ?>

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; ?>

	<?php dmc_display_pagination(); ?>

	</div>
	<?php get_sidebar(); ?>

<?php get_footer(); ?>
