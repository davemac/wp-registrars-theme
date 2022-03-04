<article id="post-<?php the_ID(); ?>" <?php post_class( 'index-card' ); ?>>
	<header>
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<?php dmcstarter_entry_meta(); ?>
	</header>

	<div class="entry-content">
		<figure>
			<a href="<?php the_permalink(); ?>">
				<?php
				the_post_thumbnail(
					'thumb',
					array(
						'class' => 'alignright',
					)
				);
				?>
			</a>
		</figure>

		<?php the_excerpt(); ?>

		<p>
			<a href="<?php the_permalink(); ?>" class="more">
				Read more
			</a>
		</p>
	</div>
</article>
