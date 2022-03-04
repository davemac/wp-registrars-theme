</div>
	</div>
</div>

	<aside class="right-off-canvas-menu">
	<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'depth'          => 2,
				'items_wrap'     => '<ul class="off-canvas-list">%3$s</ul>',
				'walker'         => new dmcstarter_walker(
					array(
						'in_top_bar' => true,
						'item_type'  => 'li',
						'menu_type'  => 'main-menu',
					)
				),
			)
		);
		?>
	</aside>

	<a class="exit-off-canvas"></a>

	</div>

<footer class="footer" role="contentinfo">

	<section class="insta">
		<h4 class="section-heading">
			<?php esc_html_e( 'Follow us on Instagram', 'dmcstarter' ); ?>
		</h4>

		<?php echo do_shortcode( '[instagram-feed]' ); ?>
	</section>

	<div class="flex-row footer-links">
		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'Footer widgets' ) ) : ?>
		<?php endif; ?>
	</div>

</footer>

<div class="credits">
	<div class="holder">
		<p>
			&copy; Copyright <?php bloginfo( 'name' ); ?>
			<?php echo intval( date( 'Y' ) ); ?>
		</p>
		<p>
			<a href="https://dmcweb.com.au">WordPress website development</a> by DMC Web.
		</p>
		<p>
			<a href="<?php echo esc_url( get_privacy_policy_url() ); ?>">
				Privacy policy
			</a>
		</p>
	</div>
</div>

</div>

<?php
wp_footer();
?>

<script>
	( function( $ ) {
		$( document ).foundation();
	})( jQuery );
</script>

</body>
</html>
