<?php
get_header();

while ( have_posts() ) :
	the_post();
	?>

	<div <?php post_class(); ?> >

		<section class="page-hero" <?php dmc_display_featured_img_bg(); ?>>
			<div class="sub-title ">
				<h1 class="page-title">
					<?php the_title(); ?>
				</h1>
			</div>
			<!-- <div class="blend-overlay"></div> -->
		</section>

		<div class="flex-row" id="content">

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="main">

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

			</article>

			<?php
			// get_sidebar();
			?>

		</div>

	</div>

	<?php
endwhile;

get_footer();
