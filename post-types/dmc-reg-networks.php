<?php

function dmc_reg_networks_init() {

	$rewrite = array(
		'slug'       => 'resources/registrar-networks',
		'with_front' => false,
		'pages'      => true,
	);

	register_post_type(
		'dmc-reg-networks',
		array(
			'labels'                => array(
				'name'               => __( 'Registrar networks', 'dmcstarter' ),
				'singular_name'      => __( 'Registrar networks', 'dmcstarter' ),
				'all_items'          => __( 'All Registrar networks', 'dmcstarter' ),
				'new_item'           => __( 'New Registrar networks', 'dmcstarter' ),
				'add_new'            => __( 'Add New', 'dmcstarter' ),
				'add_new_item'       => __( 'Add New Registrar networks', 'dmcstarter' ),
				'edit_item'          => __( 'Edit Registrar networks', 'dmcstarter' ),
				'view_item'          => __( 'View Registrar networks', 'dmcstarter' ),
				'search_items'       => __( 'Search Registrar networks', 'dmcstarter' ),
				'not_found'          => __( 'No Registrar networks found', 'dmcstarter' ),
				'not_found_in_trash' => __( 'No Registrar networks found in trash', 'dmcstarter' ),
				'parent_item_colon'  => __( 'Parent Registrar networks', 'dmcstarter' ),
				'menu_name'          => __( 'Registrar networks', 'dmcstarter' ),
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
			'rest_base'             => 'dmc-reg-networks',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		)
	);

}
add_action( 'init', 'dmc_reg_networks_init' );

function dmc_reg_networks_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['dmc-reg-networks'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => sprintf( __( 'Registrar networks updated. <a target="_blank" href="%s">View Registrar networks</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'dmcstarter' ),
		3  => __( 'Custom field deleted.', 'dmcstarter' ),
		4  => __( 'Registrar networks updated.', 'dmcstarter' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Registrar networks restored to revision from %s', 'dmcstarter' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  => sprintf( __( 'Registrar networks published. <a href="%s">View Registrar networks</a>', 'dmcstarter' ), esc_url( $permalink ) ),
		7  => __( 'Registrar networks saved.', 'dmcstarter' ),
		8  => sprintf( __( 'Registrar networks submitted. <a target="_blank" href="%s">Preview Registrar networks</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9  => sprintf(
			__( 'Registrar networks scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Registrar networks</a>', 'dmcstarter' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ),
			esc_url( $permalink )
		),
		10 => sprintf( __( 'Registrar networks draft updated. <a target="_blank" href="%s">Preview Registrar networks</a>', 'dmcstarter' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'dmc_reg_networks_updated_messages' );
