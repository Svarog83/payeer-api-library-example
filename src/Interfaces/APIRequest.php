<?php
declare( strict_types=1 );
/**
 * User: LNV
 * Date: 12.06.2022
 * Time: 16:44
 */

namespace SV\PayeerAPI\Interfaces;


interface APIRequest {
	/**
	 * Makes a request to API and returns an array of response
	 *
	 * @param array $request
	 * @return array
	 */
	public function sendRequest( array $request ): array;

	/**
	 * Returns an array of errors
	 *
	 * @return array
	 */
	public function getErrors(): array;
}