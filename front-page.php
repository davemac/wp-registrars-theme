<?php
get_header();
?>

<div class="medium-12 columns" id="content" role="main">

	<div id="homepage-slider" class="property-slider-combined">
		<?php dmc_hero_slider(); ?>
	</div>

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

	<?php
	if ( have_rows( 'dmc_calls_to_action' ) ) :
		?>
		<section class="content dmc-calls">
			<ul class="medium-block-grid-3">
			<?php
			while ( have_rows( 'dmc_calls_to_action' ) ) :
				the_row();
				?>

				<li>
					<article class="content-block">
						<?php
						if ( get_sub_field( 'dmc_button' ) ) :
							$dmc_button        = get_sub_field( 'dmc_button' );
							$dmc_button_label  = $dmc_button['text'];
							$dmc_button_url    = $dmc_button['url'];
							$dmc_button_target = $dmc_button['target'];
							?>
							<a href="<?php echo $dmc_button_url; ?>">
								<h2>
									<?php the_sub_field( 'dmc_call_to_action_title' ); ?>
								</h2>
								<?php the_sub_field( 'dmc_call_to_action_content' ); ?>
								<span class="button radius">
									<?php echo $dmc_button_label; ?>
								</span>
							</a>
						<?php endif; ?>
					</article>
				</li>

				<?php
			endwhile;
			?>
			</ul>
		</section>
		<?php
	endif;
	?>

</div>

<?php
get_footer();
