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

			</header>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>

			<?php dmc_display_share(); ?>

			<p>
				<a href="<?php the_field( 'dmc_website_url' ); ?>"  target="_blank" rel="noopener" class="more">
					<?php the_field( 'dmc_website_title' ); ?>
				</a>
			</p>

		</article>

		<?php
	endwhile;

	get_sidebar();
	?>

</div>

<?php
get_footer();
