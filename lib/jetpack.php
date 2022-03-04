<?php

// remove sharing so it can be added manually into template
// https://jetpack.me/2013/06/10/moving-sharing-icons/
function jptweak_remove_share() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}
}
add_action( 'loop_start', 'jptweak_remove_share' );

if ( ! function_exists( 'dmc_display_share' ) ) {
	function dmc_display_share() {
		if ( function_exists( 'sharing_display' ) ) {
			sharing_display( '', true );
		}

		if ( class_exists( 'Jetpack_Likes' ) ) {
			$custom_likes = new Jetpack_Likes();
			echo $custom_likes->post_likes( '' );
		}
	}
}

// remove sharing metaboxes on custom post edit screns that don't need them
if ( is_admin() ) :
	function remove_jetpack_sharing_metabox() {
		remove_meta_box( 'sharing_meta', 'page', 'side' );
		remove_meta_box( 'sharing_meta', ' dmc-cons-resources', 'side' );
		remove_meta_box( 'sharing_meta', 'dmc-legislation', 'side' );
		remove_meta_box( 'sharing_meta', 'dmc-reg-networks', 'side' );
	}
	add_action( 'do_meta_boxes', 'remove_jetpack_sharing_metabox' );
endif;


/**
 * Control the list of modules available under Jetpack > Settings
 * Example: Let's activate 7 specific modules, and nothing more.
 * https://jetpack.com/2016/05/13/hook-month-customize-modules-shortcodes-widgets/
 */
// function jeherve_only_seven_modules( $modules, $min_version, $max_version ) {
//     $my_modules = array(
//         'stats',
//         'photon',
//         'related-posts',
//         'markdown',
//         'sso',
//         'custom-content-types',
//         'custom-css',
//     );
//     return array_intersect_key( $modules, array_flip( $my_modules ) );
// }
// add_filter( 'jetpack_get_available_modules', 'jeherve_only_seven_modules', 20, 3 );


/**
 * Control the list of widgets available in Jetpack’s Extra Sidebar Widgets module
 * Example: Search for the Google+ Badge Widget.
 * https://jetpack.com/2016/05/13/hook-month-customize-modules-shortcodes-widgets/
 */
// function jeherve_googleplus_badge_search( $widget ) {
//     return strpos( $widget, 'googleplus-badge' ) === false;
// }

// // Remove the Google+ Badge Widget.
// function jeherve_remove_googleplus_widget( $widgets ) {
//     $widgets = array_filter( $widgets, 'jeherve_googleplus_badge_search' );
//     return $widgets;
// }
// add_filter( 'jetpack_widgets_to_include', 'jeherve_remove_googleplus_widget' );
