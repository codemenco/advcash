<?php

return [
	'sci_name'      => env("ADVCASH_NAME", null),
	'sci_email'     => env("ADVCASH_EMAIL", null),
	'sci_password'  => env("ADVCASH_PASS", null),
	'default'       => env('ADVCASH_DEF',false),

	'api_name'      => env("ADVCASH_API_NAME", null),
	'api_email'     => env("ADVCASH_API_EMAIL", null),
	'api_password'  => env("ADVCASH_API_PASS", null),
];
