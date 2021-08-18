<?php


namespace Codemenco\Advcash\Mappers;


class createBitcoinInvoiceResult extends createBitcoinInvoiceRequest
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
