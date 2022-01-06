<?php
Route::get('get-states', 'AdressController@getStates')->name('get-states');
Route::get('get-cities/{state}', 'AdressController@getCities')->name('get-cities');
Route::get('get-users', 'Root\FarmController@getUsers')->name('get-users');
