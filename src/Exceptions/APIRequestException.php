<?php
declare( strict_types=1 );

namespace SV\PayeerAPI\Exceptions;

class APIRequestException extends \Exception {
	public function __construct( string $message = '', int $code = 0, \Throwable $previous = NULL ) {

		parent::__construct( $message, $code, $previous );
	}
}
