<?php
declare( strict_types=1 );
/**
 * User: LNV
 * Date: 12.06.2022
 * Time: 16:44
 */

namespace SV\src\Interfaces;


interface APIHandler {
	/**
	 * @param array $request
	 *
	 * @return array
	 */
	public function Info( array $request ): array;

	/**
	 * @param array $request
	 *
	 * @return array
	 */
	public function Orders( array $request ): array;

	/**
	 * @return array
	 */
	public function Account(): array;

	/**
	 * @param array $request
	 *
	 * @return array
	 */
	public function OrderCreate( array $request ): array;

	/**
	 * @param array $request
	 *
	 * @return array
	 */
	public function OrderStatus( array $request ): array;

	/**
	 * @param array $request
	 *
	 * @return array
	 */
	public function MyOrders( array $request ): array;

}