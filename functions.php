<?php

// head cleanup, post and image related cleaning
require_once get_template_directory() . '/lib/clean.php';

// enqueue vendor scripts and styles
require_once get_template_directory() . '/lib/enqueue.php';

// load Foundation specific functions eg top-bar
require_once get_template_directory() . '/lib/foundation.php';

// filter default WordPress menu classes, add Foundation classes and clean wp_nav_menu markup
require_once get_template_directory() . '/lib/nav.php';

/* Custom post types */
require_once get_template_directory() . '/post-types/dmc-conf-papers.php';
require_once get_template_directory() . '/post-types/dmc-cons-resources.php';
require_once get_template_directory() . '/post-types/dmc-jour-articles.php';
require_once get_template_directory() . '/post-types/dmc-legislation.php';
require_once get_template_directory() . '/post-types/dmc-library.php';
require_once get_template_directory() . '/post-types/dmc-prof-dev.php';
require_once get_template_directory() . '/post-types/dmc-reg-networks.php';
require_once get_template_directory() . '/post-types/dmc-job.php';

/* Custom taxonomies */
// require_once('taxonomies/logotype.php');

// // Advanced Custom Fields customisation functions
require_once get_template_directory() . '/lib/acf-functions.php';

// hero image functions
require_once get_template_directory() . '/lib/hero-images.php';

// Widgets setup
require_once get_template_directory() . '/lib/widgets.php';

// pagination
require_once get_template_directory() . '/lib/pagination.php';
// require_once get_template_directory() . '/lib/prev-next.php';

// post meta functions (entry meta, post authors etc)
require_once get_template_directory() . '/lib/post-meta.php';

// email functions
require_once get_template_directory() . '/lib/email.php';

// pre_get_posts query modification functions
require_once get_template_directory() . '/lib/query-mods.php';

// slider function
require_once get_template_directory() . '/lib/sliders.php';

// Jetpack customisation functions
require_once get_template_directory() . '/lib/jetpack.php';

// Google Maps functions
require_once get_template_directory() . '/lib/maps-geocode.php';

// Events Calendar customisation functions
// require_once get_template_directory() . '/lib/events-calendar/layout.php';

// WooCommerce customisation functions
require_once get_template_directory() . '/lib/woocommerce/woocommerce.php';

// member directory functions
require_once get_template_directory() . '/lib/class-memberscustomroute.php';
require_once get_template_directory() . '/lib/member-directory/member-directory.php';
require_once get_template_directory() . '/lib/member-directory/arc-council.php';

require_once get_template_directory() . '/lib/member-directory/action-dmc-edit-member-callback.php';
// require_once get_template_directory() . '/lib/member-directory/action-dmc-moveout-member-callback.php';

function multirole( $user_id ) {
	$someone = new WP_User( $user_id );
	$someone->add_role( 'editor' );
	$someone->add_role( 'customer' );
}
