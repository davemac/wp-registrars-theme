<ul class="medium-block-grid-5 search-filter">
	<li id="filter-varieties">
		<form id="filter-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<?php
			$product_object = get_queried_object();
			$product_cat_id = $product_object->term_id;

			$args = array(
				'show_option_none' => __( 'Variety' ),
				'show_count'       => 1,
				'orderby'          => 'name',
				'taxonomy'         => 'product_cat',
				'value_field'      => 'name',
				'name'             => 'product_cat',
				'child_of'         => $product_cat_id,
				'echo'             => 0,
			);
			?>
			<?php $select_variety = wp_dropdown_categories( $args ); ?>
			<?php $replace = "<select$1 onchange='return this.form.submit()'>"; ?>
			<?php $select_variety = preg_replace( '#<select([^>]*)>#', $replace, $select_variety ); ?>

			<?php echo $select_variety; ?>
			<noscript>
				<input type="submit" value="View varieties" />
			</noscript>
		</form>
	</li>
	<li id="filter-country">
		<form id="country-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<?php

			$argscc = array(
				'show_option_none' => __( 'Country' ),
				'show_count'       => 1,
				'orderby'          => 'name',
				'taxonomy'         => 'location',
				'value_field'      => 'slug',
				'name'             => 'location',
				'hierarchical'     => 'true',
				'depth'            => 1,
				'echo'             => 0,
			);
			?>
			<?php $select_country = wp_dropdown_categories( $argscc ); ?>
			<?php $replace = "<select$1 onchange='return this.form.submit()'>"; ?>
			<?php $select_country = preg_replace( '#<select([^>]*)>#', $replace, $select_country ); ?>

			<?php echo $select_country; ?>
			<noscript>
				<input type="submit" value="View varieties" />
			</noscript>
		</form>
	</li>
	<li id="filter-region">
		<form id="region-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<?php

			$argscc = array(
				'show_option_none' => __( 'Region' ),
				'show_count'       => 1,
				'orderby'          => 'name',
				'taxonomy'         => 'location',
				'value_field'      => 'slug',
				'name'             => 'location',
				'hierarchical'     => 'true',
				'depth'            => 3,
				'echo'             => 0,
			);
			?>
			<?php $select_country = wp_dropdown_categories( $argscc ); ?>
			<?php $replace = "<select$1 onchange='return this.form.submit()'>"; ?>
			<?php $select_country = preg_replace( '#<select([^>]*)>#', $replace, $select_country ); ?>

			<?php echo $select_country; ?>
			<noscript>
				<input type="submit" value="View varieties" />
			</noscript>
		</form>
	</li>
</ul>
