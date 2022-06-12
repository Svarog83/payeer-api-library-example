<?php
declare( strict_types=1 );

namespace SV\PayeerAPI;

use SV\PayeerAPI\Interfaces\APIHandler;
use SV\PayeerAPI\Interfaces\APIRequest;

class PayeerAPIHandler implements APIHandler {
	public const DEFAULT_PAIR = 'BTC_USDT';

	public function __construct( private APIRequest $apiRequest ) {

	}

	/**
	 * @param string $method
	 * @param array  $fields
	 * @return array
	 */
	private function sendRequest( string $method, array $fields = [] ): array {
		$request           = [];
		$request['method'] = $method;
		if ( $fields ) {
			$request['post'] = $fields;
		}

		return $this->apiRequest->sendRequest( $request );
	}

	/** @inheritDoc */
	public function Info(): array {
		return $this->sendRequest( 'info' );
	}

	public function Time(): array {
		return $this->sendRequest( 'time' );
	}

	/** @inheritDoc */
	public function Orders( array $request = [] ): array {
		if ( empty( $request['pair'] ) ) {
			$request['pair'] = self::DEFAULT_PAIR;
		}
		$response = $this->sendRequest( 'orders', $request );

		return $response['pairs'] ?? [];
	}

	/** @inheritDoc */
	public function Account(): array {
		$response = $this->sendRequest( 'account' );

		return $response['balances'] ?? [];
	}

	/** @inheritDoc */
	public function OrderCreate( array $request = [] ): array {
		return $this->sendRequest( 'orders', $request );
	}

	/** @inheritDoc */
	public function OrderStatus( array $request = [] ): array {
		$response = $this->sendRequest( 'order_status', $request );

		return $response['order'] ?? [];
	}

	/** @inheritDoc */
	public function MyOrders( array $request = [] ): array {
		$response = $this->sendRequest( 'my_orders', $request );

		return $response['items'] ?? [];
	}
}
