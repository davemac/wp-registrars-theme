<?php

if ( class_exists( 'Tribe__Tickets_Plus__Commerce__WooCommerce__Main' ) ) {
	// Remove the form from its default location (after the meta).
	remove_action( 'tribe_events_single_event_after_the_meta', array( Tribe__Tickets_Plus__Commerce__WooCommerce__Main::get_instance(), 'front_end_tickets_form' ), 5 );
}
