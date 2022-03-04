<?php

function dmc_prof_dev_init() {
	register_post_type(
		'dmc-prof-dev',
		array(
			'labels'                => array(
				'name'               => __( 'Professional developments', 'dmcstarter' ),
				'singular_name'      => __( 'Professional development', 'dmcstarter' ),
				'all_items'          => __( 'All Professional developments', 'dmcstarter' ),
				'new_item'           => __( 'New Professional development', 'dmcstarter' ),
				'add_new'            => __( 'Add New', 'dmcstarter' ),
				'add_new_item'       => __( 'Add New Professional development', 'dmcstarter' ),
				'edit_item'          => __( 'Edit Professional development', 'dmcstarter' ),
				'view_item'          => __( 'View Professional development', 'dmcstarter' ),
				'search_items'       => __( 'Search Professional developments', 'dmcstarter' ),
				'not_found'          => __( 'No Professional developments found', 'dmcstarter' ),
				'not_found_in_trash' => __( 'No Professional developments found in trash', 'dmcstarter' ),
				'parent_item_colon'  => __( 'Parent Professional development', 'dmcstarter' ),
				'menu_name'          => __( 'Professional developments', 'dmcstarter' ),
			),
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => array( 'title', 'editor' ),
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'dmc-prof-dev',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		)
	);

}
add_action( 'init', 'dmc_prof_dev_init' );

function dmc_prof_dev_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['dmc-prof-dev'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => sprintf( __( 'Professional development updated. <a target="_blank" href="%s">View Professional development</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'dmcstarter' ),
		3  => __( 'Custom field deleted.', 'dmcstarter' ),
		4  => __( 'Professional development updated.', 'dmcstarter' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Professional development restored to revision from %s', 'dmcstarter' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Professional development published. <a href="%s">View Professional development</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		7  => __( 'Professional development saved.', 'dmcstarter' ),
		8  => sprintf( __( 'Professional development submitted. <a target="_blank" href="%s">Preview Professional development</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9  => sprintf(
			__( 'Professional development scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Professional development</a>', 'dmcstarter' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ),
			esc_url( $permalink )
		),
		10 => sprintf( __( 'Professional development draft updated. <a target="_blank" href="%s">Preview Professional development</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'dmc_prof_dev_updated_messages' );
