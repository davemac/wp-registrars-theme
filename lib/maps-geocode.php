<?php

function dmc_gmaps_geocode( $street_address, $dmc_md_city, $dmc_md_state, $dmc_md_country ) {

	// google doesn't like spaces in urls, but who does?
	$street_address = str_replace( ' ', '+', $street_address );
	$city           = str_replace( ' ', '+', $dmc_md_city );
	$state          = str_replace( ' ', '+', $dmc_md_state );
	$country        = str_replace( ' ', '+', $dmc_md_country );

	$url                 = "https://maps.googleapis.com/maps/api/geocode/json?address=$street_address,+$city,+$state,+$country&key=" . GOOGLE_API_KEY;
	$google_api_response = wp_remote_get( $url );

	//grab our results from Google
	$results = json_decode( $google_api_response['body'] );
	//cast them to an array
	$results = (array) $results;

	//easily use our status
	$status = $results['status'];

	$location_all_fields = (array) $results['results'][0];
	$location_geometry   = (array) $location_all_fields['geometry'];
	$location_lat_long   = (array) $location_geometry['location'];

	if ( 'OK' === $status ) :
		$latitude  = $location_lat_long['lat'];
		$longitude = $location_lat_long['lng'];
	else :
		$latitude  = '';
		$longitude = '';
	endif;

	$return = array(
		'latitude'  => $latitude,
		'longitude' => $longitude,
	);

	$file_path = 'locations.json';
	file_put_contents( $file_path, $return, FILE_APPEND );

	return $return;
}
