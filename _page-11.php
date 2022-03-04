<?php
// Resourcesa
get_header(); ?>

<div class="small-12 large-12 columns" id="content" role="main">

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
		</article>
	<?php endwhile; ?>

	<section class="masonry-loop">
	<ul class="medium-block-grid-2">

		<?php
		$list_recent = new WP_Query(
			array(
				'post_type'      => 'dmc-cons-resources',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'posts_per_page' => 3,
			)
		);
		if ( $list_recent->have_posts() ) :
			?>
			<li class="masonry-entry">
				<h2>
					<a href="/resources/conservation-resources/">Conservation Resources</a>
				</h2>
				<div class="card">
					<ul class="no-bullet">
						<?php
						while ( $list_recent->have_posts() ) :
							$list_recent->the_post();
							?>
							<li>
							  	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
							   	</a>
							</li>
							<?php
						endwhile;
						?>
					</ul>
				</div>
				<a href="/resources/conservation-resources/" class="more">View more &raquo;</a>
			</li>
			<?php
		endif;


		$list_recent = new WP_Query(
			array(
				'post_type'      => 'dmc-legislation',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'posts_per_page' => 3,
			)
		);
		if ( $list_recent->have_posts() ) :
			?>
			<li class="masonry-entry">
				<h2>
					<a href="/resources/standards-forms/">
						Legislation, Standards &amp; Forms
					</a>
				</h2>
				<div class="card">
					<ul class="no-bullet">
						<?php
						while ( $list_recent->have_posts() ) :
							$list_recent->the_post();
							?>
							<li>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a>
							</li>
							<?php
						endwhile;
						?>
					</ul>
				</div>
				<a href="/resources/standards-forms/" class="more">View more &raquo;</a>
			</li>
			<?php
		endif;


		$list_recent = new WP_Query(
			array(
				'post_type'      => 'dmc-reg-networks',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'posts_per_page' => 3,
			)
		);
		if ( $list_recent->have_posts() ) :
			?>
			<li class="masonry-entry">
				<h2>
					<a href="/resources/registrar-networks/">
						Registrar Networks
					</a>
				</h2>
				<div class="card">
					<ul class="no-bullet">
						<?php
						while ( $list_recent->have_posts() ) :
							$list_recent->the_post();
							?>
							<li>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a>
							</li>
							<?php
						endwhile;
						?>
					</ul>
				</div>
				<a href="/resources/registrar-networks/" class="more">View more &raquo;</a>
			</li>
			<?php
		endif;


		$list_recent = new WP_Query(
			array(
				'post_type'      => 'dmc-library',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'posts_per_page' => 3,
			)
		);
		if ( $list_recent->have_posts() ) :
			?>
			<li class="masonry-entry">
				<h2>
					<a href="/resources/library/">
						Library
					</a>
				</h2>
				<div class="card">
					<ul class="no-bullet">
						<?php
						while ( $list_recent->have_posts() ) :
							$list_recent->the_post();
							?>
							<li>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a>
							</li>
							<?php
						endwhile;
						?>
					</ul>
				</div>
				<a href="/resources/library/" class="more">View more &raquo;</a>
			</li>
			<?php
		endif;


		$list_recent = new WP_Query(
			array(
				'post_type'      => 'dmc-prof-dev',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'posts_per_page' => 3,
			)
		);
		if ( $list_recent->have_posts() ) :
			?>
			<li class="masonry-entry">
			<h2>
				<a href="/resources/professional-dev/">
					Professional Development
				</a>
			</h2>
				<div class="card">
					<ul class="no-bullet">
						<?php
						while ( $list_recent->have_posts() ) :
							$list_recent->the_post();
							?>
							<li>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a>
							</li>
							<?php
						endwhile;
						?>
					</ul>
				</div>
				<a href="/resources/professional-dev/" class="more">View more &raquo;</a>
			</li>
			<?php
		endif;
		?>

	</ul>
	</section>

</div>

<?php
get_footer();
