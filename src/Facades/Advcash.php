<?php


namespace Codemenco\Advcash\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Advcash
 * @package Illuminate\Support\Facades\Facade
 * @method static createBitcoinRequest(float $amount, string $order_id): string
 * @method static setCurrency(string $currency): self
 * @method static setSuccessRoute(string $route_url): void
 * @method static setStatusRoute(string $route_url): void
 * @method static setFailRoute(string $route_url): void
 *
 * @see Codemenco\Advcash\Advcash
 */
class Advcash extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'advcash';
	}
}
