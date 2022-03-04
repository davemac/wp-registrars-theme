<?php

// add custom post types to the author query
function hdb_add_custom_type_to_query() {
	if ( ! is_admin() ) {
		global $wp_query;
		if ( is_author() ) {
			$wp_query->set( 'post_type', array( 'dmc-jour-articles', 'dmc-conf-papers', 'dmc-legislation' ) );
		}
	}
}
add_action( 'pre_get_posts', 'hdb_add_custom_type_to_query' );


function dmc_landing_pages_custom_pre_get_posts( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( is_post_type_archive( 'dmc-cons-resources' )
		|| is_post_type_archive( 'dmc-legislation' )
		|| is_post_type_archive( 'dmc-reg-networks' )
		|| is_post_type_archive( 'dmc-library' )

	) {
		$query->set( 'posts_per_archive_page', -1 );
		$query->set( 'post_parent', 0 );
		set_query_var( 'order', 'ASC' );
		set_query_var( 'orderby', 'title' );
		return $query;
	}
}
add_filter( 'pre_get_posts', 'dmc_landing_pages_custom_pre_get_posts' );