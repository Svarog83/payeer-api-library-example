<?php

use SV\PayeerAPI\GuzzleAPIRequest;

require './vendor/autoload.php';
$apiRequest = new GuzzleAPIRequest( \SV\PayeerAPI\Config::getAPIID(), \SV\PayeerAPI\Config::getAPISecret() );
$apiHandler = new \SV\PayeerAPI\PayeerAPIHandler( $apiRequest );
$response   = $apiHandler->Time();
var_dump($response);
