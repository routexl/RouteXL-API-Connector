<?php

require_once('routexl-api.class.php');

// Set the locations
$locations = array();

$locations[] = array(
	'name' => '1',
	'lat' => 52.05429,
	'lng' => 4.248618
);

$locations[] = array(
	'name' => '2',
	'lat' => 52.076892,
	'lng' => 4.26975,
);

$locations[] = array(
	'name' => '3',
	'lat' => 51.669946,
	'lng' => 5.61852
);

$locations[] = array(
	'name' => '4',
	'lat' => 51.589548,
	'lng' => 5.432482
);

// Init API connector class
$r = new RouteXL\API_connector();

// Get tour
if ($r->tour($locations)) {
	
	// Show result
	print_r($r->result);
} else {
	
	// Error message
	echo $r->error;
}
