<?php

Route::post('advcash/confirm','Codemenco\Advcash\Controllers\AdvcashController@confirm')->name('advcash.confirm');
Route::post('advcash/cancel', 'Codemenco\Advcash\Controllers\AdvcashController@cancel_payment')->name('advcash.cancel');
Route::post('advcash/status', 'Codemenco\Advcash\Controllers\AdvcashController@status')->name('advcash.status');
