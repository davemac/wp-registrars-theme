<?php
/*
Template Name: ARC Council
*/
get_header(); ?>

<div class="medium-12 columns" id="content" role="main">

<?php
while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'member-card' ); ?> id="post-<?php the_ID(); ?>">
		<div class="tools-holder">
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>

			<a href="/member/<?php echo get_current_user_id(); ?>" class="back-button">
				Edit My Listing
			</a>
		</div>

		<div class="entry-content">
			<?php
			if ( is_user_logged_in() ) :

				dmc_arc_council_list();

			else :
				?>
				<div class="highlight">
					<h4>
						Member access only
					</h4>
					<p>
						You need to be a logged in member to view the Member Directory.
					</p>
					<a href="/my-account/" class="button">
						Login Now
					</a>
				</div>
				<?php
			endif;
			?>
		</div>

	</article>
<?php endwhile; ?>

</div>

<?php
get_footer();
