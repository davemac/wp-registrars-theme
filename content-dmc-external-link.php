<article id="post-<?php the_ID(); ?>" <?php post_class( 'index-card' ); ?>>
	<header>
		<h2 class="entry-title">
			<?php the_title(); ?>
		</h2>
	</header>

	<div class="entry-content">

		<?php the_content(); ?>
		<p>
			<a href="<?php the_field( 'dmc_website_url' ); ?>"  target="_blank" rel="noopener" class="more">
				<?php the_field( 'dmc_website_title' ); ?>
			</a>
		</p>

	</div>
</article>
