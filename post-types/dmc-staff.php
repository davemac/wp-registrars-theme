<?php

function dmc_staff_init() {

	$rewrite = array(
		'slug'       => 'people',
		'with_front' => false,
		'pages'      => true,
	);

	register_post_type(
		'dmc-staff',
		array(
			'labels'            => array(
				'name'               => __( 'People', 'dmcstarter' ),
				'singular_name'      => __( 'People', 'dmcstarter' ),
				'all_items'          => __( 'All People', 'dmcstarter' ),
				'new_item'           => __( 'New Person', 'dmcstarter' ),
				'add_new'            => __( 'Add New', 'dmcstarter' ),
				'add_new_item'       => __( 'Add New Person', 'dmcstarter' ),
				'edit_item'          => __( 'Edit Person', 'dmcstarter' ),
				'view_item'          => __( 'View Person', 'dmcstarter' ),
				'search_items'       => __( 'Search People', 'dmcstarter' ),
				'not_found'          => __( 'No Person found', 'dmcstarter' ),
				'not_found_in_trash' => __( 'No Person found in trash', 'dmcstarter' ),
				'parent_item_colon'  => __( 'Parent Person', 'dmcstarter' ),
				'menu_name'          => __( 'People', 'dmcstarter' ),
			),
			'public'            => true,
			'hierarchical'      => false,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'supports'          => array( 'title', 'editor', 'thumbnail' ),
			'has_archive'       => true,
			'rewrite'           => $rewrite,
			'query_var'         => true,
			'menu_icon'         => 'dashicons-admin-post',
		)
	);

}
add_action( 'init', 'dmc_staff_init' );

function dmc_staff_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['dmc-staff'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => sprintf( __( 'Person updated. <a target="_blank" href="%s">View Person</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'dmcstarter' ),
		3  => __( 'Custom field deleted.', 'dmcstarter' ),
		4  => __( 'Staff updated.', 'dmcstarter' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Person restored to revision from %s', 'dmcstarter' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Person published. <a href="%s">View Staff</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		7  => __( 'Person saved.', 'dmcstarter' ),
		8  => sprintf( __( 'Person submitted. <a target="_blank" href="%s">Preview Person</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9  => sprintf(
			__( 'Person scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Staff</a>', 'dmcstarter' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ),
			esc_url( $permalink )
		),
		10 => sprintf( __( 'Person draft updated. <a target="_blank" href="%s">Preview Person</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'dmc_staff_updated_messages' );
