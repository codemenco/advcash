<?php
return [
    /*
    |--------------------------------------------------------------------------
    | API Name
    |--------------------------------------------------------------------------
    |
    | API name in Advanced Cash system
    |
    */
	'api_name'    => env('AC_API_NAME', 'api_name'),


    /*
    |--------------------------------------------------------------------------
    | Your Account Email
    |--------------------------------------------------------------------------
    |
    | Merchant's account number (email). 
    |
    */
	"account_email"  => env('AC_ACCOUNT_EMAIL', 'account_email'),
   

    /*
    |--------------------------------------------------------------------------
    | Authentication Token
    |--------------------------------------------------------------------------
    |
    | Generated token at authentication section
    |
    */
    "authentication_token" => env('AC_AUTH_TOKEN', 'authentication_token'),


    /*
    |--------------------------------------------------------------------------
    | Sci name
    |--------------------------------------------------------------------------
    |
    | sci name 
    |
    */
    "ac_sci_name" => env('AC_SCI_NAME', 'ac_sci_name'),


    /*
    |--------------------------------------------------------------------------
    | Sci Secret
    |--------------------------------------------------------------------------
    |
    | Generated token at authentication section
    |
    */
    "ac_sci_secret" => env('AC_SCI_SECRET', 'ac_sci_secret'),

    
    /*
    |--------------------------------------------------------------------------
    | Sci Secret
    |--------------------------------------------------------------------------
    |
    | Generated token at authentication section
    |
    */
    "ac_dest_wallet" => env('AC_DEST_WALLET', 'ac_dest_wallet'),
];