<?php 
namespace Codemenco\Advcash\Facades;  

use Illuminate\Support\Facades\Facade;  

use Codemenco\Advcash\AdvCash as AdvCashClass;

class AdvCash extends Facade 
{
	protected static function getFacadeAccessor() { 
		return AdvCashClass::class;   
	}
}
