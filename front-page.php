<?php
get_header();
?>

<div class="medium-12 columns" id="content" role="main">

	<section class="content">
		<div class="row">
			<div class="medium-8 columns intro">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</section>

</div>

<?php
get_footer();
