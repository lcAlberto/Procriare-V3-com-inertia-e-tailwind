<?php

use Illuminate\Support\Facades\Route;

Route::get('/users', 'Users\AdminController@index')->name('users.index');
