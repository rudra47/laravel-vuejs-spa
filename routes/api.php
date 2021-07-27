<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('category', 'CategoryController');
Route::resource('product', 'ProductController');
// Route::post('login', 'LoginController@login')->name('login');