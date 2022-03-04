<?php
/*
Template Name: Full Width
*/
get_header(); ?>

<div class="small-12 large-12 columns" id="content" role="main">

	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>

		</article>
	<?php endwhile; ?>

</div>

<?php get_footer(); ?>
