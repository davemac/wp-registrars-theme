<?php

// Flickity/ACF homepage image slider
function dmc_hero_slider() {

	if ( have_rows( 'dmc_hero_sliders' ) ) : ?>
		<?php
		while ( have_rows( 'dmc_hero_sliders' ) ) :
			the_row();
			?>

			<div class="carousel-cell">
				<?php
				if ( get_sub_field( 'dmc_slide_image_links_to' ) ) :
					?>
					<a href="<?php the_sub_field( 'dmc_slide_image_links_to' ); ?>">
					<?php
				endif;
				?>

				<div class="hero" style="background-image: url('<?php the_sub_field( 'dmc_slide_image' ); ?>')">

					<div class="slider-meta">
						<h1>
							<?php the_sub_field( 'slide_title' ); ?>
						</h1>
						<?php
						if ( get_sub_field( 'slide_content' ) ) :
							?>
							<p>
								<?php the_sub_field( 'slide_content' ); ?>
							</p>
							<?php
						endif;
						?>
					</div>

				</div>

				<?php
				if ( get_sub_field( 'dmc_slide_image_links_to' ) ) :
					?>
					</a>
					<?php
				endif
				?>
			</div>

			<?php
		endwhile;
	endif;

}


// Flickity latest posts slider
function dmc_latest_posts_slider() {

	$latest_news = new WP_Query(
		array(
			'post_type'      => 'post',
			'posts_per_page' => 4,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		)
	);
	if ( $latest_news ) :
		?>

		<h1 class="section-heading">
			Insights
		</h1>

		<div class="posts-slider">
			<?php
			while ( $latest_news->have_posts() ) :
				$latest_news->the_post();
				?>

				<div class="carousel-cell dmc-post">
					<?php get_template_part( 'content', 'card-slider' ); ?>
				</div>

				<?php
			endwhile;
			?>
		</div>
		<?php
	endif;
	wp_reset_postdata();

}
