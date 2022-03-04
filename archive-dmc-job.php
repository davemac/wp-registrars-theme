<?php
get_header();
?>

<div class="flex-row" id="content">

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" role="main">

		<header>
			<h1 class="archive-title">
				<span>
					Jobs
				</span>
			</h1>
		</header>

		<div class="cards">
			<?php
			if ( have_posts() ) :

				while ( have_posts() ) :
					the_post();
					get_template_part( 'content', 'card-job' );
				endwhile;

				else :
					get_template_part( 'content', 'none' );

			endif;
			?>
		</div>

		<?php dmc_display_pagination(); ?>

	</article>

	<?php
	get_sidebar();
	?>

</div>

<?php
get_footer();
