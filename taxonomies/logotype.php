<?php

function logotype_init() {
	register_taxonomy( 'logotype', array( 'dmc-logos' ), array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts'
		),
		'labels'            => array(
			'name'                       => __( 'Logo types', 'dmcstarter' ),
			'singular_name'              => _x( 'Logo type', 'taxonomy general name', 'dmcstarter' ),
			'search_items'               => __( 'Search logo types', 'dmcstarter' ),
			'popular_items'              => __( 'Popular logo types', 'dmcstarter' ),
			'all_items'                  => __( 'All logotypes', 'dmcstarter' ),
			'parent_item'                => __( 'Parent logo type', 'dmcstarter' ),
			'parent_item_colon'          => __( 'Parent logotype:', 'dmcstarter' ),
			'edit_item'                  => __( 'Edit logo type', 'dmcstarter' ),
			'update_item'                => __( 'Update logo type', 'dmcstarter' ),
			'add_new_item'               => __( 'New logo type', 'dmcstarter' ),
			'new_item_name'              => __( 'New logo type', 'dmcstarter' ),
			'separate_items_with_commas' => __( 'Logo types separated by comma', 'dmcstarter' ),
			'add_or_remove_items'        => __( 'Add or remove logo types', 'dmcstarter' ),
			'choose_from_most_used'      => __( 'Choose from the most used logo types', 'dmcstarter' ),
			'not_found'                  => __( 'No logo types found.', 'dmcstarter' ),
			'menu_name'                  => __( 'Logo types', 'dmcstarter' ),
		),
	) );

}
add_action( 'init', 'logotype_init' );
