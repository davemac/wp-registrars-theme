<?php

function dmc_conf_papers_init() {

	$rewrite = array(
		'slug'       => 'resources/conference-papers',
		'with_front' => false,
		'pages'      => true,
	);

	register_post_type(
		'dmc-conf-papers',
		array(
			'labels'                => array(
				'name'               => __( 'Conference Papers', 'dmcstarter' ),
				'singular_name'      => __( 'Conference Papers', 'dmcstarter' ),
				'all_items'          => __( 'All Conference Papers', 'dmcstarter' ),
				'new_item'           => __( 'New Conference Papers', 'dmcstarter' ),
				'add_new'            => __( 'Add New', 'dmcstarter' ),
				'add_new_item'       => __( 'Add New Conference Papers', 'dmcstarter' ),
				'edit_item'          => __( 'Edit Conference Papers', 'dmcstarter' ),
				'view_item'          => __( 'View Conference Papers', 'dmcstarter' ),
				'search_items'       => __( 'Search Conference Papers', 'dmcstarter' ),
				'not_found'          => __( 'No Conference Papers found', 'dmcstarter' ),
				'not_found_in_trash' => __( 'No Conference Papers found in trash', 'dmcstarter' ),
				'parent_item_colon'  => __( 'Parent Conference Papers', 'dmcstarter' ),
				'menu_name'          => __( 'Conference Papers', 'dmcstarter' ),
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
			'rest_base'             => 'dmc-conf-papers',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		)
	);

}
add_action( 'init', 'dmc_conf_papers_init' );

function dmc_conf_papers_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['dmc-conf-papers'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => sprintf( __( 'Conference Papers updated. <a target="_blank" href="%s">View Conference Papers</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'dmcstarter' ),
		3  => __( 'Custom field deleted.', 'dmcstarter' ),
		4  => __( 'Conference Papers updated.', 'dmcstarter' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Conference Papers restored to revision from %s', 'dmcstarter' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Conference Papers published. <a href="%s">View Conference Papers</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		7  => __( 'Conference Papers saved.', 'dmcstarter' ),
		8  => sprintf( __( 'Conference Papers submitted. <a target="_blank" href="%s">Preview Conference Papers</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9  => sprintf(
			__( 'Conference Papers scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Conference Papers</a>', 'dmcstarter' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ),
			esc_url( $permalink )
		),
		10 => sprintf( __( 'Conference Papers draft updated. <a target="_blank" href="%s">Preview Conference Papers</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'dmc_conf_papers_updated_messages' );
