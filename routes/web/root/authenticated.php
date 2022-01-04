<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');

Route::get('/users', 'Users\AdminController@index')->name('users.index');
Route::resource('farms', 'FarmController');
