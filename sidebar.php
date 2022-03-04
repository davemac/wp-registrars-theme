<aside id="sidebar" class="small-12 medium-<?php if ( is_singular( 'jetpack-portfolio' ) ) :
	?>3
	<?php
else :
	?>
3<?php endif; ?> columns">

	<?php if ( is_front_page() ) : ?>

			<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Homepage sidebar' ) ) : ?>
		<?php endif; ?>

	<?php
	// elseif ( tribe_is_event() || tribe_is_event() && is_single() ) :

	// 	if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Events sidebar' ) ) :
	// 	endif;

	elseif ( is_post_type_archive( 'jetpack-portfolio' ) ) : ?>

		<!-- placeholder -->

	<?php elseif ( is_singular( 'jetpack-portfolio' ) ) : ?>

		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Single Projects sidebar' ) ) : ?>
		<?php endif; ?>

	<?php elseif ( is_home() || is_single() || is_archive() || is_search() ) : ?>

			<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'News sidebar' ) ) : ?>
		<?php endif; ?>

	<?php elseif ( is_page( 7 ) ) : ?>

		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'About sidebar' ) ) : ?>
		<?php endif; ?>

	<?php elseif ( is_page( 9 ) ) : ?>

		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Contact sidebar' ) ) : ?>
		<?php endif; ?>

		<?php endif; ?>

	</aside>
