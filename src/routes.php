<?php

Route::post('advcash/cancel', 'Codemenco\Advcash\AdvCash@cancel_payment')->name('advcash.cancel');
Route::post('advcash/confirm', 'Codemenco\Advcash\AdvCash@validateIPNRequest')->name('advcash.confirm');
Route::any('advcash/personal', function(){
	return redirect(env('PERSONAL_LINK_CAB'));
})->name('advcash.after_pay_to_cab');