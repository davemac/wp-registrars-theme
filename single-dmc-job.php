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

				<div class="meta-holder">
					<a href="<?php the_field( 'dmc_job_url' ); ?>" target="_blank" rel="noopener" class="button">
						View full job position and apply
					</a>
					<?php dmc_display_share(); ?>
				</div>

				<?php dmc_display_image_with_caption( 'medium' ); ?>

				<div class="article-meta">
				</div>
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>

			<a href="<?php the_field( 'dmc_job_url' ); ?>"  target="_blank" rel="noopener" class="button job-apply">
				View full job position and apply
			</a>

		</article>

		<?php
	endwhile;

	get_sidebar();
	?>

</div>

<?php
get_footer();
