<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/my-profile', 'ProfileController@index')->name('my-profile');
