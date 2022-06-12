<?php
declare( strict_types=1 );

namespace SV\PayeerAPI;

use GuzzleHttp\Client;
use SV\PayeerAPI\Exceptions\APIRequestException;

class GuzzleAPIRequest implements Interfaces\APIRequest {
	private const URL = 'https://payeer.com/api/trade/';
	private $httpClient;

	public function __construct( private string $apiID, private string $apiSecret, private array $errors = [] ) {
		$this->httpClient = new Client();
	}

	public function sendRequest( array $request ): array {
		$options['headers']['Content-Type'] = 'application/json';
		$method                             = $request['method'];

		if ( $this->apiID && $this->apiSecret ) {
			$request['post']['ts']          = round( microtime( TRUE ) * 1000 );
			$options['body']                = json_encode( $request['post'] );
			$options['headers']['API-ID']   = $this->apiID;
			$options['headers']['API-SIGN'] = $this->getAPISign( $method . $options['body'] );
		}

		if ( !empty( $request['post'] ) && empty( $options['body'] ) ) {
			$options['body'] = json_encode( $request['post'] );
		}

		try {
			$response = $this->httpClient->request( 'POST', self::URL . $method, $options );
			$result   = $response->getBody() ? json_decode( $response->getBody()->getContents(), TRUE ) : [];
		} catch ( \Throwable $e ) {
			$this->errors[] = $e->getMessage();
			throw new APIRequestException( $e->getMessage(), $e->getCode(), $e );
		}

		if ( empty( $result['success'] ) ) {
			$this->errors = $result['error'] ?? [];

			match ( $result['error']['code'] ) {
				'INVALID_SIGNATURE' => $message = 'Wrong API credentials',
				'INVALID_TIMESTAMP' => $message = 'Wrong date in request',
				default => $message = $result['error']['code'] ?? 'Wrong request'
			};

			throw new APIRequestException( $message, (int)$result['error']['code'] );
		}

		return $result ?? [];
	}

	/**
	 * @param string $data
	 * @return string
	 */
	private function getAPISign( string $data ): string {
		return hash_hmac( 'sha256', $data, $this->apiSecret ) ?? '';
	}

	/**
	 * @return array
	 */
	public function getErrors(): array
	{
		return $this->errors;
	}
}
