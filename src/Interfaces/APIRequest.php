<?php
declare( strict_types=1 );
/**
 * User: LNV
 * Date: 12.06.2022
 * Time: 16:44
 */

namespace SV\PayeerAPI\Interfaces;


interface APIRequest {
	public function sendRequest( array $request ): array;

	public function getErrors(): array;
}