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
	protected $api;

	protected function setUp(): void {
		parent::setUp();

		$this->api = new GuzzleAPIRequest( Config::getAPIID(), Config::getAPISecret() );
	}

	/**
	 * @return void
	 * @throws APIRequestException
	 */
	public function testSendRequestReturnsArrayResponse(): void {
		$this->assertIsArray( $this->api->sendRequest( [ 'method' => 'info' ] ) );
	}

	/**
	 * @return void
	 * @throws APIRequestException
	 */
	public function testSendRequestThrowsException(): void {
		$this->expectException( APIRequestException::class );
		$this->api->sendRequest( [ 'method' => 'info2' ] );
	}
}
