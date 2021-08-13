<?php 
namespace Codemenco\AdvCash\Facades;  

use Illuminate\Support\Facades\Facade;  

use Codemenco\AdvCash\AdvCash as AdvCashClass;

class AdvCash extends Facade 
{
	protected static function getFacadeAccessor() { 
		return AdvCashClass::class;   
	}
}
