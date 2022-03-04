<?php

function dmc_cons_resources_init() {

	$rewrite = array(
		'slug'       => 'resources/conservation-resources',
		'with_front' => false,
		'pages'      => true,
	);

	register_post_type(
		'dmc-cons-resources',
		array(
			'labels'                => array(
				'name'               => __( 'Conservation Resources', 'dmcstarter' ),
				'singular_name'      => __( 'Conservation Resources', 'dmcstarter' ),
				'all_items'          => __( 'All Conservation Resources', 'dmcstarter' ),
				'new_item'           => __( 'New Conservation Resources', 'dmcstarter' ),
				'add_new'            => __( 'Add New', 'dmcstarter' ),
				'add_new_item'       => __( 'Add New Conservation Resources', 'dmcstarter' ),
				'edit_item'          => __( 'Edit Conservation Resources', 'dmcstarter' ),
				'view_item'          => __( 'View Conservation Resources', 'dmcstarter' ),
				'search_items'       => __( 'Search Conservation Resources', 'dmcstarter' ),
				'not_found'          => __( 'No Conservation Resources found', 'dmcstarter' ),
				'not_found_in_trash' => __( 'No Conservation Resources found in trash', 'dmcstarter' ),
				'parent_item_colon'  => __( 'Parent Conservation Resources', 'dmcstarter' ),
				'menu_name'          => __( 'Conservation Resources', 'dmcstarter' ),
			),
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => array( 'title', 'editor' ),
			'has_archive'           => true,
			'rewrite'               => $rewrite,
			'query_var'             => true,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'dmc-cons-resources',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		)
	);

}
add_action( 'init', 'dmc_cons_resources_init' );

function dmc_cons_resources_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['dmc-cons-resources'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => sprintf( __( 'Conservation Resources updated. <a target="_blank" href="%s">View Conservation Resources</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'dmcstarter' ),
		3  => __( 'Custom field deleted.', 'dmcstarter' ),
		4  => __( 'Conservation Resources updated.', 'dmcstarter' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Conservation Resources restored to revision from %s', 'dmcstarter' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Conservation Resources published. <a href="%s">View Conservation Resources</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		7  => __( 'Conservation Resources saved.', 'dmcstarter' ),
		8  => sprintf( __( 'Conservation Resources submitted. <a target="_blank" href="%s">Preview Conservation Resources</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9  => sprintf(
			__( 'Conservation Resources scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Conservation Resources</a>', 'dmcstarter' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ),
			esc_url( $permalink )
		),
		10 => sprintf( __( 'Conservation Resources draft updated. <a target="_blank" href="%s">Preview Conservation Resources</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'dmc_cons_resources_updated_messages' );
