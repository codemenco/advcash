<?php


namespace Codemenco\Advcash\Events;


use Codemenco\Advcash\Mappers\AdvcashConfirmResponse;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdvcashPaymentIncome
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public $payment;

	public function __construct(AdvcashConfirmResponse $payment)
	{
		$this->payment = $payment;
	}
}
