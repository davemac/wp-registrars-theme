<?php
// modifies the loop on top level shop category pages to list products by sub-category

$dmc_term_id = get_queried_object_id();
$dmc_tax     = $taxonomy->taxonomy;

$args = array(
	'child_of' => $dmc_term_id,
	'orderby'  => 'id',
	'number'   => 3,
);

$terms = get_terms( $dmc_tax, $args );
foreach ( $terms as $term ) {

	$meta_query[] = array(
		'key'   => '_featured',
		'value' => 'no',
	);

	$show_product_cats = new WP_Query(
		array(
			'product_cat' => $term->slug,
			'orderby'     => 'menu_order',
			'meta_query'  => $meta_query,
		)
	);
	?>

	<div class="row category-heading">
		<div class="medium-8 columns small-centered text-center">
			<h2>
				<a href="<?php echo get_term_link( $term ); ?>">
					<?php echo $term->name; ?>
				</a>
			</h2>
		</div>
	</div>

	<?php woocommerce_product_loop_start(); ?>

	<?php
	while ( $show_product_cats->have_posts() ) :
		$show_product_cats->the_post();
		?>

		<?php wc_get_template_part( 'content', 'product' ); ?>

	<?php endwhile; // end of the loop. ?>

	<?php woocommerce_product_loop_end(); ?>

<?php } ?>
