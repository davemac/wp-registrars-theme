<?php

function dmc_library_init() {

	$rewrite = array(
		'slug'       => 'resources/library',
		'with_front' => false,
		'pages'      => true,
	);

	register_post_type(
		'dmc-library',
		array(
			'labels'                => array(
				'name'               => __( 'Libraries', 'dmcstarter' ),
				'singular_name'      => __( 'Library', 'dmcstarter' ),
				'all_items'          => __( 'All Libraries', 'dmcstarter' ),
				'new_item'           => __( 'New Library', 'dmcstarter' ),
				'add_new'            => __( 'Add New', 'dmcstarter' ),
				'add_new_item'       => __( 'Add New Library', 'dmcstarter' ),
				'edit_item'          => __( 'Edit Library', 'dmcstarter' ),
				'view_item'          => __( 'View Library', 'dmcstarter' ),
				'search_items'       => __( 'Search Libraries', 'dmcstarter' ),
				'not_found'          => __( 'No Libraries found', 'dmcstarter' ),
				'not_found_in_trash' => __( 'No Libraries found in trash', 'dmcstarter' ),
				'parent_item_colon'  => __( 'Parent Library', 'dmcstarter' ),
				'menu_name'          => __( 'Libraries', 'dmcstarter' ),
			),
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => array( 'title', 'editor', 'author' ),
			'has_archive'           => true,
			'rewrite'               => $rewrite,
			'query_var'             => true,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'dmc-library',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		)
	);

}
add_action( 'init', 'dmc_library_init' );

function dmc_library_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['dmc-library'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => sprintf( __( 'Library updated. <a target="_blank" href="%s">View Library</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'dmcstarter' ),
		3  => __( 'Custom field deleted.', 'dmcstarter' ),
		4  => __( 'Library updated.', 'dmcstarter' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Library restored to revision from %s', 'dmcstarter' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Library published. <a href="%s">View Library</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		7  => __( 'Library saved.', 'dmcstarter' ),
		8  => sprintf( __( 'Library submitted. <a target="_blank" href="%s">Preview Library</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9  => sprintf(
			__( 'Library scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Library</a>', 'dmcstarter' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ),
			esc_url( $permalink )
		),
		10 => sprintf( __( 'Library draft updated. <a target="_blank" href="%s">Preview Library</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'dmc_library_updated_messages' );
