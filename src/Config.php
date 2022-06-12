<?php
declare( strict_types=1 );

namespace SV\PayeerAPI;

class Config {
	private const apiID     = '123';
	private const apiSecret = '456';

	//todo: implement real config variables separated by environment
	public static function getAPIID() {
		return self::apiID;
	}

	public static function getAPISecret() {
		return self::apiSecret;
	}
}