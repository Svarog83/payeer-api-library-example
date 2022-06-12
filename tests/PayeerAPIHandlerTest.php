<?php
/**
 * User: LNV
 * Date: 12.06.2022
 * Time: 23:04
 */

namespace SV\PayeerAPI\tests;

use SV\PayeerAPI\Exceptions\APIRequestException;
use SV\PayeerAPI\PayeerAPIHandler;
use PHPUnit\Framework\TestCase;
use SV\PayeerAPI\Config;
use SV\PayeerAPI\GuzzleAPIRequest;

class PayeerAPIHandlerTest extends TestCase {


	/**
	 * @skip
	 * @return void
	 */
	public function testTimeIsReceived(): void {
		$apiRequest = new GuzzleAPIRequest( Config::getAPIID(), Config::getAPISecret() );
		$apiHandler = new PayeerAPIHandler( $apiRequest );
		$response   = $apiHandler->Time();
		$this->assertIsArray( $response, 'Response must be an array' );
		$this->assertArrayHasKey( 'success', $response, '`success` key must be in response' );
		$isSuccess = filter_var( $response['success'], FILTER_VALIDATE_BOOL );
		$this->assertTrue( $isSuccess, '`success` in response must be true' );
		$this->assertArrayHasKey( 'time', $response, '`time` key must be in response' );
	}

	/**
	 * @return void
	 */
	public function testAccountMockThrowsException(): void {
		$apiRequest = $this->createMock( GuzzleAPIRequest::class );
		$apiRequest->method( 'sendRequest' )->willThrowException( new APIRequestException( 'Something is wrong' ) );

		$apiHandler = new PayeerAPIHandler( $apiRequest );
		$this->expectException( APIRequestException::class );
		$apiHandler->Account();
	}
}
