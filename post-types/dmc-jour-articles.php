<?php

function dmc_jour_articles_init() {

	$rewrite = array(
		'slug'       => 'resources/journals',
		'with_front' => false,
		'pages'      => true,
	);

	register_post_type(
		'dmc-jour-articles',
		array(
			'labels'                => array(
				'name'               => __( 'Journal Articles', 'dmcstarter' ),
				'singular_name'      => __( 'Journal Articles', 'dmcstarter' ),
				'all_items'          => __( 'All Journal Articles', 'dmcstarter' ),
				'new_item'           => __( 'New Journal Articles', 'dmcstarter' ),
				'add_new'            => __( 'Add New', 'dmcstarter' ),
				'add_new_item'       => __( 'Add New Journal Articles', 'dmcstarter' ),
				'edit_item'          => __( 'Edit Journal Articles', 'dmcstarter' ),
				'view_item'          => __( 'View Journal Articles', 'dmcstarter' ),
				'search_items'       => __( 'Search Journal Articles', 'dmcstarter' ),
				'not_found'          => __( 'No Journal Articles found', 'dmcstarter' ),
				'not_found_in_trash' => __( 'No Journal Articles found in trash', 'dmcstarter' ),
				'parent_item_colon'  => __( 'Parent Journal Articles', 'dmcstarter' ),
				'menu_name'          => __( 'Journal Articles', 'dmcstarter' ),
			),
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt' ),
			'has_archive'           => true,
			'rewrite'               => $rewrite,
			'query_var'             => true,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'dmc-jour-articles',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		)
	);

}
add_action( 'init', 'dmc_jour_articles_init' );

function dmc_jour_articles_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['dmc-jour-articles'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => sprintf( __( 'Journal Articles updated. <a target="_blank" href="%s">View Journal Articles</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'dmcstarter' ),
		3  => __( 'Custom field deleted.', 'dmcstarter' ),
		4  => __( 'Journal Articles updated.', 'dmcstarter' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Journal Articles restored to revision from %s', 'dmcstarter' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Journal Articles published. <a href="%s">View Journal Articles</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		7  => __( 'Journal Articles saved.', 'dmcstarter' ),
		8  => sprintf( __( 'Journal Articles submitted. <a target="_blank" href="%s">Preview Journal Articles</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9  => sprintf(
			__( 'Journal Articles scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Journal Articles</a>', 'dmcstarter' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ),
			esc_url( $permalink )
		),
		10 => sprintf( __( 'Journal Articles draft updated. <a target="_blank" href="%s">Preview Journal Articles</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'dmc_jour_articles_updated_messages' );
