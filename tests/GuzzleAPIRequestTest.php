<?php
/**
 * User: LNV
 * Date: 12.06.2022
 * Time: 18:53
 */

namespace SV\PayeerAPI;

use PHPUnit\Framework\TestCase;
use SV\PayeerAPI\Exceptions\APIRequestException;

class GuzzleAPIRequestTest extends TestCase {

	public function testGetErrors() {
		$api = new GuzzleAPIRequest('123', '456');
		$this->assertIsArray($api->getErrors());
	}

	public function testSendRequest() {
		$api = new GuzzleAPIRequest('123', '456');
		$this->assertIsArray($api->sendRequest(['method'=>'info']));
		$this->expectException(APIRequestException::class);
		$api->sendRequest(['method'=>'info2']);
	}
}
