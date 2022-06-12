<?php
/**
 * User: LNV
 * Date: 12.06.2022
 * Time: 18:53
 */
declare( strict_types=1 );
namespace SV\PayeerAPI\tests;

use PHPUnit\Framework\TestCase;
use SV\PayeerAPI\Exceptions\APIRequestException;
use SV\PayeerAPI\Config;
use SV\PayeerAPI\GuzzleAPIRequest;

class GuzzleAPIRequestTest extends TestCase {

	public function testGetErrors() {
		$api = new GuzzleAPIRequest( Config::getAPIID(), Config::getAPISecret() );
		$this->assertIsArray( $api->getErrors() );
	}

	public function testSendRequest() {
		$api = new GuzzleAPIRequest( Config::getAPIID(), Config::getAPISecret() );
		$this->assertIsArray( $api->sendRequest( [ 'method' => 'info' ] ) );
		$this->expectException( APIRequestException::class );
		$api->sendRequest( [ 'method' => 'info2' ] );
	}
}
