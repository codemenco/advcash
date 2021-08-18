<?php


namespace Codemenco\Advcash\Mappers;


class BitcoinInvoiceResult extends BitcoinInvoiceRequest
{
	/**
	 * @access public
	 * @var string
	 */
	public $bitcoinAddress;
	/**
	 * @access public
	 * @var double
	 */
	public $bitcoinAmount;
}
