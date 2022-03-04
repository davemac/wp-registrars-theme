<?php

function dmc_legislation_init() {

	$rewrite = array(
		'slug'       => 'resources/standards-forms',
		'with_front' => false,
		'pages'      => true,
	);

	register_post_type(
		'dmc-legislation',
		array(
			'labels'                => array(
				'name'               => __( 'Legislation, standards & forms', 'dmcstarter' ),
				'singular_name'      => __( 'Legislation, standards & forms', 'dmcstarter' ),
				'all_items'          => __( 'All Legislation, standards & forms', 'dmcstarter' ),
				'new_item'           => __( 'New Legislation, standards & forms', 'dmcstarter' ),
				'add_new'            => __( 'Add New', 'dmcstarter' ),
				'add_new_item'       => __( 'Add New Legislation, standards & forms', 'dmcstarter' ),
				'edit_item'          => __( 'Edit Legislation, standards & forms', 'dmcstarter' ),
				'view_item'          => __( 'View Legislation, standards & forms', 'dmcstarter' ),
				'search_items'       => __( 'Search Legislation, standards & forms', 'dmcstarter' ),
				'not_found'          => __( 'No Legislation, standards & forms found', 'dmcstarter' ),
				'not_found_in_trash' => __( 'No Legislation, standards & forms found in trash', 'dmcstarter' ),
				'parent_item_colon'  => __( 'Parent Legislation, standards & forms', 'dmcstarter' ),
				'menu_name'          => __( 'Legislation, standards & forms', 'dmcstarter' ),
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
			'rest_base'             => 'dmc-legislation',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		)
	);

}
add_action( 'init', 'dmc_legislation_init' );

function dmc_legislation_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['dmc-legislation'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => sprintf( __( 'Legislation, standards & forms updated. <a target="_blank" href="%s">View Legislation, standards & forms</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'dmcstarter' ),
		3  => __( 'Custom field deleted.', 'dmcstarter' ),
		4  => __( 'Legislation, standards & forms updated.', 'dmcstarter' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Legislation, standards & forms restored to revision from %s', 'dmcstarter' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Legislation, standards & forms published. <a href="%s">View Legislation, standards & forms</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		7  => __( 'Legislation, standards & forms saved.', 'dmcstarter' ),
		8  => sprintf( __( 'Legislation, standards & forms submitted. <a target="_blank" href="%s">Preview Legislation, standards & forms</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9  => sprintf(
			__( 'Legislation, standards & forms scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Legislation, standards & forms</a>', 'dmcstarter' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ),
			esc_url( $permalink )
		),
		10 => sprintf( __( 'Legislation, standards & forms draft updated. <a target="_blank" href="%s">Preview Legislation, standards & forms</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'dmc_legislation_updated_messages' );
