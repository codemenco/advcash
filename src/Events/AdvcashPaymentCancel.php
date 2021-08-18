<?php


namespace Codemenco\Advcash\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdvcashPaymentCancel
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public $payment;

	public function __construct(array $payment)
	{
		$this->payment = $payment;
	}
}
